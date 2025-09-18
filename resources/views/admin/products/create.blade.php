@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
<h1 class="text-3xl font-bold mb-6">Tambah Produk Baru</h1>

<div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
    <form action="/admin/products" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
            <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="category_id" class="block text-gray-700 font-semibold mb-2">Kategori</label>
                <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Kategori</option>
                    {{-- Loop dari DB categories --}}
                    <option value="1">Makanan</option>
                    <option value="2">Minuman</option>
                </select>
            </div>
            <div>
                 <label for="price" class="block text-gray-700 font-semibold mb-2">Harga</label>
                <input type="number" id="price" name="price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
             <div>
                <label for="stock" class="block text-gray-700 font-semibold mb-2">Stok</label>
                <input type="number" id="stock" name="stock" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
             <div>
                <label for="is_active" class="block text-gray-700 font-semibold mb-2">Status</label>
                <select id="is_active" name="is_active" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
        </div>
         <div class="mb-6">
            <label for="image" class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
            <input type="file" id="image" name="image" class="w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
        </div>
        <div class="flex justify-end">
            <a href="/admin/products" class="text-gray-600 py-2 px-4 mr-2">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
