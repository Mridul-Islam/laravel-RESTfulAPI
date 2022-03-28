<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Users
Route::resource('/users', UserController::class, ['except'=>['create', 'edit']]);

//Buyers
Route::resource('buyers', BuyerController::class, ['only'=>['index', 'show']]);

//Sellers
Route::resource('sellers', SellerController::class, ['only'=>['index', 'show']]);

//Product
Route::resource('/products', ProductController::class, ['only'=>['index', 'show']]);

//Category
Route::resource('/categories', CategoryController::class, ['except'=>['create', 'edit']]);

//Transaction
Route::resource('/transactions', TransactionController::class, ['only'=>['index', 'show']]);
