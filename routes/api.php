<?php

use App\Http\Controllers\Buyer\BuyerCategoryController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Buyer\BuyerTransactionsController;
use App\Http\Controllers\Category\CategoryBuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryProductController;
use App\Http\Controllers\Category\CategorySellerController;
use App\Http\Controllers\Category\CategoryTransactionController;
use App\Http\Controllers\Product\ProductBuyerController;
use App\Http\Controllers\Product\ProductBuyerTransactionController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductTransactionController;
use App\Http\Controllers\Seller\SellerBuyerController;
use App\Http\Controllers\Seller\SellerCategoryController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerTransactionController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionCategoriesController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Users
Route::resource('/users', UserController::class, ['except'=>['create', 'edit']]);

//Buyers
Route::resource('/buyers', BuyerController::class, ['only'=>['index', 'show']]);
Route::resource('/buyer.transactions', BuyerTransactionsController::class, ['only'=>'index']);
Route::resource('/buyer.products', BuyerProductController::class, ['only'=>'index']);
Route::resource('/buyer.sellers', BuyerSellerController::class, ['only'=>'index']);
Route::resource('/buyer.categories', BuyerCategoryController::class, ['only'=>'index']);

//Sellers
Route::resource('sellers', SellerController::class, ['only'=>['index', 'show']]);
Route::resource('/seller.transactions', SellerTransactionController::class, ['only'=>'index']);
Route::resource('/seller.categories', SellerCategoryController::class, ['only'=>'index']);
Route::resource('/seller.buyers', SellerBuyerController::class, ['only'=>'index']);
Route::resource('/seller.products', SellerProductController::class, ['except'=>['create', 'show', 'edit']]);

//Product
Route::resource('/products', ProductController::class, ['only'=>['index', 'show']]);
Route::resource('/product.transactions', ProductTransactionController::class, ['only'=>'index']);
Route::resource('/product.buyers', ProductBuyerController::class, ['only'=>'index']);
Route::resource('/product.categories', ProductCategoryController::class, ['only'=>['index', 'update', 'destroy']]);
Route::resource('/product.buyer.transaction', ProductBuyerTransactionController::class, ['only'=>'store']);

//Category
Route::resource('/categories', CategoryController::class, ['except'=>['create', 'edit']]);
Route::resource('/category.products', CategoryProductController::class, ['only'=>'index']);
Route::resource('/category.sellers', CategorySellerController::class, ['only'=>'index']);
Route::resource('/category.transactions', CategoryTransactionController::class, ['only'=>'index']);
Route::resource('/category.buyers', CategoryBuyerController::class, ['only'=>'index']);

//Transaction
Route::resource('/transactions', TransactionController::class, ['only'=>['index', 'show']]);
Route::resource('/transaction.categories', TransactionCategoriesController::class, ['only'=>'index']);
Route::resource('/transaction.seller', TransactionSellerController::class, ['only'=>'index']);
