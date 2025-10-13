<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">Manajemen Pesanan</h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-green-800 bg-green-100 border border-green-200 px-4 py-2 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">Pembeli</th>
                        <th class="px-4 py-3 text-left">Item</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($orders as $o)
                    <tr class="border-t">
                        <td class="px-4 py-3 font-medium"><a class="text-blue-600 hover:underline" href="{{ route('admin.orders.show', $o) }}">{{ $o->code }}</a></td>
                        <td class="px-4 py-3">{{ $o->user->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $o->items_count }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($o->total, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 capitalize">{{ $o->status }}</td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.orders.update', $o) }}" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="border-gray-300 rounded px-2 py-1">
                                    @foreach (['diproses','dikirim','selesai','batal'] as $st)
                                        <option value="{{ $st }}" @selected($o->status === $st)>{{ ucfirst($st) }}</option>
                                    @endforeach
                                </select>
                                <button class="px-3 py-1 bg-gray-800 text-white rounded">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada pesanan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout>