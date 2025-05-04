<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

require __DIR__ . "/admin.php";
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/detail/{id}', [HomeController::class, 'productDetail'])->name('productDetail');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/blog',[HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::middleware('auth')->group(function(){
    Route::get('/carts', [CartController::class, 'index'])->name('getCart');
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.delete');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('getCheckout');
    Route::post('checkout', [OrderController::class, 'storeCheckout'])->name('checkout.store');
    Route::get('/confirmation', [OrderController::class, 'getConfirmation'])->name('confirmation');
    Route::post('/finalize/{oid}', [OrderController::class, 'finalize'])->name('order.finalize');
    Route::get('/payment/success', [OrderController::class, 'success'])->name('payment.success');
    Route::get('/payment/failure', [OrderController::class, 'payment.failure'])->name('payment.failure');
    Route::get('/payment/success/page/{orderId}', [OrderController::class, 'successPage'])->name('payment.successPage');
});

Route::middleware(['auth'])->prefix('my-orders')->name('frontend.orders.')->group(function () {
    Route::get('/', [OrderController::class, 'myOrders'])->name('index');
    Route::get('/{id}', [OrderController::class, 'show'])->name('show');
});