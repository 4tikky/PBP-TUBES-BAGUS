<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Product; // Pastikan model Product di-import
=======
use App\Models\Product;
use App\Models\Category;
>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c

class HomeController extends Controller
{
    /**
<<<<<<< HEAD
     * Menampilkan halaman utama dengan katalog produk.
     */
    public function index()
    {
        $products = \App\Models\Product::with('category')
                                        ->where('is_active', true)
                                        ->latest()
                                        ->paginate(12);
        
        return view('home', compact('products'));
    }
}
=======
     * Menampilkan halaman utama (katalog produk).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Untuk sementara, kita buat data dummy agar tidak error jika database kosong
        $products = collect([]); // Variabel products harus ada
        $categories = collect([]); // Variabel categories harus ada
        
        // Coba ambil data dari database jika model sudah dibuat
        // try {
        //     $query = Product::where('is_active', true);

        //     if ($request->has('search') && $request->search != '') {
        //         $query->where('name', 'like', '%' . $request->search . '%');
        //     }
    
        //     if ($request->has('category') && $request->category != '') {
        //         $query->where('category_id', $request->category);
        //     }
    
        //     $products = $query->latest()->paginate(8);
        //     $categories = Category::all();
        // } catch (\Exception $e) {
        //     // Biarkan products dan categories kosong jika ada error (misal: tabel belum ada)
        //     // Ini mencegah error saat development awal
        // }

        return view('home', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}

>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c
