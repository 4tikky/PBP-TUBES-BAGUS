<x-app-layout>
    <x-slot name="header"></x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        .cart-container { max-width: 900px; margin: 24px auto; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 24px; font-family: 'Poppins', sans-serif; color: #333; }
        .cart-header { font-size: 28px; font-weight: 600; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #e0e0e0; color: #1a202c; }
        .cart-item { display: flex; align-items: center; padding: 16px 0; border-bottom: 1px solid #e0e0e0; }
        .cart-item:last-child { border-bottom: none; }
        .product-image { width: 80px; height: 80px; border-radius: 8px; margin-right: 16px; background-color: #0d6efd; display: flex; align-items: center; justify-content: center; color: white; font-weight: 500; overflow: hidden; }
        .product-image img { width: 100%; height: 100%; object-fit: cover; }
        .product-details { flex-grow: 1; min-width: 0; }
        .product-name { font-size: 18px; font-weight: 600; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .product-price { font-size: 16px; color: #555; margin: 4px 0 0; }
        .quantity-control { display: flex; align-items: center; }
        .quantity-btn { background: #e9ecef; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 18px; cursor: pointer; color: #555; display: inline-flex; align-items: center; justify-content: center; }
        .quantity-input { width: 48px; text-align: center; border: 1px solid #ccc; border-radius: 6px; margin: 0 8px; padding: 4px; font-size: 16px; }
        .product-subtotal { font-size: 18px; font-weight: 600; width: 140px; text-align: right; margin: 0 16px; }
        .remove-btn { background: transparent; border: none; color: #dc3545; font-size: 24px; cursor: pointer; line-height: 1; }
        .cart-summary { margin-top: 24px; padding-top: 24px; border-top: 1px solid #e0e0e0; text-align: right; }
        .total-price { font-size: 22px; font-weight: 700; margin-bottom: 16px; }
        .checkout-btn { background-color: #0d6efd; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background-color 0.3s; }
        .checkout-btn:hover { background-color: #0b5ed7; }
        .empty { text-align: center; padding: 48px 12px; }
        .empty a { display: inline-block; margin-top: 16px; background-color: #0d6efd; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none; }
    </style>

    <div class="cart-container">
        <h1 class="cart-header">🛒 Keranjang Belanja Anda</h1>

        @if($items->isEmpty())
            <div class="empty">
                <h2 class="text-xl font-semibold">Keranjang Anda Kosong</h2>
                <p class="text-gray-600 mt-2">Ayo mulai belanja sekarang!</p>
                <a href="{{ route('home') }}">Kembali ke Katalog</a>
            </div>
        @else
            @foreach($items as $item)
                @php
                    $price = (int) ($item->product->price ?? 0);
                    $qty = (int) $item->quantity;
                    $subtotal = $price * $qty;
                @endphp
                <div class="cart-item">
                    <div class="product-image">
                        @if($item->product->image)
                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                        @else
                            {{ strtoupper(substr($item->product->name,0,1)) }}
                        @endif
                    </div>

                    <div class="product-details">
                        <p class="product-name">{{ $item->product->name }}</p>
                        <p class="product-price">Rp {{ number_format($price, 0, ',', '.') }}</p>
                    </div>

                    <form id="form-{{ $item->id }}" method="POST" action="{{ route('cart.update', $item) }}" class="quantity-control">
                        @csrf
                        @method('PATCH')
                        <button type="button" class="quantity-btn" data-target="qty-{{ $item->id }}" data-form="form-{{ $item->id }}" data-step="-1">-</button>
                        <input id="qty-{{ $item->id }}" class="quantity-input" type="number" name="quantity" value="{{ $qty }}" min="1">
                        <button type="button" class="quantity-btn" data-target="qty-{{ $item->id }}" data-form="form-{{ $item->id }}" data-step="1">+</button>
                    </form>

                    <p class="product-subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>

                    <form method="POST" action="{{ route('cart.remove', $item) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn" title="Hapus">&times;</button>
                    </form>
                </div>
            @endforeach

            <div class="cart-summary">
                <div class="total-price">
                    <strong>Total Belanja:</strong> Rp {{ number_format($total ?? 0, 0, ',', '.') }}
                </div>
                {{-- Ubah tombol jadi link ke checkout --}}
                <a href="{{ route('checkout.index') }}" class="checkout-btn" style="display:inline-block; text-decoration:none;">
                    Lanjutkan ke Pembayaran
                </a>
                {{-- Jika sudah punya route checkout.index, ini akan bekerja --}}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 text-red-700 bg-red-100 px-4 py-2 rounded">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded">{{ session('success') }}</div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.quantity-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.dataset.target;
                const formId = btn.dataset.form;
                const step = parseInt(btn.dataset.step || 1, 10);
                const input = document.getElementById(targetId);
                const form = document.getElementById(formId);
                if (!input || !form) return;

                let val = parseInt(input.value || '1', 10);
                val = isNaN(val) ? 1 : Math.max(1, val + step);
                input.value = val;
                form.submit();
            });
        });
    </script>
</x-app-layout>