<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">Detail Pesanan {{ $order->code }}</h2>
    </x-slot>

    <div class="p-6 space-y-6">
        <div class="bg-white rounded-lg shadow p-6 text-sm">
            <div class="grid sm:grid-cols-3 gap-4">
                <div>
                    <div class="text-gray-500">Pembeli</div>
                    <div class="font-medium">{{ $order->user->name ?? '-' }}</div>
                    <div class="text-gray-500 mt-2">Kontak</div>
                    <div>{{ $order->email }} | {{ $order->phone }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Alamat</div>
                    <div>{{ $order->address }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Status</div>
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="flex items-center gap-2 mt-1">
                        @csrf @method('PATCH')
                        <select name="status" class="border-gray-300 rounded px-2 py-1">
                            @foreach (['diproses','dikirim','selesai','batal'] as $st)
                                <option value="{{ $st }}" @selected($order->status === $st)>{{ ucfirst($st) }}</option>
                            @endforeach
                        </select>
                        <button class="px-3 py-1 bg-gray-800 text-white rounded">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Produk</th>
                        <th class="px-4 py-3 text-left">Harga</th>
                        <th class="px-4 py-3 text-left">Qty</th>
                        <th class="px-4 py-3 text-left">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $it)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $it->product->name ?? 'Produk' }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($it->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $it->quantity }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($it->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right font-semibold">Subtotal</td>
                        <td class="px-4 py-3">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right font-semibold">Ongkir</td>
                        <td class="px-4 py-3">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right font-bold">Total</td>
                        <td class="px-4 py-3 font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-admin-layout>