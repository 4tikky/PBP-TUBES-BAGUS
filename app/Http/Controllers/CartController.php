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
    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);
        $qty = $data['quantity'] ?? 1;

        $existing = Cart::firstOrNew([
            'user_id' => auth()->id(),
            'product_id' => $data['product_id'],
        ]);
        $existing->quantity = ($existing->exists ? $existing->quantity : 0) + $qty;
        $existing->save();

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang');
    }

    /**
     * Mengubah jumlah item di keranjang.
     * @param  \Illuminate\Http\Request  $request
     * @param  Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) abort(403);
        $data = $request->validate(['quantity' => 'required|integer|min:1']);
        $cart->update(['quantity' => $data['quantity']]);
        return back()->with('success', 'Jumlah diperbarui');
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
