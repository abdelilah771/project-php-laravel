<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//products
Route::get('products/category/{id}', [App\Http\Controllers\products\ProductsController::class, 'singleCategory'])->name('single.Category');
Route::get('products/single-product/{id}', [App\Http\Controllers\products\ProductsController::class, 'singleProduct'])->name('single.Product');
Route::get('products/shop', [App\Http\Controllers\products\ProductsController::class, 'shop'])->name('products.shop');

//paiment
Route::post('products/add-cart', [App\Http\Controllers\products\ProductsController::class, 'addToCart'])->name('products.add.cart');
Route::get('products/cart', [App\Http\Controllers\products\ProductsController::class, 'Cart'])->name('products.cart');
Route::get('products/delete-cart{id}', [App\Http\Controllers\products\ProductsController::class, 'deleteFromcart'])->name('products.cart.delete');

//checkout
Route::post('products/prepare-checkout', [App\Http\Controllers\products\ProductsController::class, 'prepareCheckout'])->name('products.prepare.checkout');


Route::get('products/checkout', [App\Http\Controllers\products\ProductsController::class, 'checkout'])->name('products.checkout')->middleware('check.for.price');
Route::post('products/checkout', [App\Http\Controllers\products\ProductsController::class, 'proccessCheckout'])->name('products.proccess.checkout')->middleware('check.for.price');
//pay
Route::get('products/pay', [App\Http\Controllers\products\ProductsController::class, 'payWithPaypal'])->name('products.pay')->middleware('check.for.price');;
Route::get('products/success', [App\Http\Controllers\products\ProductsController::class, 'success'])->name('products.success')->middleware('check.for.price');;

//user
Route::get('users/my-orders', [App\Http\Controllers\Users\UsersController::class, 'MyOrders'])->name('users.orders');
Route::get('users/setting', [App\Http\Controllers\Users\UsersController::class, 'setting'])->name('users.orders');
