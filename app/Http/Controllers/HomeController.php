<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan model Product di-import

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan katalog produk.
     */
    public function index()
    {
        // $products = \App\Models\Product::with('category')
        //                                 ->where('is_active', true)
        //                                 ->latest()
        //                                 ->paginate(12);
        $products = Product::all();
        return view('home', compact('products'));
    }
}
