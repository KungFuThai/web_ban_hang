<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);

Route::resource('products', ProductController::class) -> except('show'); //hỗ trợ viết CRUD gọn hơn (resource controller)
Route::get('products/api', [ProductController::class, 'api'])->name('products.api');

Route::resource('categories', CategoryController::class) -> except('show');
Route::get('categories/api', [CategoryController::class, 'api'])->name('categories.api');

Route::resource('producers', ProducerController::class) -> except('show');
Route::get('producers/api', [ProducerController::class, 'api'])->name('producers.api');

//Route::delete('products/destroy/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
//Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');


Route::get('/admin', function () {
    return view('layout.master');
});
