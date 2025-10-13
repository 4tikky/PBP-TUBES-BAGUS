<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

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
        $request->validate([
            'nama-lengkap' => 'required|string|max:255',
            'email'        => 'required|email',
            'telepon'      => 'required|string|max:30',
            'alamat'       => 'required|string|max:2000',
            'pengiriman'   => 'required|integer|min:0',
            'subtotal'     => 'required|integer|min:0',
            'total'        => 'required|integer|min:0',
        ]);

        // TODO: Simpan Order + OrderItems jika modelnya tersedia (App\Models\Order, OrderItem)
        // Sementara: anggap berhasil dan redirect.
        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat. Terima kasih!');
    }
}
