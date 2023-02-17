<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


// login , register
Route::middleware('admin_auth')->group(function () {
    Route::redirect('/', 'loginPage');

    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // admin
    Route::middleware('admin_auth')->group(function () {
        // categiry
        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        // admin account
        Route::prefix('admin')->group(function () {
            // password
            Route::get('password/changePage', [AdminController::class, 'passwordChangePage'])->name('admin#passwordChangePage');
            Route::post('change/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');

            // profile
            Route::get('details', [AdminController::class, 'detail'])->name('admin#details');
            Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');

            // admin list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}', [AdminController::class, 'change'])->name('admin#change');
        });

        // products
        Route::prefix('products')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('products#list');
            Route::get('create', [ProductController::class, 'createPage'])->name('products#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('products#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('products#delete');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products#edit');
            Route::get('updatePage/{id}', [ProductController::class, 'updatePage'])->name('products#updatePage');
            Route::post('update', [ProductController::class, 'update'])->name('products#update');
        });
    });

    // user
    // home
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {

        Route::get('home', [UserController::class, 'home'])->name('user#home');

        // filter
        Route::get('filter/{id}', [UserController::class, 'filter'])->name('user#filter');

        // details
        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class, 'pizzaDetails'])->name('user#pizzaDetails');
        });

        // cart
        Route::prefix('cart')->group(function () {
            Route::get('list', [UserController::class, 'cartList'])->name('user#cartList');
        });

        // password
        Route::prefix('password')->group(function () {
            Route::get('change', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change', [UserController::class, 'changePassword'])->name('user#changePassword');
        });

        // profile
        Route::prefix('account')->group(function () {
            Route::get('change', [UserController::class, 'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}', [UserController::class, 'accountChange'])->name('user#accountChange');
        });

        // ajax
        Route::prefix('ajax')->group(function () {
            Route::get('pizzaList', [AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
        });
    });
});
