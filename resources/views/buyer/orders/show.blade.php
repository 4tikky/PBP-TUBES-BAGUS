<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Detail Pesanan {{ $order->code ?? ('#'.$order->id) }}</h2>
    </x-slot>

    <style>
        .order-item-thumb{width:56px;height:56px;border-radius:8px;object-fit:cover;object-position:center;flex:0 0 56px}
        .order-item-placeholder{width:56px;height:56px;border-radius:8px;display:flex;align-items:center;justify-content:center;background:#e5e7eb;color:#4b5563}
    </style>

    <div class="max-w-7xl mx-auto p-6 space-y-6">
        @if (session('success'))
            <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded">{{ session('success') }}</div>
        @endif

        @php
            $status = $order->status ?? 'diproses';
            $statusClass = match ($status) {
                'diproses' => 'bg-blue-100 text-blue-800',
                'dikirim'  => 'bg-amber-100 text-amber-800',
                'selesai'  => 'bg-green-100 text-green-800',
                'batal'    => 'bg-red-100 text-red-800',
                default    => 'bg-gray-100 text-gray-800',
            };
            $alamat = $order->address ?? $order->address_text ?? '-';
        @endphp

        {{-- Ringkasan Pesanan --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid md:grid-cols-3 gap-6 text-sm">
                <div>
                    <div class="text-gray-500">Kode Pesanan</div>
                    <div class="font-medium">{{ $order->code ?? ('#'.$order->id) }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Tanggal</div>
                    <div>{{ optional($order->created_at)->format('d M Y H:i') }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Status</div>
                    <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                        {{ ucfirst($status) }}
                    </span>
                </div>
                <div>
                    <div class="text-gray-500">Metode Pengiriman</div>
                    <div class="font-medium">{{ $order->shipping_service ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Penerima</div>
                    <div>{{ $order->receiver_name ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Kontak</div>
                    <div>{{ $order->email ?? '-' }} @if(!empty($order->phone)) • {{ $order->phone }} @endif</div>
                </div>
                <div class="md:col-span-3">
                    <div class="text-gray-500">Alamat</div>
                    <div class="whitespace-pre-line">{{ $alamat }}</div>
                </div>
            </div>
        </div>

        {{-- Daftar Item --}}
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
                    @forelse ($order->items as $it)
                        @php
                            $p = $it->product;
                            $name = $p->name ?? 'Produk';
                            $img = $p?->image ? asset('storage/'.$p->image) : null;
                        @endphp
                        <tr class="border-t">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($img)
                                        <img src="{{ $img }}" alt="{{ $name }}" class="order-item-thumb" loading="lazy">
                                    @else
                                        <div class="order-item-placeholder">
                                            {{ strtoupper(mb_substr($name,0,1)) }}
                                        </div>
                                    @endif
                                    <div class="font-medium">{{ $name }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">Rp {{ number_format($it->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $it->quantity }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($it->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">Tidak ada item.</td></tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right font-semibold">Subtotal</td>
                        <td class="px-4 py-3">Rp {{ number_format($order->subtotal ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right font-semibold">Ongkir</td>
                        <td class="px-4 py-3">Rp {{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right font-bold">Total</td>
                        <td class="px-4 py-3 font-bold">Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-app-layout>