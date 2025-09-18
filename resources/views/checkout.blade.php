@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-center">Checkout</h1>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    {{-- Form Alamat --}}
    <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Alamat Pengiriman</h2>
        <form action="/order" method="POST">
            @csrf
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
                <textarea id="address" name="address_text" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan alamat lengkap Anda..." required></textarea>
            </div>
            <p class="text-sm text-gray-500 mb-4">Pastikan alamat yang Anda masukkan sudah benar untuk memudahkan proses pengiriman.</p>
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Buat Pesanan
            </button>
        </form>
    </div>

    {{-- Ringkasan Pesanan --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Ringkasan Pesanan</h2>
        <div class="space-y-3">
            {{-- Loop item dari keranjang --}}
            <div class="flex justify-between">
                <span>Nama Produk 1 (x1)</span>
                <span>Rp 50.000</span>
            </div>
            <div class="flex justify-between">
                <span>Nama Produk 2 (x1)</span>
                <span>Rp 50.000</span>
            </div>
             <div class="flex justify-between">
                <span>Nama Produk 3 (x1)</span>
                <span>Rp 50.000</span>
            </div>
        </div>
        <hr class="my-4">
        <div class="flex justify-between font-bold text-xl">
            <span>Total</span>
            <span class="text-blue-600">Rp 150.000</span>
        </div>
    </div>
</div>
@endsection
