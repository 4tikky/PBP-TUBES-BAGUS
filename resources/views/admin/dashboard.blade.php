<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
                <p class="text-sm text-gray-600 mt-1">Selamat datang kembali, {{ Auth::user()->name }}! Ringkasan performa toko Anda.</p>
            </div>
        </div>
    </x-slot>

    {{-- Main Content Wrapper --}}
    <div class="p-4 sm:p-6 lg:p-8">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Total Pendapatan --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full"><i class="fas fa-dollar-sign text-green-600 text-xl"></i></div>
                </div>
            </div>
             {{-- Total Pesanan --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pesanan</p>
                        <p class="text-2xl font-bold text-blue-600 mt-1">{{ $totalOrders }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full"><i class="fas fa-shopping-cart text-blue-600 text-xl"></i></div>
                </div>
            </div>
            {{-- Total Produk --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Produk</p>
                        <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $totalProducts }}</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full"><i class="fas fa-box-open text-yellow-600 text-xl"></i></div>
                </div>
            </div>
             {{-- Total Pengguna --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                        <p class="text-2xl font-bold text-indigo-600 mt-1">{{ $totalUsers }}</p>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-full"><i class="fas fa-users text-indigo-600 text-xl"></i></div>
                </div>
            </div>
        </div>

        {{-- Charts Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Grafik Pendapatan (7 Hari Terakhir)</h3>
                <div class="h-80"><canvas id="salesChart"></canvas></div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Kategori</h3>
                <div class="h-80"><canvas id="categoryChart"></canvas></div>
            </div>
        </div>

        {{-- Recent Orders & Low Stock --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pesanan Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($recentOrders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-sm font-medium">#{{ $order->id }}</td>
                                    <td class="px-4 py-4 text-sm">{{ $order->user->name }}</td>
                                    <td class="px-4 py-4 text-sm capitalize"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $order->status }}</span></td>
                                    <td class="px-4 py-4 text-sm font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-4 text-gray-500">Tidak ada pesanan terbaru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Produk Stok Menipis</h3>
                <ul class="space-y-4">
                    @forelse ($lowStockProducts as $product)
                        <li class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50">
                            <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                            <span class="text-sm font-bold text-red-600">Sisa: {{ $product->stock }}</span>
                        </li>
                    @empty
                        <li class="text-center text-gray-500 pt-4">Semua stok produk aman.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Interaktivitas --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sales Chart (Line Chart)
            const salesCtx = document.getElementById('salesChart')?.getContext('2d');
            if (salesCtx) {
                new Chart(salesCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartLabels) !!},
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: {!! json_encode($chartData) !!},
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 3, tension: 0.4, fill: true,
                            pointBackgroundColor: 'rgb(59, 130, 246)', pointBorderColor: '#fff',
                            pointBorderWidth: 2, pointRadius: 5, pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        scales: { y: { beginAtZero: true } }
                    }
                });
            }

            // Category Chart (Doughnut Chart)
            const categoryCtx = document.getElementById('categoryChart')?.getContext('2d');
            if (categoryCtx) {
                new Chart(categoryCtx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(array_keys($categoryData)) !!},
                        datasets: [{
                            data: {!! json_encode(array_values($categoryData)) !!},
                            backgroundColor: ['rgb(59, 130, 246)', 'rgb(96, 165, 250)', 'rgb(147, 197, 253)'],
                            hoverOffset: 4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });
            }
        });
    </script>
</x-admin-layout>
