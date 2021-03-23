<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Seller\SellerProductController;

/**
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 **/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });

    Route::group(['prefix' => 'seller', 'middleware' => 'role:seller'], function () {
        Route::get('dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');
        Route::group(['prefix' => 'product'], function () {
            Route::get('list', [SellerProductController::class, 'index'])->name('product.list');
            Route::get('crate', [SellerProductController::class, 'create'])->name('create.product');
            Route::post('store', [SellerProductController::class, 'store'])->name('store.product');
            Route::get('edit/{slug}', [SellerProductController::class, 'edit'])->name('edit.product');
            Route::put('update/{product}', [SellerProductController::class, 'update'])->name('update.product');
            Route::delete('delete/{product}', [SellerProductController::class, 'destroy']);
            Route::group(['prefix' => 'order'], function (){
                Route::get('list', [SellerProductController::class, 'orderList'])->name('order.list');
                Route::put('confirm/{order}', [SellerProductController::class, 'confirmOrder']);
            });
        });
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'role:customer'], function () {
        Route::get('dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    });

    Route::delete('delete-image/{image}', [SellerProductController::class, 'deleteImage'])->middleware('role:seller');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('create-order', [CustomerOrderController::class, 'store']);

