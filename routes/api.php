<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Employee\CategoryController;
use App\Http\Controllers\Employee\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/employee/categories/get-categories',  [CategoryController::class, 'getCategories']);


Route::post('/employee/products/add-product',  [ProductController::class, 'addProduct']);
Route::get('/employee/products/get-products',  [ProductController::class, 'getProducts']);
Route::post('/employee/products/update-product/{id}',  [ProductController::class, 'updateProduct']);
Route::delete('/employee/products/delete-product/{id}',  [ProductController::class, 'deleteProduct']);



