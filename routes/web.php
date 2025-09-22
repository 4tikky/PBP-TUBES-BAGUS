<?php

use Illuminate\Support\Facades\Route;
// Import semua controller yang akan Anda buat nanti
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk Pengunjung dan Pengguna
Route::get('/', [HomeController::class, 'index']);

// Rute untuk Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang memerlukan login (Pengguna)
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    // Tambahkan rute lain untuk keranjang (tambah, update, hapus)
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/order', [CheckoutController::class, 'store'])->name('order.store');
});


// Rute untuk Admin
// Grup ini memastikan URL dimulai dengan /admin dan hanya bisa diakses oleh admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Menggunakan resource controller untuk produk (CRUD)
    Route::resource('products', ProductController::class); 
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    // Tambahkan rute lain untuk update status pesanan
});
