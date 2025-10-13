<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Buyer\CartController; 
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Cari keranjang milik user, dan ambil juga relasi item dan produknya
        $cart = Cart::where('user_id', $userId)->with('items.product')->first();
        
        // Kirim data keranjang ke view
        // resources/views/cart.blade.php
        return view('cart', ['cart' => $cart]);
    }

    /**
     * Menambahkan produk ke keranjang.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;
        $quantity = $request->quantity;

        // 1. Cari atau buat keranjang untuk user
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // 2. Cek apakah produk sudah ada di keranjang
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan quantity-nya
            $cartItem->qty += $quantity;
            $cartItem->save();
        } else {
            // Jika belum ada, buat item baru
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'qty' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Mengubah jumlah item di keranjang.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id (ID dari cart_item)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        
        // (Opsional tapi direkomendasikan) Cek apakah item ini milik user yang sedang login
        // ...

        $cartItem->qty = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diubah.');
    }

    /**
     * Menghapus item dari keranjang.
     * @param  int  $id (ID dari cart_item)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);

        // (Opsional tapi direkomendasikan) Cek kepemilikan
        // ...
        
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
