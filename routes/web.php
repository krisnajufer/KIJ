<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\GudangController;
use App\Http\Controllers\Admin\CounterController;

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
    });

    Route::controller(CounterController::class)->group(function () {
        Route::get('/counter', 'index')->name('counter');
        Route::post('/counter/destroy', 'destroy')->name('destroy.counter');
        Route::get('/counter/create', 'create')->name('create.counter');
        Route::post('/counter/store', 'store')->name('store.counter');
        Route::get('/counter/edit/{slug}', 'edit');
        Route::post('/counter/update/{slug}', 'update');
    });
});
