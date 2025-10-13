@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<h1 class="text-3xl font-bold mb-6">Keranjang Belanja Anda</h1>

<div class="bg-white rounded-lg shadow-md p-6">
    @if(true) {{-- Ganti dengan kondisi jika keranjang tidak kosong --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-3 px-4 font-semibold">Produk</th>
                        <th class="py-3 px-4 font-semibold">Harga</th>
                        <th class="py-3 px-4 font-semibold">Kuantitas</th>
                        <th class="py-3 px-4 font-semibold">Subtotal</th>
                        <th class="py-3 px-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh data item keranjang, akan di-loop dari DB --}}
                    @for ($i = 1; $i < 4; $i++)
                    <tr class="border-b">
                        <td class="py-3 px-4 flex items-center">
                            <img src="https://placehold.co/100x100/e2e8f0/333?text=Produk" alt="Produk" class="w-16 h-16 rounded-md mr-4">
                            <span>Nama Produk {{ $i }}</span>
                        </td>
                        <td class="py-3 px-4">Rp 50.000</td>
                        <td class="py-3 px-4">
                            <form action="/cart/update/{{$i}}" method="POST" class="flex items-center">
                                @csrf
                                <input type="number" name="qty" value="1" class="w-16 text-center border border-gray-300 rounded-md">
                                {{-- Tombol update bisa ditambahkan di sini --}}
                            </form>
                        </td>
                        <td class="py-3 px-4">Rp 50.000</td>
                        <td class="py-3 px-4">
                            <form action="/cart/remove/{{$i}}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-col md:flex-row justify-between items-center">
            <div class="text-2xl font-bold">
                Total: <span class="text-blue-600">Rp 150.000</span>
            </div>
            <a href="/checkout" class="mt-4 md:mt-0 w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white font-semibold text-center py-3 px-6 rounded-lg transition duration-300">
                Lanjutkan ke Checkout
            </a>
        </div>
    @else
        <div class="text-center py-12">
            <h2 class="text-2xl font-semibold">Keranjang Anda Kosong</h2>
            <p class="text-gray-600 mt-2">Ayo mulai belanja sekarang!</p>
            <a href="/" class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                Kembali ke Katalog
            </a>
        </div>
    @endif
</div>

<div class="bg-white rounded-lg shadow-md p-6 mt-6">
    <h2 class="text-2xl font-bold mb-4">Tambah Produk ke Keranjang</h2>
    <form action="{{ route('cart.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="flex items-center mb-4">
            <label for="quantity" class="mr-2">Kuantitas:</label>
            <input type="number" name="quantity" value="1" min="1" class="w-16 text-center border border-gray-300 rounded-md">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
            Tambah ke Keranjang
        </button>
    </form>
</div>
@endsection
