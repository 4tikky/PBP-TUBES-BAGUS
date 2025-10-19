use App\Http\Controllers\KeranjangController;

// Route untuk menampilkan isi keranjang
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');