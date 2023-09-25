<?php

use App\Http\Controllers\AccessGroupController;
use App\Http\Controllers\AccessMasterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MintaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [AuthController::class, 'index'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('barang/datatable', [BarangController::class, 'datatable'])->name('barang.datatable');
    Route::resource('barang', BarangController::class);

    Route::get('access_groups/datatable', [AccessGroupController::class, 'datatable'])->name('access_groups.datatable');
    Route::resource('access_groups', AccessGroupController::class);

    Route::get('access_masters/datatable', [AccessMasterController::class, 'datatable'])->name('access_masters.datatable');
    Route::resource('access_masters', AccessMasterController::class);

    Route::get('users/datatable', [UserController::class, 'datatable'])->name('users.datatable');
    Route::resource('users', UserController::class);

    Route::get('orders/datatable', [OrderController::class, 'datatable'])->name('orders.datatable');
    Route::resource('orders', OrderController::class);

    Route::get('minta/datatable', [MintaController::class, 'datatable'])->name('minta.datatable');
    Route::resource('minta', MintaController::class);
});

Auth::routes();

