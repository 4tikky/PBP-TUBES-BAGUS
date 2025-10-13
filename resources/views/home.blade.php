<x-app-layout>
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-r from-blue-500 to-blue-600 text-white py-20 mb-12 overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 animate-fade-in">
                Selamat Datang di <span class="inline-block bg-white text-blue-600 px-4 py-2 rounded-lg shadow-md transform -rotate-2">
                    Gerai Kita </span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Temukan sembako berkualitas dengan harga bersahabat. </br>Belanja di sini, dukung ekonomi lokal!
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#katalog" class="bg-white text-blue-600 font-semibold py-3 px-8 rounded-full hover:bg-blue-50 transition duration-300 shadow-lg">
                    Lihat Katalog
                </a>
                <a href="{{ route('about') }}" class="border-2 border-white text-white font-semibold py-3 px-8 rounded-full hover:bg-white hover:text-blue-600 transition duration-300">
                    Tentang Kami
                </a>
            </div>
        </div>
        {{-- Background Pattern --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-10 rounded-full -mr-48 mt-12"></div>
    </section>

    {{-- Fitur Pencarian yang Dipercantik --}}
    <section id="katalog" class="mb-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Katalog Produk UMKM</h2>
            <p class="text-gray-600">Cari sembako, jajanan, dan kerajinan favoritmu dengan mudah!</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <form action="/" method="GET" class="flex flex-col lg:flex-row gap-4 items-end">
                {{-- Input Search dengan Icon --}}
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" placeholder="Cari produk, misal: beras atau kue..." 
                           class="w-full pl-10 pr-4 py-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" 
                           value="{{ request('search') }}">
                </div>

                {{-- Select Kategori --}}
                <select name="category" class="w-full lg:w-48 px-4 py-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    <option value="">Semua Kategori</option>
                    {{-- Ambil dari DB nanti: @foreach($categories as $cat) --}}
                    <option value="sembako" {{ request('category') == 'sembako' ? 'selected' : '' }}>Sembako</option>
                    <option value="jajanan" {{ request('category') == 'jajanan' ? 'selected' : '' }}>Jajanan</option>
                    <option value="minuman" {{ request('category') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="kerajinan" {{ request('category') == 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                </select>

                {{-- Select Sorting --}}
                <select name="sort" class="w-full lg:w-32 px-4 py-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    <option value="">Urutkan</option>
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                    <option value="name">Nama A-Z</option>
                </select>

                <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
            </form>
        </div>
    </section>

    {{-- Daftar Produk --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {{-- Loop Produk Dinamis --}}
            @foreach ($products as $product)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:scale-105 transition-all duration-300 animate-fade-in group">
                {{-- Gambar Produk --}}
                <div class="relative h-48 bg-blue-50">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x300/blue/white?text=Produk' }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                    <span class="absolute top-2 right-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full">
                        {{ $product->stock > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                    </span>
                </div>
                <div class="p-5">
                    <span class="inline-block text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full mb-2">
                        {{ $product->category->name ?? '-' }}
                    </span>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $product->description }}</p>
                    <p class="text-xl font-bold text-blue-600 mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    {{-- Form Tambah Keranjang --}}
                    @php
                        // Kelas tombol versi awalmu (sesuaikan jika berbeda)
                        $btnClass = 'inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium';
                    @endphp

                    @if (!Auth::check())
                        <a href="{{ route('login') }}" class="{{ $btnClass }}">
                            Masuk untuk menambahkan
                        </a>
                    @elseif (Auth::user()->role !== 'admin')
                        <form method="POST" action="{{ route('cart.add', ['product' => $product->getRouteKey()]) }}">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="{{ $btnClass }}" aria-label="Tambah ke Keranjang">
                                {{-- Ikon cart --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3h2l.4 2M7 13h9l3-7H6.4M7 13L5.4 5M7 13l-2 9m2-9h10m0 0l-2 9M9 22a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">
            <nav class="flex space-x-2">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">Sebelumnya</button>
                <button class="px-4 py-2 bg-white border border-blue-300 text-blue-600 rounded-lg hover:bg-blue-50 transition duration-300">1</button>
                <button class="px-4 py-2 bg-white border border-blue-300 text-blue-600 rounded-lg hover:bg-blue-50 transition duration-300">2</button>
                <button class="px-4 py-2 bg-white border border-blue-300 text-blue-600 rounded-lg hover:bg-blue-50 transition duration-300">3</button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">Selanjutnya</button>
            </nav>
        </div>
    </section>
</x-app-layout>