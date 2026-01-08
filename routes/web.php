<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
// Import Controller Admin di sini
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ObatController as AdminObatController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Produk (User)
Route::get('/obat/{id}', [ObatController::class, 'show'])->name('obat.show');

// Route User (Customer)
Route::middleware('jwt.auth')->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('products.keranjang_product');
    Route::get('/pembayaran/{id}', [PesananController::class, 'struk'])->name('pesanan.struk');
    Route::get('/pesanan', [PesananController::class, 'index']);
    Route::get('/pesanan/{id}', [PesananController::class, 'show']);
});

// Route Admin Dashboard
Route::prefix('admin')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Menu Produk (Obat) - Menggunakan Alias AdminObatController agar tidak bentrok dengan ObatController User
    Route::resource('obat', AdminObatController::class);

    // Menu Pemesanan Admin
    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('admin.pesanan.index');
    Route::get('pesanan/{id}', [AdminPesananController::class, 'show'])->name('admin.pesanan.show');
    Route::put('/pesanan/{id}/status', [AdminPesananController::class, 'updateStatus'])->name('admin.pesanan.updateStatus');
});
