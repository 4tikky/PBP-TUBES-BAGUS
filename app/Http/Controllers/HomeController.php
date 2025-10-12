<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; // tambahkan

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan katalog + search/filter/sort.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search')); // dari input name="search"
        $cat    = $request->get('category');              // bisa 'sembako' | 1 (id)
        $sort   = $request->get('sort');                  // price_asc|price_desc|name

        $query = Product::with('category');

        // Search (name/description)
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
                if (Schema::hasColumn('products', 'description')) {
                    $q->orWhere('description', 'like', "%{$search}%");
                }
            });
        }

        // Filter kategori: dukung value teks (nama kategori) atau id
        if (!empty($cat)) {
            if (is_numeric($cat)) {
                $query->where('category_id', (int) $cat);
            } else {
                $category = Category::whereRaw('LOWER(name) = ?', [strtolower($cat)])->first();
                if ($category) {
                    $query->where('category_id', $category->id);
                }
            }
        }

        // Sorting
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
        }

        // Pakai get() agar cocok dengan pagination custom di Blade
        $products = $query->get();

        return view('home', compact('products'));
    }
}
