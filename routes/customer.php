<?php

use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\HomePageController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Middleware\CheckCustomerLoginMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registering'])->name('registering');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loggingIn'])->name('logging_in');
Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('forget_password');
Route::post('/forget-password', [AuthController::class, 'processForgetPassword'])->name('process_forget_password');
Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset_password');
Route::post('reset-password/{token}', [AuthController::class, 'processResetPassword'])->name('process_reset_password');


Route::get('/', [HomePageController::class, 'index'])->name('index');
Route::get('/{product:slug}', [HomePageController::class, 'show'])->name('show');
Route::post('/search', [HomePageController::class, 'search'])->name('search');

Route::group([
    'middleware' => CheckCustomerLoginMiddleware::class,
], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/view/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add_to_cart');
    Route::patch('/update-cart', [CartController::class, 'updateQuantity'])->name('cart.update_quantity');
    Route::delete('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('cart.remove_from_cart');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/check', [ProfileController::class, 'check'])->name('profile.check');
    Route::get('/profile/check/{order_id}', [ProfileController::class, 'checkDetail'])->name('profile.check_detail');
    Route::put('/profile/check/{order}/cancel', [ProfileController::class, 'cancelOrder'])->name('profile.cancel_order');
});
