<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ubah rute '/' menjadi seperti ini
Route::get('/', [HomeController::class, 'index'])->name('home');

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
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';