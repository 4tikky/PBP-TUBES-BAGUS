<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Product;
use App\Models\Category;
=======
>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
=======
        //
>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
=======
        //
>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        // 1. Validasi data (termasuk file gambar)
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ]);

        $path = null;
        // 2. Cek jika ada file gambar yang di-upload
        if ($request->hasFile('image')) {
            // 3. Simpan gambar ke storage/app/public/products dan dapatkan path-nya
            $path = $request->file('image')->store('products', 'public');
        }

        // 4. Simpan data ke database
        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'category_id' => $request->category_id,
            'image'       => $path, // Simpan path gambar ke database
        ]);

        // 5. Redirect dengan pesan sukses
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
=======
        //
>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
=======
    public function edit($id)
    {
        //
>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
=======
    public function update(Request $request, $id)
    {
        //
>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
=======
    public function destroy($id)
    {
        //
>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c
    }
}
