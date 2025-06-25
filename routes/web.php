<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Form Login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Form Register
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

    // Pembatasan untuk admin
    Route::group(['middleware' => ['auth', 'CekLevel:admin']], function(){
        // Form Dashboard
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        // Form User
        Route::get('/user', [HomeController::class, 'index'])->name('user.index');
        Route::get('/user/create', [HomeController::class, 'create'])->name('user.create');
        Route::post('/user/store', [HomeController::class, 'store'])->name('user.store');

        Route::get('/user/edit/{id}', [HomeController::class, 'edit'])->name('user.edit');
        Route::put('/user/update/{id}', [HomeController::class, 'update'])->name('user.update');
        Route::delete('/user/delete/{id}', [HomeController::class, 'delete'])->name('user.delete');
        
        // Form Produk
        Route::resource('produk', ProdukController::class);
        
        // Form Pelanggan
        Route::resource('pelanggan', PelangganController::class);
        
        // Form Penjualan
        Route::resource('penjualan', PenjualanController::class);

        // Menampilkan Form Pelunasan
        Route::get('/penjualan/{id}/pelunasan', [PenjualanController::class, 'pelunasan'])->name('penjualan.pelunasan');

        // Aksi Form Pelunasan
        Route::put('/penjualan/{id}/lunas', [PenjualanController::class, 'lunas'])->name('penjualan.lunas');

        // Form Kwitansi
        Route::get('/penjualan/{id}/kwitansi', [PenjualanController::class, 'kwitansi'])->name('penjualan.kwitansi');
    });

    // Pembatasan untuk petugas
    Route::group(['middleware' => ['auth', 'CekLevel:petugas,admin']], function(){
        // Form Dashboard
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        
        // Form Produk
        Route::resource('produk', ProdukController::class);
        
        // Form Pelanggan
        Route::resource('pelanggan', PelangganController::class);
        
        // Form Penjualan
        Route::resource('penjualan', PenjualanController::class);

        // Form Pelunasan
        Route::get('/penjualan/{id}/pelunasan', [PenjualanController::class, 'pelunasan'])->name('penjualan.pelunasan');

        // Aksi Form Pelunasan
        Route::put('/penjualan/{id}/lunas', [PenjualanController::class, 'lunas'])->name('penjualan.lunas');

        // Form Kwitansi
        Route::get('/penjualan/{id}/kwitansi', [PenjualanController::class, 'kwitansi'])->name('penjualan.kwitansi');
    });

    // Pembatasan untuk user
    Route::group(['middleware' => ['auth', 'CekLevel:admin,petugas,user']], function(){
        // Form Dashboard
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        // Form Pelanggan
        Route::resource('pelanggan', PelangganController::class);
        
        // Form Penjualan
        Route::resource('penjualan', PenjualanController::class);

        // Form Kwitansi
        Route::get('/penjualan/{id}/kwitansi', [PenjualanController::class, 'kwitansi'])->name('penjualan.kwitansi');
    });