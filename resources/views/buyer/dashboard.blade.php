<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Bagian Sambutan & Profil Ringkas (Gabungan Terbaik) --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white overflow-hidden shadow-lg sm:rounded-lg mb-8 p-6 md:p-8 flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0 text-center md:text-left">
                    <h3 class="text-3xl md:text-4xl font-bold mb-1">
                        Halo, {{ Auth::user()->name }}! 👋
                    </h3>
                    <p class="text-blue-100 text-lg">
                        Selamat berbelanja di Gerai Kita - UMKM terpercaya.
                    </p>
                </div>
                <div class="flex items-center">
                    <img class="w-16 h-16 rounded-full border-2 border-white mr-4" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" alt="Avatar">
                    <div>
                        <p class="font-semibold text-white">{{ Auth::user()->email }}</p>
                        <a href="{{ route('profile.edit') }}" class="text-blue-200 hover:underline text-sm">Lihat Profil</a>
                    </div>
                </div>
            </div>

            {{-- Bagian Statistik Cepat (dari Versi 1) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-5 flex items-center justify-between transition-transform transform hover:scale-105">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Pesanan Diproses</p>
                        <p class="text-2xl font-bold text-blue-700 mt-1">
                            {{ Auth::user()->orders()->where('status', 'diproses')->count() }}
                        </p>
                    </div>
                    <i class="fas fa-truck text-3xl text-blue-400"></i>
                </div>
                <div class="bg-white rounded-lg shadow-md p-5 flex items-center justify-between transition-transform transform hover:scale-105">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Pesanan Dikirim</p>
                        <p class="text-2xl font-bold text-yellow-500 mt-1">
                             {{ Auth::user()->orders()->where('status', 'dikirim')->count() }}
                        </p>
                    </div>
                    <i class="fas fa-box-open text-3xl text-yellow-400"></i>
                </div>
                <div class="bg-white rounded-lg shadow-md p-5 flex items-center justify-between transition-transform transform hover:scale-105">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Pesanan Selesai</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">
                            {{ Auth::user()->orders()->where('status', 'selesai')->count() }}
                        </p>
                    </div>
                    <i class="fas fa-check-circle text-3xl text-green-400"></i>
                </div>
                <div class="bg-white rounded-lg shadow-md p-5 flex items-center justify-between transition-transform transform hover:scale-105">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Notifikasi</p>
                        <p class="text-2xl font-bold text-red-600 mt-1">0</p>
                    </div>
                    <i class="fas fa-bell text-3xl text-red-400"></i>
                </div>
            </div>

            {{-- Bagian Daftar Pesanan (dari Versi 1) --}}
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold mb-4 text-gray-800">Riwayat 5 Pesanan Terakhir</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Pesanan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold capitalize">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $order->status == 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->status == 'dikirim' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $order->status == 'batal' ? 'bg-red-100 text-red-800' : '' }}
                                            ">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            Anda belum memiliki pesanan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                @if (method_exists($orders, 'links'))
                    {{ $orders->links() }}
                @endif
            </div>

        </div>
    </div>
</x-app-layout>