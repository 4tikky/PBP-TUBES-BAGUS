@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="text-center mb-10">
    <h1 class="text-4xl font-bold text-gray-900">Katalog Produk</h1>
    <p class="text-gray-600 mt-2">Temukan produk UMKM terbaik di sini.</p>
</div>

{{-- Fitur Pencarian --}}
<div class="mb-8 max-w-2xl mx-auto">
    <form action="/" method="GET" class="flex flex-col sm:flex-row gap-4">
        <input type="text" name="search" placeholder="Cari produk..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select name="category" class="w-full sm:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Kategori</option>
            {{-- Contoh kategori, data ini akan diambil dari DB --}}
            <option value="makanan">Makanan</option>
            <option value="minuman">Minuman</option>
            <option value="kerajinan">Kerajinan</option>
        </select>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">Cari</button>
    </form>
</div>

{{-- Daftar Produk --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    {{-- Contoh data produk, ini akan di-loop dari database --}}
    @for ($i = 1; $i <= 8; $i++)
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <img src="https://placehold.co/600x400/e2e8f0/333?text=Produk+{{$i}}" alt="Gambar Produk" class="w-full h-48 object-cover">
        <div class="p-6">
            <span class="text-sm text-gray-500">Kategori Produk</span>
            <h3 class="text-xl font-bold mt-1 mb-2">Nama Produk {{ $i }}</h3>
            <p class="text-lg font-semibold text-blue-600 mb-4">Rp 50.000</p>
            <form action="/cart/add" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $i }}">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-300">
                    + Tambah ke Keranjang
                </button>
            </form>
        </div>
    </div>
    @endfor
</div>
@endsection
