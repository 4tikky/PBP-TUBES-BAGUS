<x-app-layout>
    <x-slot name="header"></x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        .cart-page-body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9;
            color: #333;
            padding: 24px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }

        .cart-layout {
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }
        .cart-main {
            flex: 3;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        .cart-summary-sidebar {
            flex: 1;
            position: sticky;
            top: 24px;
        }
        
        .cart-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 24px;
        }

        .cart-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 0; 
            color: #1a202c;
            text-align: left;
        }
        .cart-description-box {
            background-color: #f0f6ff; 
            border: 1px solid #bde0ff;
            color: #0d6efd;
            padding: 16px;
            border-radius: 8px;
        }

        .cart-table {
            display: flex;
            flex-direction: column;
        }
        
        .cart-header-row {
            display: grid;
            grid-template-columns: auto 3fr 1.5fr 1.5fr 1.5fr 1fr;
            gap: 16px;
            align-items: center;
            padding: 0 16px 16px 16px;
            margin-bottom: 16px;
            border-bottom: 2px solid #e0e0e0;
            font-weight: 600;
            color: #555;
        }
        .cart-header-row .header-product { grid-column: 2; }
        .cart-header-row .header-price,
        .cart-header-row .header-qty,
        .cart-header-row .header-total,
        .cart-header-row .header-action { text-align: left; }

        .store-group {
            margin-bottom: 20px;
        }
        .store-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
        }
        .store-header-name {
            font-weight: 600;
            font-size: 16px;
        }
        .store-header-name span {
            font-weight: 500;
            font-size: 13px;
            padding: 3px 8px;
            background-color: #e9ecef; 
            color: #333;
            border-radius: 6px;
            margin-left: 8px;
        }
        .store-header-link {
            font-size: 14px;
            color: #0d6efd; 
            text-decoration: none;
            font-weight: 500;
        }

        .cart-item-row {
            display: grid;
            grid-template-columns: auto 3fr 1.5fr 1.5fr 1.5fr 1fr;
            gap: 16px;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
        }
        .cart-item-row:last-child {
            border-bottom: none;
        }
        
        .item-product {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .item-product img {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #eee;
        }
        .item-product-details .name { font-weight: 600; font-size: 16px; }
        .item-product-details .variant { font-size: 14px; color: #777; }
        
        .item-price, .item-total-price { font-weight: 500; }

        .item-quantity form {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .item-quantity input[type="number"] {
            width: 60px;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 16px;
            -moz-appearance: textfield;
        }
        .item-quantity input[type="number"]::-webkit-outer-spin-button,
        .item-quantity input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        .update-btn {
            background-color: #0d6efd; 
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }
        .update-btn:hover { background-color: #0b5ed7; }

        .remove-action-btn {
            background: none;
            border: none;
            color: #dc3545; 
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            font-size: 16px;
        }
        .remove-action-btn:hover { text-decoration: underline; }

        .cart-footer-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px;
            margin-top: 16px;
            border-top: 2px solid #e0e0e0;
            font-weight: 500;
        }
        
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #0d6efd; 
        }

        .summary-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 16px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 16px;
        }
        .summary-total {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 700;
        }
        .checkout-btn {
            background-color: #0d6efd; 
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 24px;
            transition: background-color 0.3s;
        }
        .checkout-btn:hover { background-color: #0b5ed7; }
        .checkout-btn.disabled {
            background-color: #ccc;
            cursor: not-allowed;
            color: #888;
        }
        .checkout-btn.disabled:hover {
            background-color: #ccc;
        }

        .empty { text-align: center; padding: 48px 12px; }
        .empty h2 { font-size: 20px; font-weight: 600; }
        .empty p { color: #555; margin-top: 8px; }
        .empty a { display: inline-block; margin-top: 16px; background-color: #0d6efd; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none; }
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.45); display: none; align-items: center; justify-content: center; z-index: 50; }
        .modal-overlay.show { display: flex; }
        .modal-card { width: 100%; max-width: 440px; background: #fff; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,.2); overflow: hidden; }
        .modal-header { padding: 16px 20px; background: #0d6efd; color: #fff; font-weight: 600; }
        .modal-body { padding: 18px 20px; color: #1a202c; }
        .modal-actions { display: flex; gap: 10px; justify-content: flex-end; padding: 16px 20px; background: #f8fafc; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 14px; border-radius: 8px; font-weight: 600; font-size: 14px; border: 1px solid transparent; cursor: pointer; }
        .btn-secondary { background: #e9f0ff; color: #1e40af; border-color: #c7dbff; }
        .btn-secondary:hover { background: #dbe8ff; }
        .btn-danger { background: #dc3545; color: #fff; }
        .btn-danger:hover { background: #c92f3d; }
        
        .session-message {
            margin-bottom: 16px; 
            padding: 12px 16px; 
            border-radius: 8px; 
            font-weight: 500;
        }
        .session-success { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }
        .session-error { background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }

        @media (max-width: 992px) {
            .cart-layout { flex-direction: column; }
            .cart-summary-sidebar { position: static; width: 100%; box-sizing: border-box; }
            .cart-header-row { display: none; } 
            .cart-item-row {
                grid-template-columns: auto 1fr; 
                gap: 10px;
                padding: 16px;
                background: #fdfdfd;
                border: 1px solid #eee;
                border-radius: 8px;
                margin-bottom: 10px;
                position: relative;
            }
            .item-product { grid-column: 2; }
            .item-price, .item-quantity, .item-total-price {
                grid-column: 2; 
                text-align: left;
                padding-left: 82px; 
                font-size: 14px;
            }
            .item-action {
                grid-column: 2;
                position: absolute; 
                top: 16px; 
                right: 16px;
            }
        }
    </style>

    {{-- Wrapper body untuk background --}}
    <div class="cart-page-body">
        <div class="container">
        
            <div class="cart-layout">
                
                <div class="cart-main">
                    <h1 class="cart-title">Keranjang Belanja</h1>
                    
                    {{-- Pesan Session dari kode Anda sebelumnya --}}
                    @if(session('error'))
                        <div class="session-message session-error">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="session-message session-success">{{ session('success') }}</div>
                    @endif
                    
                    <div class="cart-description-box">
                        Periksa kembali produk yang kamu pilih sebelum melanjutkan ke pembayaran dan nikmati promo menarik dari GeraiKita.
                    </div>

                    {{-- Logika Empty Cart dari kode Anda sebelumnya --}}
                    @if($items->isEmpty())
                        <div class="cart-card empty">
                            <h2>Keranjang Anda Kosong</h2>
                            <p>Ayo mulai belanja sekarang!</p>
                            <a href="{{ route('home') }}">Kembali ke Katalog</a>
                        </div>
                    @else
                        <div class="cart-card">
                            <div class="cart-table">
                                <div class="cart-header-row">
                                    <input type="checkbox" id="select-all-header" class="select-all-checkbox">
                                    <div class="header-product">Produk</div>
                                    <div class="header-price">Harga Satuan</div>
                                    <div class="header-qty">Jumlah</div>
                                    <div class="header-total">Total Harga</div>
                                    <div class="header-action">Aksi</div>
                                </div>

                                {{-- Grup per Toko (dari kode baru) --}}
                                {{-- Jika $item->product->store->name tidak ada, '??' akan menanganinya --}}
                                @foreach ($items->groupBy('product.store.name') as $storeName => $storeItems)
                                    <div class="store-group">
                                        <div class="store-header">
                                            <div class="store-header-name">
                                                {{ $storeName ?? 'Toko' }}
                                                <span>Toko Lokal</span>
                                            </div>
                                            <a href="#" class="store-header-link">Kunjungi Toko</a>
                                        </div>

                                        {{-- Loop Item (variabel $item dari kode lama) --}}
                                        @foreach ($storeItems as $item)
                                            @php
                                                // Variabel dari kode lama Anda
                                                $price = (int) ($item->product->price ?? 0);
                                                $qty = (int) $item->quantity;
                                                $subtotal = $price * $qty;
                                            @endphp
                                            <div class="cart-item-row" 
                                                 data-item-id="{{ $item->id }}" 
                                                 data-item-price="{{ $price }}">
                                                
                                                <input type="checkbox" class="item-checkbox" data-item-id="{{ $item->id }}">
                                                
                                                <div class="item-product">
                                                    <div class="product-image">
                                                        @if($item->product->image)
                                                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                                                        @else
                                                            <img src="https://via.placeholder.com/70?text=Produk" alt="{{ $item->product->name }}">
                                                        @endif
                                                    </div>
                                                    <div class="item-product-details">
                                                        <div class="name">{{ $item->product->name }}</div>
                                                        <div class="variant">Variasi: - | Stok: Tersedia</div>
                                                    </div>
                                                </div>

                                                <div class="item-price">
                                                    Rp {{ number_format($price, 0, ',', '.') }}
                                                </div>
                                                
                                                <div class="item-quantity">
                                                    {{-- Form Update (route dari kode lama) --}}
                                                    <form method="POST" action="{{ route('cart.update', $item) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input class="quantity-input" type="number" name="quantity" value="{{ $qty }}" min="1" data-item-id="{{ $item->id }}">
                                                        <button type="submit" class="update-btn">Ubah</button>
                                                    </form>
                                                </div>
                                                
                                                <div class="item-total-price" id="subtotal-{{ $item->id }}">
                                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                                </div>
                                                
                                                <div class="item-action">
                                                    {{-- Form Hapus (route dari kode lama) --}}
                                                    <form method="POST" action="{{ route('cart.remove', $item) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                                class="remove-action-btn btn-delete-item"
                                                                data-product="{{ $item->product->name }}"
                                                                onclick="event.stopPropagation();">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach

                                <div class="cart-footer-row">
                                    <input type="checkbox" id="select-all-footer" class="select-all-checkbox">
                                    <label for="select-all-footer">Pilih Semua ({{ $items->count() }})</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="cart-summary-sidebar">
                    <div class="cart-card">
                        <h2 class="summary-title">Ringkasan Belanja</h2>
                        
                        <div class="summary-item">
                            <span>Total (<span id="selected-count">0</span> produk)</span>
                            <span id="subtotal-price">Rp0</span>
                        </div>

                        <div class="summary-total">
                            <span>Total Belanja</span>
                            <span id="total-price">Rp0</span>
                        </div>
                        
                        {{-- Form Checkout (route dari kode lama) --}}
                        {{-- NOTE: Pastikan controller checkout.index Anda bisa menangani query 'items[]' --}}
                        <form id="checkout-form" action="{{ route('checkout.index') }}" method="GET">
                            {{-- Input tersembunyi untuk 'items[]' akan ditambahkan oleh JS --}}
                        </form>

                        <button id="checkout-button" type="submit" form="checkout-form" class="checkout-btn disabled">
                            Lanjutkan ke Pembayaran
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi (dari kode lama/baru) --}}
    <div id="confirmModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
        <div class="modal-card">
            <div class="modal-header" id="confirmTitle">Konfirmasi Hapus</div>
            <div class="modal-body">
                <p id="confirmText">Apakah Anda yakin ingin menghapus produk ini dari keranjang?</p>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" id="cancelDelete">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const selectAllCheckboxes = document.querySelectorAll('.select-all-checkbox');
            const selectedCountEl = document.getElementById('selected-count');
            const subtotalPriceEl = document.getElementById('subtotal-price');
            const totalPriceEl = document.getElementById('total-price');
            const checkoutButton = document.getElementById('checkout-button');
            const checkoutForm = document.getElementById('checkout-form');
            const quantityInputs = document.querySelectorAll('.quantity-input');

            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency', currency: 'IDR', minimumFractionDigits: 0
                }).format(angka).replace('IDR', 'Rp');
            }

            function updateSummary() {
                let subtotal = 0;
                let totalItems = 0;
                const selectedItemIds = [];

                itemCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const row = checkbox.closest('.cart-item-row');
                        const unitPrice = parseFloat(row.dataset.itemPrice);
                        const quantity = parseInt(row.querySelector('.quantity-input').value, 10);
                        
                        subtotal += unitPrice * quantity;
                        totalItems++;
                        selectedItemIds.push(checkbox.dataset.itemId);
                    }
                });

                selectedCountEl.textContent = totalItems;
                subtotalPriceEl.textContent = formatRupiah(subtotal);
                totalPriceEl.textContent = formatRupiah(subtotal);

                if (totalItems > 0) {
                    checkoutButton.classList.remove('disabled');
                    checkoutButton.disabled = false;
                } else {
                    checkoutButton.classList.add('disabled');
                    checkoutButton.disabled = true;
                }

                checkoutForm.querySelectorAll('input[name="items[]"]').forEach(input => input.remove());
                selectedItemIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'items[]'; // Kirim sebagai array
                    input.value = id;
                    checkoutForm.appendChild(input);
                });
            }

            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    updateSummary();
                    const allChecked = Array.from(itemCheckboxes).every(cb => cb.checked);
                    selectAllCheckboxes.forEach(cb => cb.checked = allChecked);
                });
            });

            selectAllCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', (e) => {
                    const isChecked = e.target.checked;
                    itemCheckboxes.forEach(cb => cb.checked = isChecked);
                    selectAllCheckboxes.forEach(cb => cb.checked = isChecked); 
                    updateSummary();
                });
            });

            quantityInputs.forEach(input => {
                input.addEventListener('change', (e) => { 
                    const row = e.target.closest('.cart-item-row');
                    const unitPrice = parseFloat(row.dataset.itemPrice);
                    const quantity = parseInt(e.target.value, 10);
                    const rowTotalEl = row.querySelector('.item-total-price');
                    
                    if (quantity >= 1) {
                        rowTotalEl.textContent = formatRupiah(unitPrice * quantity);
                    }
                    
                    if (row.querySelector('.item-checkbox').checked) {
                        updateSummary();
                    }
                });

            });

            updateSummary();
            
            (function(){
                let pendingForm = null;

                const modal = document.getElementById('confirmModal');
                if (!modal) return; // Hentikan jika modal tidak ada
                
                const text = document.getElementById('confirmText');
                const btnConfirm = document.getElementById('confirmDelete');
                const btnCancel = document.getElementById('cancelDelete');

                function openModal(message, form) {
                    pendingForm = form;
                    text.textContent = message;
                    modal.classList.add('show');
                }
                function closeModal() {
                    modal.classList.remove('show');
                    pendingForm = null;
                }

                document.querySelectorAll('.btn-delete-item').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        const form = btn.closest('form');
                        const name = btn.getAttribute('data-product') || 'produk ini';
                        openModal(`Apakah Anda yakin ingin menghapus "${name}" dari keranjang?`, form);
                    });
                });

                btnCancel.addEventListener('click', closeModal);
                btnConfirm.addEventListener('click', () => {
                    if (pendingForm) pendingForm.submit();
                });

                modal.addEventListener('click', (e) => {
                    if (e.target === modal) closeModal();
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && modal.classList.contains('show')) closeModal();
                });
            })();
        });
    </script>
</x-app-layout>