<?php

use App\Http\Controllers\Backend\EthnicGroupController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\OutfitController;
use App\Http\Controllers\Backend\OutfitMaterialController;
use App\Http\Controllers\Backend\SellerOutfitController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix('admin')->as('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Outfit Routes
    Route::resource('outfits', OutfitController::class);

    // Outfit Material Routes
    Route::resource('outfit-materials', OutfitMaterialController::class);

    // Ethnic Group Routes
    Route::resource('ethnic-groups', EthnicGroupController::class);

    // Sellers Outfit Routes
    Route::resource('sellers-outfits', SellerOutfitController::class);

    // Users Routes
    Route::resource('users', UserController::class);

    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
});
