<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Owner\UserMenuController;
use App\Http\Controllers\Owner\ProductMenuController;
use App\Http\Controllers\Owner\KategoriController;
use App\Http\Controllers\Owner\TransaksiController;
use App\Http\Controllers\Kasir\KasirTransaksiController;
use App\Http\Controllers\kasir\KategoriKasirController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.process');

// Route Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/Owner/dashboard', [DashboardController::class, 'Owner']);
    Route::get('/Owner/userread', [UserMenuController::class, 'index'])->name('usermenu.index');
    Route::get('/Owner/usercreate', [UserMenuController::class, 'create'])->name('usermenu.create');
    Route::post('/Owner/userstore', [UserMenuController::class, 'store'])->name('usermenu.store');
    Route::get('/Owner/useredit/{email}', [UserMenuController::class, 'edit'])->name('usermenu.edit');
    Route::put('/Owner/userupdate/{email}', [UserMenuController::class, 'update'])->name('usermenu.update'); // Route untuk update
    Route::delete('/Owner/userdelete/{email}', [UserMenuController::class, 'delete'])->name('usermenu.delete');

    Route::resource('Owner/productmenu', ProductMenuController::class);
    Route::get('/Owner/productread', [ProductMenuController::class, 'index'])->name('productmenu.index');
    Route::get('/Owner/productcreate', [ProductMenuController::class, 'create'])->name('productmenu.create');
    Route::post('/Owner/productstore', [ProductMenuController::class, 'store'])->name('productmenu.store');
    Route::get('/Owner/productedit/{id_produk}', [ProductMenuController::class, 'edit'])->name('productmenu.edit');
    Route::put('/Owner/productedit/{id_produk}', [ProductMenuController::class, 'update'])->name('productmenu.update');
    Route::delete('/Owner/productdelete/{id}', [ProductMenuController::class, 'destroy'])->name('productmenu.destroy');

    Route::get('/Owner/kategoriread', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/Owner/kategoricreate', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/Owner/kategoristore', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/Owner/kategoriedit/{kode_kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/Owner/kategoriupdate/{kode_kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/Owner/kategoridelete/{kode_kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/Owner/transaksiread', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/Owner/transaksi/export-excel', [TransaksiController::class, 'exportExcel'])->name('transaksi.export.excel');
    Route::get('/Owner/transaksi/export-pdf', [TransaksiController::class, 'exportPDF'])->name('transaksi.export.pdf');
});

Route::middleware(['auth', 'role:Kasir'])->group(function () {
    Route::get('/kasir/Transaksi', [DashboardController::class, 'kasir']);
    Route::get('/kasir/pos', [KasirTransaksiController::class, 'index'])->name('kasir.pos');
    Route::get('/kasir/kategori/{kode_kategori}', [KasirTransaksiController::class, 'showCategory'])->name('kategori.show');
    Route::post('/kasir/transaksi', [KasirTransaksiController::class, 'store'])->name('kasir.transaksi.store');
    Route::get('/Kasir/history', [KasirTransaksiController::class, 'history'])->name('kasir.transaksi.history');
    Route::get('/Kasir/transaksi/edit/{id_transaksi}', [KasirTransaksiController::class, 'edit'])->name('kasir.transaksi.edit');
    Route::put('/Kasir/transaksi/edit/{id_transaksi}', [KasirTransaksiController::class, 'update'])->name('kasir.transaksi.update');
    Route::delete('/Kasir/transaksi/{id_transaksi}', [KasirTransaksiController::class, 'destroy'])->name('kasir.transaksi.destroy');
});
