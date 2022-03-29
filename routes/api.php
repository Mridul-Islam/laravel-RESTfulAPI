<?php

use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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
