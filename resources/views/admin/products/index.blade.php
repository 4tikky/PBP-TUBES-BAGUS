@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Kelola Produk</h1>
    <a href="/admin/products/create" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
        + Tambah Produk Baru
    </a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3 px-4 font-semibold">Nama Produk</th>
                    <th class="py-3 px-4 font-semibold">Kategori</th>
                    <th class="py-3 px-4 font-semibold">Harga</th>
                    <th class="py-3 px-4 font-semibold">Stok</th>
                    <th class="py-3 px-4 font-semibold">Status</th>
                    <th class="py-3 px-4 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh data produk, akan di-loop dari DB --}}
                @for ($i = 1; $i <= 5; $i++)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">Nama Produk {{ $i }}</td>
                    <td class="py-3 px-4">Makanan</td>
                    <td class="py-3 px-4">Rp 50.000</td>
                    <td class="py-3 px-4">100</td>
                    <td class="py-3 px-4">
                        <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Aktif</span>
                    </td>
                    <td class="py-3 px-4 flex gap-2">
                        <a href="/admin/products/{{$i}}/edit" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                        <form action="/admin/products/{{$i}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection
