<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Employee\CategoryController;
use App\Http\Controllers\Employee\ProductController;


/** Welcome */
Route::get('/', [HomeController::class, 'index']);


/** Admin route */

Route::prefix('admin')->middleware('can:admin-routes')->name('admin.')->group(function () {
    Route::get('/users/index',     [UserController::class, 'getUsers'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}',      [UserController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}',   [UserController::class, 'deleteUser'])->name('users.delete');

});

/** Employee route */

Route::prefix('employee')->middleware('can:employee-routes')->name('employee.')->group(function () {
    Route::resource('/categories', CategoryController::class);
    Route::get('/products',       [ProductController::class, 'index'])->name('products.index');
});


/** Public route */

Route::get('/women', [App\Http\Controllers\WomenController::class, 'index'])->name('women');
Route::get('/women/{category}/{id}', [App\Http\Controllers\ProductController::class, 'getProductsByCategoryId']);

Route::get('/men',   [App\Http\Controllers\MenController::class, 'index'])->name('men');
Route::get('/men/{category}/{id}', [App\Http\Controllers\ProductController::class, 'getProductsByCategoryId']);

Route::get('/kids',  [App\Http\Controllers\KidsController::class, 'index'])->name('kids');
Route::get('/kids/{category}/{id}', [App\Http\Controllers\ProductController::class, 'getProductsByCategoryId']);

Route::get('/get-index',  [App\Http\Controllers\ProductController::class, 'getIndex'])->name('product.index');
Route::get('/add-to-cart/{id}', [App\Http\Controllers\ProductController::class, 'getAddToCart'])->name('product.addToCart');
Route::get('/reduce/{id}',  [App\Http\Controllers\ProductController::class, 'getReduceByOne'])->name('product.reduceByOne');
Route::get('/remove/{id}',  [App\Http\Controllers\ProductController::class, 'getRemoveitem'])->name('product.remove');

Route::get('/shopping-cart',  [App\Http\Controllers\ProductController::class, 'getCart'])->name('product.shoppingCart');
Route::get('/checkout',  [App\Http\Controllers\ProductController::class, 'getCheckout'])->name('product.checkout');
Route::post('/checkout',  [App\Http\Controllers\ProductController::class, 'postCheckout'])->name('product.buyNow');


Route::get('/show-order',  [App\Http\Controllers\UserController::class, 'getProfile'])->name('user.profile');

/** Login route */

Auth::routes();
Route::get('/admin/index', [App\Http\Controllers\HomeController::class, 'getAdminIndex'])->middleware('can:admin-routes')->name('admin.index');
Route::get('/employee/index', [App\Http\Controllers\HomeController::class, 'getEmployeeIndex'])->middleware('can:employee-routes')->name('employee.index');

Route::get('/home',           [App\Http\Controllers\HomeController::class, 'index'])->name('home');
