<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController;
<<<<<<< HEAD
use App\Http\Controllers\CartController;
=======
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;
>>>>>>> main

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Home
Route::get('/', [HomeController::class, 'index'])->name('home');

<<<<<<< HEAD
// Rute untuk Admin

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductController::class)->names('admin.products');
    // DITAMBAHKAN: Rute untuk menampilkan form tambah produk
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');

    //Rute untuk menampilkan & update pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');

    //Rute untuk menampilkan pelanggan
    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
});

// Rute untuk Pembeli (user)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/buyer/dashboard', [BuyerDashboardController::class, 'index'])->name('buyer.dashboard');
    // Tambahkan rute pembeli lainnya di sini...

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Tambahkan route khusus untuk add to cart
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
});

//Rute untuk halaman "Tentang Kami"
=======
// Rute Tentang Kami
>>>>>>> main
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

// Rute Keranjang (wajib login)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Profile (untuk link profile.edit di layout)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk Pembeli (user)
Route::prefix('buyer')->name('buyer.')->middleware(['auth','role:user'])->group(function () {
    Route::get('/dashboard', [BuyerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [BuyerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [BuyerOrderController::class, 'show'])->name('orders.show');
});

// Rute untuk Admin

Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class); // -> admin.products.index,create,store,…
    Route::resource('orders', AdminOrderController::class)->only(['index','show','update']); // tambahkan update
    Route::resource('customers', CustomerController::class)->only(['index','show']);   // opsional, sesuai sidebar
});

require __DIR__.'/auth.php';
