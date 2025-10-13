<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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

        $order->update($data);

        return back()->with('success', 'Status pesanan diperbarui.');
    }
}
