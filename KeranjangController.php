<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan Anda punya model Product

class KeranjangController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        // Ambil data keranjang dari session. Jika tidak ada, gunakan array kosong.
        $cart = session()->get('cart', []);

        $cartItems = [];
        $totalPrice = 0;

        if (is_array($cart)) {
            // Ambil ID produk dari session cart
            $productIds = array_keys($cart);

            // Ambil data produk dari database berdasarkan ID yang ada di keranjang
            $products = Product::whereIn('id', $productIds)->get();

            // Siapkan data untuk ditampilkan di view
            foreach ($products as $product) {
                $quantity = $cart[$product->id]['quantity'];
                $subtotal = $product->price * $quantity;
                $cartItems[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                    // Tambahkan atribut lain jika perlu, misalnya gambar
                    // 'image' => $product->image_url
                ];
                $totalPrice += $subtotal;
            }
        }

        // Kirim data ke view
        return view('keranjang.index', compact('cartItems', 'totalPrice'));
    }

    // Anda juga butuh method untuk menambah, update, dan hapus item
    // Ini adalah contoh sederhana untuk referensi
    public function add(Request $request)
    {
        // Logika untuk menambahkan item ke session 'cart'
        // ...
    }
}