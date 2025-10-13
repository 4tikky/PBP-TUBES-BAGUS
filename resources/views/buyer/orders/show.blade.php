<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Detail Pesanan {{ $order->code }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <div><span class="text-gray-500">Tanggal:</span> {{ $order->created_at->format('d M Y H:i') }}</div>
                    <div><span class="text-gray-500">Status:</span> <span class="capitalize">{{ $order->status }}</span></div>
                </div>
                <div>
                    <div><span class="text-gray-500">Nama:</span> {{ $order->receiver_name }}</div>
                    <div><span class="text-gray-500">Alamat:</span> {{ $order->address }}</div>
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
</x-app-layout>