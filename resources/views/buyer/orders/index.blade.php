<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Pesanan Saya</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">
        @if (session('success'))
            <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded">{{ session('success') }}</div>
        @endif

        @if ($orders->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-600">
                Belum ada pesanan.
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left">Kode</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Item</th>
                            <th class="px-4 py-3 text-left">Total</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $o)
                            <tr class="border-t">
                                <td class="px-4 py-3 font-medium">{{ $o->code }}</td>
                                <td class="px-4 py-3">{{ $o->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3">{{ $o->items_count }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($o->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 capitalize">{{ $o->status }}</td>
                                <td class="px-4 py-3">
                                    <a class="text-blue-600 hover:underline" href="{{ route('buyer.orders.show', $o) }}">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-app-layout>