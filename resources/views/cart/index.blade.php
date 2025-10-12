<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">Keranjang Belanja</h2>
            <a href="{{ route('home') }}" class="text-sm text-blue-600 hover:underline">Lanjut Belanja</a>
        </div>
    </x-slot>

    <!-- Wrapper background biru muda -->
    <div class="bg-blue-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 text-green-800 bg-green-100 border border-green-200 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($items->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 text-center">
                    <div class="mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 1.5M7 13l-1.5-1.5M16 13l1.5-1.5M16 13l-1.5 1.5M6 16h12M6 20h12" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Keranjang Anda kosong</h3>
                    <p class="text-gray-600 mb-6">Ayo mulai belanja dan temukan produk terbaik untuk Anda.</p>
                    <a href="{{ route('home') }}"
                       class="inline-block bg-gradient-to-r from-sky-400 to-sky-500 hover:from-sky-500 hover:to-sky-600 text-white font-medium px-6 py-3 rounded-lg shadow">
                        Mulai Belanja
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Daftar Item -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach ($items as $item)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-5 hover:shadow-md transition">
                                <div class="flex items-start gap-4">
                                    <div class="w-24 h-24 sm:w-28 sm:h-28 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                        <img
                                            src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://placehold.co/160x160' }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-full h-full object-cover">
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                                            <div class="min-w-0">
                                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 truncate">
                                                    {{ $item->product->name }}
                                                </h3>
                                                <div class="mt-1 text-sm text-gray-500">
                                                    Harga: Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-sm text-gray-500">Subtotal</div>
                                                <div class="text-lg font-bold text-blue-600">
                                                    Rp {{ number_format(($item->product->price ?? 0) * $item->quantity, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                            <form method="POST" action="{{ route('cart.update', $item) }}"
                                                  class="flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <label class="text-sm text-gray-600">Jumlah:</label>
                                                <input type="number" name="quantity" min="1" value="{{ $item->quantity }}"
                                                       class="w-20 border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                                                <button
                                                    class="px-3 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">
                                                    Update
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('cart.remove', $item) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-3 py-2 rounded-lg border border-red-200 bg-red-50 text-red-600 hover:bg-red-100">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Ringkasan Belanja -->
                    <aside class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-fit">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Belanja</h4>

                        <div class="space-y-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">
                                    Rp {{ number_format($total ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Ongkir</span>
                                <span class="font-semibold">-</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3 flex items-center justify-between">
                                <span class="text-gray-800 font-semibold">Total</span>
                                <span class="text-xl font-bold text-blue-600">
                                    Rp {{ number_format($total ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3">
                            <a href="{{ route('home') }}"
                               class="block text-center w-full px-4 py-3 rounded-lg border border-gray-200 hover:bg-gray-50 text-gray-700 bg-white">
                                Lanjut Belanja
                            </a>
                            <button type="button"
                                    class="block w-full px-4 py-3 rounded-lg bg-gradient-to-r from-sky-400 to-sky-500 hover:from-sky-500 hover:to-sky-600 text-white font-semibold shadow">
                                Checkout
                            </button>
                        </div>
                    </aside>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>