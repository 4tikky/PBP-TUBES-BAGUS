<x-app-layout>
    <x-slot name="header"></x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        body.checkout-body { font-family: 'Poppins', sans-serif; background-color: #f4f7f9; color: #333; margin: 0; padding: 24px; }
        .container { max-width: 1000px; margin: auto; }
        .checkout-header { font-size: 28px; font-weight: 600; margin-bottom: 24px; color: #1a202c; text-align: center; }
        .checkout-layout { display: flex; gap: 24px; align-items: flex-start; }
        .customer-details, .order-summary { background: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 24px; }
        .customer-details { flex: 2; }
        .order-summary { flex: 1; position: sticky; top: 24px; }
        .form-section-title { font-size: 20px; font-weight: 600; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid #e0e0e0; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #ccc; font-size: 16px; box-sizing: border-box; }
        .form-group textarea { resize: vertical; min-height: 100px; }
        .summary-title { font-size: 20px; font-weight: 600; margin-bottom: 16px; }
        .summary-item { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 16px; }
        .summary-total { margin-top: 16px; padding-top: 16px; border-top: 1px solid #e0e0e0; display: flex; justify-content: space-between; font-size: 18px; font-weight: 700; }
        .place-order-btn { background-color: #0d6efd; color: white; border: none; padding: 14px; width: 100%; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background-color 0.3s; margin-top: 24px; }
        .place-order-btn:hover { background-color: #0b5ed7; }
        .summary-item-list { border-bottom: 1px solid #e0e0e0; margin-bottom: 16px; padding-bottom: 8px; max-height: 200px; overflow-y: auto; }
        .summary-product { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
        .summary-product img { width: 50px; height: 50px; border-radius: 8px; object-fit: cover; border: 1px solid #eee; }
        .summary-product-details { flex: 1; }
        .summary-product-name { font-weight: 500; font-size: 15px; }
        .summary-product-qty { font-size: 14px; color: #666; }
        .summary-product-price { font-weight: 500; font-size: 15px; }
        .payment-methods { display: flex; gap: 10px; margin-bottom: 16px; }
        .payment-method { flex: 1; padding: 12px; border: 1px solid #ccc; border-radius: 8px; cursor: pointer; text-align: center; transition: all 0.2s; font-weight: 500; }
        .payment-method input[type="radio"] { display: none; }
        .payment-method.selected { border-color: #0d6efd; background-color: #f0f6ff; box-shadow: 0 0 5px rgba(13,110,253,0.3); }
        .payment-method:not(.selected):hover { background-color: #f9f9f9; }

        @media (max-width: 768px) { .checkout-layout { flex-direction: column; } .order-summary { position: static; width: 100%; box-sizing: border-box; } }
    </style>

    <div class="container checkout-body">
        <h1 class="checkout-header"> Checkout</h1>

        <div class="checkout-layout">
            <div class="customer-details">
                <h2 class="form-section-title">Informasi Pengiriman</h2>

                <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama-lengkap">Nama Lengkap</label>
                        <input type="text" id="nama-lengkap" name="nama-lengkap" placeholder="Masukkan nama lengkap Anda" required value="{{ old('nama-lengkap', auth()->user()->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" placeholder="contoh@email.com" required value="{{ old('email', auth()->user()->email) }}">
                    </div>

                    <div class="form-group">
                        <label for="telepon">Nomor Telepon</label>
                        <input type="tel" id="telepon" name="telepon" placeholder="081234567890" required value="{{ old('telepon') }}">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" placeholder="Masukkan nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan" required>{{ old('alamat') }}</textarea>
                    </div>

                    <h2 class="form-section-title" style="margin-top: 24px;">Catatan Pengiriman</h2>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea id="catatan" name="catatan" placeholder="Opsional, misal patokan atau instruksi kurir">{{ old('catatan') }}</textarea>
                    </div>
                    
                    <h2 class="form-section-title" style="margin-top: 24px;">Metode Pembayaran</h2>
                    <div class="payment-methods">
                        <label class="payment-method selected" for="payment-cod">
                            <input type="radio" id="payment-cod" name="payment_method" value="cod" checked>
                            Bayar di Tempat (COD)
                        </label>
                        <label class="payment-method" for="payment-transfer">
                            <input type="radio" id="payment-transfer" name="payment_method" value="transfer">
                            Transfer Bank
                        </label>
                    </div>

                    <h2 class="form-section-title" style="margin-top: 24px;">Opsi Pengiriman</h2>
                    <div class="form-group">
                        <label for="pengiriman">Pilih Jasa Pengiriman</label>
                        <select id="pengiriman" name="pengiriman">
                            <option value="10000" selected>Reguler (Estimasi 2-3 hari) - Rp 10.000</option>
                            <option value="20000">Express (Estimasi 1 hari) - Rp 20.000</option>
                            <option value="30000">Kargo (Estimasi 3-5 hari) - Rp 30.000</option>
                        </select>
                    </div>

                    {{-- Hidden totals for server processing (TIDAK BERUBAH) --}}
                    <input type="hidden" id="subtotal-input" name="subtotal" value="{{ $subtotal }}">
                    <input type="hidden" id="shipping-input" name="shipping_cost" value="10000">
                    <input type="hidden" id="total-input" name="total" value="{{ $subtotal + 10000 }}">
                </form>
            </div>

            <div class="order-summary">
                <h2 class="summary-title">Ringkasan Pesanan</h2>

                <div class="summary-item-list">
                    {{-- Asumsi $items adalah collection dan setiap $item punya relasi 'product' --}}
                    @forelse ($items as $item)
                        <div class="summary-product">
                            {{-- Ganti 'image_url' dengan path gambar produk Anda --}}
                            <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/50' }}" alt="{{ $item->product->name ?? 'Produk' }}">
                            <div class="summary-product-details">
                                <div class="summary-product-name">{{ $item->product->name ?? 'Nama Produk' }}</div>
                                {{-- Ganti 'price' dengan atribut harga produk Anda --}}
                                <div class="summary-product-qty">Rp {{ number_format($item->product->price ?? $item->price, 0, ',', '.') }} x {{ $item->quantity }}</div>
                            </div>
                            <div class="summary-product-price">
                                Rp {{ number_format(($item->product->price ?? $item->price) * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                    @empty
                        <p>Tidak ada item di keranjang.</p>
                    @endforelse
                </div>
                <div class="summary-item">
                    <span>Subtotal ({{ $items->sum('quantity') }} item)</span>
                    <span id="subtotal-amount" data-value="{{ $subtotal }}">
                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </span>
                </div>

                <div class="summary-item">
                    <span>Ongkir</span>
                    <span id="shipping-cost">Rp 10.000</span>
                </div>

                <div class="summary-total">
                    <span>Total Pembayaran</span>
                    <span id="total-payment">
                        Rp {{ number_format($subtotal + 10000, 0, ',', '.') }}
                    </span>
                </div>

                <button class="place-order-btn" type="submit" form="checkout-form">Konfirmasi Pesanan</button>

                <p style="font-size: 14px; color: #666; text-align: center; margin-top: 16px;">
                    Pilih "Transfer Bank" untuk menerima virtual account dan menyelesaikan pembayaran secara mandiri.
                </p>
            </div>
        </div>
    </div>

    <script>
        const shippingSelect = document.getElementById('pengiriman');
        const subtotalElement = document.getElementById('subtotal-amount');
        const shippingCostElement = document.getElementById('shipping-cost');
        const totalPaymentElement = document.getElementById('total-payment');

        const subtotalInput = document.getElementById('subtotal-input');
        const shippingInput = document.getElementById('shipping-input');
        const totalInput = document.getElementById('total-input');

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency', currency: 'IDR', minimumFractionDigits: 0
            }).format(angka).replace('IDR', 'Rp');
        }

        function updateSummary() {
            const subtotal = parseInt(subtotalElement.dataset.value || '0', 10);
            const shippingCost = parseInt(shippingSelect.value || '0', 10);
            const total = subtotal + shippingCost;

            shippingCostElement.textContent = formatRupiah(shippingCost);
            totalPaymentElement.textContent = formatRupiah(total);

            shippingInput.value = shippingCost;
            totalInput.value = total;
        }

        shippingSelect.addEventListener('change', updateSummary);
        updateSummary();

        const paymentMethods = document.querySelectorAll('.payment-method');
        paymentMethods.forEach(method => {
            method.addEventListener('click', () => {
                paymentMethods.forEach(m => m.classList.remove('selected'));
                method.classList.add('selected');
                method.querySelector('input[type="radio"]').checked = true;
            });
        });
    </script>
</x-app-layout>