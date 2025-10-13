<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::withCount('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10); // gunakan paginate, bukan get()

        return view('buyer.dashboard', compact('orders'));
    }
}