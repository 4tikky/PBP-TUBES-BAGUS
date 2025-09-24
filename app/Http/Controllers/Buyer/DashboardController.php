<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 5 pesanan terakhir dari pengguna yang sedang login
        $orders = Order::where('user_id', Auth::id())
                        ->latest()
                        ->take(5)
                        ->get();

        return view('buyer.dashboard', compact('orders'));
    }
}