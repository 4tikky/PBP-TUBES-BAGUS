<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

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

        // Data untuk Grafik Penjualan 7 Hari Terakhir (real)
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

        // Ganti: categoryData dari database (real), jumlah produk per kategori
        $categoryData = \App\Models\Category::withCount('products')
            ->orderBy('name')
            ->get()
            ->pluck('products_count', 'name')
            ->toArray();

        // Ganti: recentActivities jadi gabungan aktivitas nyata
        // - Pesanan terbaru
        $recentOrdersActs = $recentOrders->map(function ($o) {
            return (object)[
                'type' => 'order',
                'description' => 'Pesanan ' . ($o->code ?? ('#' . $o->id)) . ' dari ' . ($o->user->name ?? 'Pengguna') . '.',
                'created_at' => $o->created_at,
            ];
        });

        // - Pengguna baru
        $newUsers = \App\Models\User::latest()->take(5)->get();
        $newUsersActs = $newUsers->map(function ($u) {
            return (object)[
                'type' => 'user',
                'description' => 'Pengguna baru "' . $u->name . '" telah mendaftar.',
                'created_at' => $u->created_at,
            ];
        });

        // - Peringatan stok menipis
        $lowStockActs = $lowStockProducts->map(function ($p) {
            return (object)[
                'type' => 'product',
                'description' => 'Stok produk "' . $p->name . '" tersisa ' . (int)($p->stock ?? 0) . '.',
                'created_at' => $p->updated_at ?? now(),
            ];
        });

        $recentActivities = $recentOrdersActs
            ->merge($newUsersActs)
            ->merge($lowStockActs)
            ->sortByDesc('created_at')
            ->values()
            ->take(8);

        // Data untuk pie chart label/data (tetap, dipakai kalau ada)
        $cats = Category::withCount('products')->orderBy('name')->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalUsers',
            'totalProducts',
            'totalRevenue',
            'recentOrders',
            'lowStockProducts',
            'chartLabels',
            'chartData',
            'categoryData',
            'recentActivities',
        ))
        ->with('catLabels', $cats->pluck('name'))
        ->with('catData', $cats->pluck('products_count'));
    }
}
