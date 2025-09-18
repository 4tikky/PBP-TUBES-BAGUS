@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
<h1 class="text-3xl font-bold mb-6">Kelola Pesanan</h1>

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3 px-4 font-semibold">ID Pesanan</th>
                    <th class="py-3 px-4 font-semibold">Nama Pelanggan</th>
                    <th class="py-3 px-4 font-semibold">Tanggal</th>
                    <th class="py-3 px-4 font-semibold">Total</th>
                    <th class="py-3 px-4 font-semibold">Status</th>
                    <th class="py-3 px-4 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh data pesanan, akan di-loop dari DB --}}
                @php
                    $statuses = [
                        'diproses' => 'bg-yellow-100 text-yellow-800',
                        'dikirim' => 'bg-blue-100 text-blue-800',
                        'selesai' => 'bg-green-100 text-green-800',
                        'batal' => 'bg-red-100 text-red-800',
                    ];
                    $order_samples = [
                        ['id' => 'ORD-001', 'user' => 'Budi Santoso', 'date' => '17 Sep 2025', 'total' => 'Rp 150.000', 'status' => 'diproses'],
                        ['id' => 'ORD-002', 'user' => 'Ani Wijaya', 'date' => '17 Sep 2025', 'total' => 'Rp 75.000', 'status' => 'dikirim'],
                        ['id' => 'ORD-003', 'user' => 'Citra Lestari', 'date' => '16 Sep 2025', 'total' => 'Rp 220.000', 'status' => 'selesai'],
                        ['id' => 'ORD-004', 'user' => 'Doni Saputra', 'date' => '15 Sep 2025', 'total' => 'Rp 50.000', 'status' => 'batal'],
                    ];
                @endphp
                @foreach($order_samples as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 font-mono">{{ $order['id'] }}</td>
                    <td class="py-3 px-4">{{ $order['user'] }}</td>
                    <td class="py-3 px-4">{{ $order['date'] }}</td>
                    <td class="py-3 px-4">{{ $order['total'] }}</td>
                    <td class="py-3 px-4">
                        <span class="{{ $statuses[$order['status']] }} text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full capitalize">{{ $order['status'] }}</span>
                    </td>
                    <td class="py-3 px-4">
                        <button data-order-id="{{$order['id']}}" class="text-blue-500 hover:text-blue-700">Ubah Status</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
