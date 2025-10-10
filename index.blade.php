<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9;
            color: #333;
            margin: 0;
            padding: 24px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 24px;
        }

        .cart-header {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e0e0e0;
            color: #1a202c;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            margin-right: 16px;
            background-color: #0d6efd; /* Placeholder color */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 500;
        }

        .product-details {
            flex-grow: 1;
        }

        .product-name {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .product-price {
            font-size: 16px;
            color: #555;
            margin: 4px 0 0;
        }

        .quantity-control {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            background: #e9ecef;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            color: #555;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin: 0 8px;
            padding: 4px;
            font-size: 16px;
        }

        .product-subtotal {
            font-size: 18px;
            font-weight: 600;
            width: 120px;
            text-align: right;
            margin: 0 16px;
        }

        .remove-btn {
            background: transparent;
            border: none;
            color: #dc3545;
            font-size: 24px;
            cursor: pointer;
        }

        .cart-summary {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e0e0e0;
            text-align: right;
        }

        .total-price {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .checkout-btn {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="cart-header">🛒 Keranjang Belanja Anda</h1>

        @forelse ($cartItems as $item)
            <div class="cart-item">
                <div class="product-image">
                    {{-- <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"> --}}
                    {{ Str::limit($item['name'], 10) }}
                </div>
                <div class="product-details">
                    <p class="product-name">{{ $item['name'] }}</p>
                    <p class="product-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                </div>
                <div class="quantity-control">
                    <button class="quantity-btn">-</button>
                    <input type="text" class="quantity-input" value="{{ $item['quantity'] }}">
                    <button class="quantity-btn">+</button>
                </div>
                <p class="product-subtotal">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                <button class="remove-btn">&times;</button>
            </div>
        @empty
            <div style="text-align: center; padding: 40px; border-bottom: 1px solid #e0e0e0;">
                <p>Keranjang belanja Anda masih kosong.</p>
            </div>
        @endforelse

        <div class="cart-summary">
            <div class="total-price">
                <strong>Total Belanja:</strong> Rp 175.000
            </div>
            <button class="checkout-btn">Lanjutkan ke Pembayaran</button>
        </div>

    </div>

</body>
</html>