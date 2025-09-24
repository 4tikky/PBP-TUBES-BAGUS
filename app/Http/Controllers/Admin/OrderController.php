<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Mengupdate status pesanan.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', Rule::in(['diproses', 'dikirim', 'selesai', 'batal'])],
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', "Status Pesanan #{$order->id} berhasil diperbarui!");
    }
}