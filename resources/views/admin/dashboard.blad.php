@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    {{-- Card Statistik --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-700">Total Produk</h3>
        <p class="text-4xl font-bold mt-2">150</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-700">Pesanan Masuk</h3>
        <p class="text-4xl font-bold mt-2">32</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
        <p class="text-4xl font-bold mt-2">89</p>
    </div>
</div>

<div class="mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Akses Cepat</h2>
    <div class="flex flex-wrap gap-4">
        <a href="/admin/products" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
            Kelola Produk
        </a>
        <a href="/admin/orders" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">
            Kelola Pesanan
        </a>
        <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg">
            Kelola Kategori
        </a>
    </div>
</div>
@endsection
