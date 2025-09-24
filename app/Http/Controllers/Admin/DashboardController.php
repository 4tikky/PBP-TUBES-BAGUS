<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk kartu statistik di bagian atas
        $totalProducts = \App\Models\Product::count();
        $totalOrders = \App\Models\Order::count();
        $totalUsers = \App\Models\User::where('role', 'user')->count();
        // Menghitung total pendapatan dari pesanan yang sudah selesai
        $totalRevenue = \App\Models\Order::where('status', 'selesai')->sum('total');

        $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
        $lowStockProducts = \App\Models\Product::orderBy('stock', 'asc')->take(5)->get();

        // DITAMBAHKAN: Data untuk Grafik Penjualan 7 Hari Terakhir
        $salesData = \App\Models\Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->where('status', 'selesai')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chartLabels = $salesData->pluck('date')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('d M');
        });
        $chartData = $salesData->pluck('total');

        $categoryData = ['Sembako' => 65, 'Jajanan' => 25, 'Minuman' => 10]; // Data dummy
        $recentActivities = collect([ // Data dummy
            (object)['type' => 'order', 'description' => 'Pesanan baru #1024 diterima dari Budi.', 'created_at' => now()->subHours(1)],
            (object)['type' => 'product', 'description' => 'Stok produk "Kopi Gayo" hampir habis.', 'created_at' => now()->subHours(3)],
            (object)['type' => 'user', 'description' => 'Pengguna baru "Citra" telah mendaftar.', 'created_at' => now()->subHours(5)],
        ]);

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'recentOrders',
            'lowStockProducts',
            'chartLabels',
            'chartData',
            'categoryData',
            'recentActivities',
        ));
    }
}