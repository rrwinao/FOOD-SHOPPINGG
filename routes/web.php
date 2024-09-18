<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

// Route default untuk URL root ("/")
Route::get('/', [MenuController::class, 'index']);

// Route resource untuk mengelola menu
Route::resource('menus', MenuController::class);

// Route tambahan untuk halaman checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/menus/{id}/add-to-cart', [App\Http\Controllers\MenuController::class, 'addToCart'])->name('menus.addToCart');
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::post('/cart/add/{menuId}', [MenuController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// web.php
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thankyou');

//unutk barang masuk dan keluar
//Route::post('/menus/{menu}/increase-stock', [MenuController::class, 'increaseStock'])->name('menus.increaseStock');
//Route::post('/menus/{menu}/decrease-stock', [MenuController::class, 'decreaseStock'])->name('menus.decreaseStock');
