<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
=======
// Import semua controller yang akan Anda buat nanti
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

<<<<<<< HEAD
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
=======
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
>>>>>>> 3d2645c96213ea7fe89bd5755cb38294b4cc4e5c
});

// Rute untuk Pembeli (user)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/buyer/dashboard', [BuyerDashboardController::class, 'index'])->name('buyer.dashboard');
    // Tambahkan rute pembeli lainnya di sini...
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