<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\GudangController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\Permintaan\PermintaanController;
use App\Http\Controllers\Admin\Pengiriman\PengirimanController;
use App\Http\Controllers\Admin\Penerimaan\PenerimaanController;
use App\Http\Controllers\Admin\TransaksiPenjualan\TransaksiPenjualanController;
use App\Http\Controllers\Admin\Klasifikasi\KlasifikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::controller(UserAuthController::class)->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'login')->name('auth.login');
        Route::get('/', function () {
            return view('auth.login');
        });
    });

    Route::middleware('admin')->group(function () {
        Route::post('/logout', 'logout')->name('auth.logout');
    });
});

Route::middleware('admin')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(BarangController::class)->group(function () {
        Route::get('/barang', 'index')->name('barang');
        Route::get('/barang/create', 'create')->name('create.barang');
        Route::post('/barang/destroy', 'destroy')->name('destroy.barang');
        Route::post('/barang/store', 'store')->name('store.barang');
        Route::post('/barang/getGudang', 'getGudang')->name('get.gudang');
        Route::post('/barang/getCounter', 'getCounter')->name('get.counter');
        Route::get('/barang/edit/{slug}', 'edit');
        Route::post('/barang/update/{slug}', 'update');
    });

    Route::controller(GudangController::class)->group(function () {
        Route::get('/gudang', 'index')->name('gudang');
        Route::get('/gudang/edit/{slug}', 'edit');
        Route::post('/gudang/update/{slug}', 'update');
    });

    Route::controller(CounterController::class)->group(function () {
        Route::get('/counter', 'index')->name('counter');
        Route::post('/counter/destroy', 'destroy')->name('destroy.counter');
        Route::get('/counter/create', 'create')->name('create.counter');
        Route::post('/counter/store', 'store')->name('store.counter');
        Route::get('/counter/edit/{slug}', 'edit');
        Route::post('/counter/update/{slug}', 'update');
    });

    Route::controller(PermintaanController::class)->group(function () {
        Route::get('/permintaan', 'index')->name('permintaan');
        Route::get('/permintaan/create', 'create')->name('create.permintaan');
        Route::post('/permintaan/temporary', 'temporary')->name('temporary.permintaan');
        Route::post('/permintaan/temporary/delete', 'destroyTemporary')->name('destroy.temporary.permintaan');
        Route::get('/permintaan/store/{kode}', 'store');
        Route::get('/permintaan/cancel', 'cancelCreate')->name('cancel.create.permintaan');
        Route::get('/permintaan/show/{slug}', 'show');
        Route::get('/permintaan/create/persetujuan/{slug}/{id_barang}', 'createPersetujuan');
        Route::post('/permintaan/get/sumber', 'getGudangorCounter')->name('get.GudangorCounter');
        Route::post('/permintaan/temporary/persetujuan', 'temporaryPersetujuan')->name('temporary.persetujuan');
        Route::get('/permintaan/store/pengiriman/{permintaan_id}', 'storePengiriman');
    });

    Route::controller(PengirimanController::class)->group(function () {
        Route::get('/pengiriman', 'index')->name('pengiriman');
        Route::get('/pengiriman/show/{slug}', 'show');
    });

    Route::controller(PenerimaanController::class)->group(function () {
        Route::get('/penerimaan', 'index')->name('penerimaan');
        Route::get('/penerimaan/store/{slug}', 'store');
    });

    Route::controller(TransaksiPenjualanController::class)->group(function () {
        Route::get('/kasir', 'index')->name('kasir');
        Route::post('/kasir/add', 'addTemporaryKeranjang')->name('temporary.keranjang');
        Route::post('/kasir/destroy', 'destroyTemporaryKeranjang')->name('destroy.temporary.keranjang');
        Route::get('/kasir/store', 'store')->name('store.transaksi');
        Route::get('/transaksi', 'indexTransaksi')->name('index.transaksi');
        Route::get('/transaksi/detail/{slug}', 'show');
    });

    Route::controller(KlasifikasiController::class)->group(function () {
        Route::get('/klasifikasi', 'index')->name('klasifikasi');
        Route::get('/klasifikasi/create', 'create')->name('create.klasifikasi');
        Route::post('/klasifikasi/create/sample', 'createSampleKlasifikasi')->name('create.sample.klasifikasi');
        Route::post('/klasifikasi/store', 'store')->name('store.klasifikasi');
    });
});
