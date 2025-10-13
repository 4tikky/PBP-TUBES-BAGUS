<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $items = Cart::with('product')->where('user_id', auth()->id())->get();
        $subtotal = $items->sum(fn ($i) => (int)($i->product->price ?? 0) * (int)$i->quantity);
        return view('checkout.index', compact('items', 'subtotal'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama-lengkap' => 'required|string|max:255',
            'email'        => 'required|email',
            'telepon'      => 'required|string|max:30',
            'alamat'       => 'required|string|max:2000',
            'pengiriman'   => 'required|integer|min:0',
        ]);

        $userId = auth()->id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Keranjang kosong.');
        }

        $subtotal = $cartItems->sum(fn ($i) => (int)($i->product->price ?? 0) * (int)$i->quantity);
        $shipping = (int) $data['pengiriman'];
        $total    = $subtotal + $shipping;

        DB::transaction(function () use ($userId, $data, $cartItems, $subtotal, $shipping, $total) {
            $payload = [
                'user_id'          => $userId,
                'code'             => 'ORD-'.now()->format('YmdHis').Str::upper(Str::random(4)),
                'receiver_name'    => $data['nama-lengkap'],
                'email'            => $data['email'],
                'phone'            => $data['telepon'],
                'shipping_service' => $shipping === 10000 ? 'Reguler' : ($shipping === 20000 ? 'Express' : 'Kargo'),
                'subtotal'         => $subtotal,
                'shipping_cost'    => $shipping,
                'total'            => $total,
                'status'           => 'diproses',
            ];

            // Isi alamat ke kolom yang tersedia
            if (Schema::hasColumn('orders', 'address')) {
                $payload['address'] = $data['alamat'];
            }
            if (Schema::hasColumn('orders', 'address_text')) {
                $payload['address_text'] = $data['alamat'];
            }

            $order = Order::create($payload);

            foreach ($cartItems as $ci) {
                $price = (int) ($ci->product->price ?? 0);
                $qty   = (int) $ci->quantity;
                OrderItem::create([
                    'order_id'  => $order->id,
                    'product_id'=> $ci->product_id,
                    'price'     => $price,
                    'quantity'  => $qty,
                    'subtotal'  => $price * $qty,
                ]);
            }

            Cart::where('user_id', $userId)->delete();
        });

        return redirect()->route('buyer.orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }
}
