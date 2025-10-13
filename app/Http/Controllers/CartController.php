<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $items = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $items->sum(fn($i) => ($i->product->price ?? 0) * $i->quantity);
        return view('cart.index', compact('items', 'total'));
    }

    /**
     * Menambahkan produk ke keranjang.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, \App\Models\Product $product)
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return back()->with('error', 'Admin tidak dapat menambahkan keranjang.');
        }

        $qtyReq    = max(1, (int) $request->input('quantity', 1));
        $available = (int) $product->stock;

        if ($available <= 0) {
            return back()->with('error', 'Stok produk habis.');
        }

        $cart = \App\Models\Cart::firstOrNew([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        $current = (int) ($cart->exists ? $cart->quantity : 0);
        $newQty  = min($available, $current + $qtyReq);

        if ($newQty === $current) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart->quantity = $newQty;
        $cart->save();

        // Tetap di halaman yang sama dengan notifikasi sukses
        return back()->with('success', 'Ditambahkan ke keranjang.');
    }

    /**
     * Mengubah jumlah item di keranjang.
     * @param  \Illuminate\Http\Request  $request
     * @param  Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cart $item)
    {
        $qtyReq = max(1, (int) $request->input('quantity', 1));
        $available = (int) ($item->product->stock ?? 0);

        if ($available <= 0) {
            $item->delete();
            return back()->with('error', 'Stok produk habis, item dihapus dari keranjang.');
        }

        $newQty = min($available, $qtyReq);
        $item->update(['quantity' => $newQty]);

        $msg = $newQty < $qtyReq ? 'Jumlah dibatasi sesuai stok.' : 'Jumlah diperbarui.';
        return back()->with('success', $msg);
    }

    /**
     * Menghapus item dari keranjang.
     * @param  Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) abort(403);
        $cart->delete();
        return back()->with('success', 'Item dihapus');
    }
}
