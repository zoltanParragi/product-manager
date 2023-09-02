<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelcomeController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\OnlyUsers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

/* Route::get('/get-category-products/{$id}', function($id) {
    dd($id);
})->name('get-category-products'); */

Route::get('/get-category-products/{id}/{referer}', [CategoryController::class, 'get_category_products'])->name('get-category-products');

//Route::get('/get-category-products/{$id}', [CategoryController::class, 'get_category_products'])->name('get-category-products');

Route::group(['middleware' => [OnlyUsers::class]], function() {
    Route::get('/products', [ProductsController::class, 'getproducts'])->name('products');

    Route::get('/add-product', [ProductsController::class, 'get_product_form'])->name('get-product-form');

    Route::post('/add-product', [ProductsController::class, 'add_product'])->name('add-product');

    Route::get('/edit-product/{id}', [ProductsController::class, 'edit_product_form'])->name('edit-product-form');

    Route::post('/edit-product/{id}', [ProductsController::class, 'edit_product'])->name('edit-product');

    Route::get('/delete-product/{id}', [ProductsController::class, 'delete_product'])->name('delete-product');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

