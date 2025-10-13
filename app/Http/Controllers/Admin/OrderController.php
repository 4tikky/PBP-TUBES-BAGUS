<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        $orders = Order::with(['user'])->withCount('items')->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail pesanan.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Mengupdate status pesanan.
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:diproses,dikirim,selesai,batal',
        ]);

        $newStatus = $request->input('status', $order->status);

        DB::transaction(function () use ($order, $newStatus) {
            $originalStatus = $order->status;

            // Ubah status
            $order->status = $newStatus;

            // Jika transisi dari selain 'batal' -> 'batal', kembalikan stok
            if ($originalStatus !== 'batal' && $newStatus === 'batal') {
                $order->loadMissing('items'); // product bisa null, kunci ulang per row
                foreach ($order->items as $it) {
                    $p = Product::whereKey($it->product_id)->lockForUpdate()->first();
                    if ($p) {
                        $p->increment('stock', (int) $it->quantity);
                    }
                }
            }

            // Opsional: jika dari 'batal' -> status lain, potong stok lagi bila tersedia
            if ($originalStatus === 'batal' && $newStatus !== 'batal') {
                $order->loadMissing('items');
                foreach ($order->items as $it) {
                    $p = Product::whereKey($it->product_id)->lockForUpdate()->first();
                    if ($p && $p->stock >= $it->quantity) {
                        $p->decrement('stock', (int) $it->quantity);
                    } else {
                        throw new \RuntimeException("Stok {$p->name} tidak cukup untuk memulihkan pesanan.");
                    }
                }
            }

            $order->save();
        });

        return back()->with('success', 'Status pesanan diperbarui.');
    }
}
