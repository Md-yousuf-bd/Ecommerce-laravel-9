<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\Admin\Brand\Index;


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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('other')->middleware(['auth','isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit']);
    Route::put('/category/{category}', [CategoryController::class, 'update']);
    ////product route
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::get('/product-image/{product_image_id}/delete', [ProductController::class, 'destroyImage']);
    Route::get('/products/{product_id}/delete', [ProductController::class, 'destroy']);
    //////state Brand route
    Route::get('/brands',Index::class);
    ////color route
    Route::get('/colors', [ColorController::class, 'index']);
    Route::get('/colors/create', [ColorController::class, 'create']);
    Route::post('/colors/create', [ColorController::class, 'store']);
    Route::get('/colors/{color}/edit', [ColorController::class, 'edit']);
    Route::put('/colors/{color}', [ColorController::class, 'update']);
    Route::get('/colors/{color}/delete',[ColorController::class, 'destroy']);
});

Auth::routes();
