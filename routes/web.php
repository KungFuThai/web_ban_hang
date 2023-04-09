<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProducerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\WelcomeController;
use App\Http\Middleware\CheckAdminLoginMiddleware;
use App\Http\Middleware\CheckSuperAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loggingIn'])->name('logging_in');
    Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('forget_password');
    Route::post('/forget-password', [AuthController::class, 'processForgetPassword'])->name('process_forget_password');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset_password');
    Route::post('/reset-password/{token}', [AuthController::class, 'processResetPassword'])->name('process_reset_password');
//end admin auth
    Route::group([
        'middleware' => CheckAdminLoginMiddleware::class,
    ], function () {
        //welcome
        Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
        Route::get('/revenue', [WelcomeController::class, 'getRevenue'])->name('get_revenue');
        //end welcome
        //admin auth
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        //end admin auth

        //product
        Route::get('/products/api', [ProductController::class, 'api'])
            ->name('products.api');
        Route::get('/products/slug', [ProductController::class, 'generateSlug'])
            ->name('products.slug.generate');
        //end slug product
        Route::resource('products', ProductController::class)
            ->except([
                'show',
                'destroy',
            ]); //hỗ trợ viết CRUD gọn hơn (resource controller)
        //end product

        //category
        Route::resource('categories', CategoryController::class)
            ->except([
                'show',
                'destroy',
            ]);
        Route::get('/categories/api', [CategoryController::class, 'api'])
            ->name('categories.api');
        //end category

        //producer
        Route::resource('producers', ProducerController::class)
            ->except([
                'show',
                'destroy',
            ]);
        Route::get('/producers/api', [ProducerController::class, 'api'])
            ->name('producers.api');
        //end producer

        Route::group([
            'as'     => 'orders.',
            'prefix' => 'orders',
        ], function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/create', [OrderController::class, 'create'])
                ->name('create');
            Route::post('/create', [OrderController::class, 'store'])
                ->name('store');
            Route::get('/{order}/edit', [OrderController::class, 'edit'])
                ->name('edit');
            Route::put('/{order}/edit', [OrderController::class, 'update'])
                ->name('update');
            Route::get('/{order}', [OrderController::class, 'show'])
                ->name('show');
        });
        Route::group([
            'middleware' => CheckSuperAdminMiddleware::class,
        ], function () {
            Route::group([
                'as'     => 'admins.',
                'prefix' => 'admins',
            ], function () {
                Route::get('/', [AdminController::class, 'index'])->name('index');
                Route::get('/create', [AdminController::class, 'create'])
                    ->name('create');
                Route::post('/create', [AdminController::class, 'store'])
                    ->name('store');
                Route::get('/{admin}/edit', [AdminController::class, 'edit'])
                    ->name('edit');
                Route::put('/{admin}/edit', [AdminController::class, 'update'])
                    ->name('update');
                Route::get('/{admin}', [AdminController::class, 'update'])
                    ->name('show');
                Route::delete('/{admin}', [AdminController::class, 'destroy'])
                    ->name('destroy');
            });
            //customer

            Route::group([
                'as'     => 'customers.',
                'prefix' => 'customers',
            ], function () {
                Route::get('/api', [CustomerController::class, 'api'])->name('api');
                Route::get('/', [CustomerController::class, 'index'])
                    ->name('index');
                Route::get('/{customer}', [CustomerController::class, 'show'])
                    ->name('show');
                Route::delete('/{customer}', [CustomerController::class, 'destroy'])
                    ->name('destroy');
            });
            //end customer

            Route::delete('producers/{producer}',
                [ProducerController::class, 'destroy'])->name('producers.destroy');
            Route::delete('categories/{category}',
                [CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::delete('products/{product}',
                [ProductController::class, 'destroy'])->name('products.destroy');
        });
    });
});


// //admin auth
//Route::get('/login', [AuthController::class, 'login'])->name('login');
//Route::post('/login', [AuthController::class, 'loggingIn'])->name('logging_in');
// //end admin auth
//Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
//
//Route::group([
//    'middleware' => CheckAdminLoginMiddleware::class,
//], function () {
//    //admin auth
//    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//    //end admin auth
//
//    //product
//    Route::get('/products/api', [ProductController::class, 'api'])
//        ->name('products.api');
//    Route::get('/products/slug', [ProductController::class, 'generateSlug'])
//        ->name('products.slug.generate');
//    //end slug product
//    Route::resource('products', ProductController::class)
//        ->except([
//            'show',
//            'destroy',
//        ]); //hỗ trợ viết CRUD gọn hơn (resource controller)
//    //end product
//
//    //category
//    Route::resource('categories', CategoryController::class)
//        ->except([
//            'show',
//            'destroy',
//        ]);
//    Route::get('/categories/api', [CategoryController::class, 'api'])
//        ->name('categories.api');
//    //end category
//
//    //producer
//    Route::resource('producers', ProducerController::class)
//        ->except([
//            'show',
//            'destroy',
//        ]);
//    Route::get('/producers/api', [ProducerController::class, 'api'])
//        ->name('producers.api');
//    //end producer
//
//    Route::group([
//        'as'     => 'orders.',
//        'prefix' => 'orders',
//    ], function () {
//        Route::get('/', [OrderController::class, 'index'])->name('index');
//        Route::get('/create', [OrderController::class, 'create'])
//            ->name('create');
//        Route::post('/create', [OrderController::class, 'store'])
//            ->name('store');
//        Route::get('/{order}/edit', [OrderController::class, 'edit'])
//            ->name('edit');
//        Route::put('/{order}/edit', [OrderController::class, 'update'])
//            ->name('update');
//        Route::get('/{order}', [OrderController::class, 'update'])
//            ->name('show');
//    });
//    Route::group([
//        'middleware' => CheckSuperAdminMiddleware::class,
//    ], function () {
//        Route::group([
//            'as'     => 'admins.',
//            'prefix' => 'admins',
//        ], function () {
//            Route::get('/', [AdminController::class, 'index'])->name('index');
//            Route::get('/create', [AdminController::class, 'create'])
//                ->name('create');
//            Route::post('/create', [AdminController::class, 'store'])
//                ->name('store');
//            Route::get('/{admin}/edit', [AdminController::class, 'edit'])
//                ->name('edit');
//            Route::put('/{admin}/edit', [AdminController::class, 'update'])
//                ->name('update');
//            Route::get('/{admin}', [AdminController::class, 'update'])
//                ->name('show');
//            Route::delete('/{admin}', [AdminController::class, 'destroy'])
//                ->name('destroy');
//        });
//        //customer
//
//        Route::group([
//            'as'     => 'customers.',
//            'prefix' => 'customers',
//        ], function () {
//            Route::get('/api', [CustomerController::class, 'api'])->name('api');
//            Route::get('/', [CustomerController::class, 'index'])
//                ->name('index');
//            Route::get('/{customer}', [CustomerController::class, 'show'])
//                ->name('show');
//            Route::delete('/{customer}', [CustomerController::class, 'destroy'])
//                ->name('destroy');
//        });
//        //end customer
//
//        Route::delete('producers/{producer}',
//            [ProducerController::class, 'destroy'])->name('producers.destroy');
//        Route::delete('categories/{category}',
//            [CategoryController::class, 'destroy'])->name('categories.destroy');
//        Route::delete('products/{product}',
//            [ProductController::class, 'destroy'])->name('products.destroy');
//    });
//});