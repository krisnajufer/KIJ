<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BarangController;

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
        Route::get('/barang/tambah', 'create')->name('tambah.barang');
        Route::get('/barang/destroy/{id}', 'destroy');
        Route::post('/barang/store', 'store')->name('store.barang');
        Route::post('/barang/getGudang', 'getGudang')->name('get.gudang');
        Route::post('/barang/getCounter', 'getCounter')->name('get.counter');
    });
});
