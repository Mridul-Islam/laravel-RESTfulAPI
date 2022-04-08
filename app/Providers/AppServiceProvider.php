<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {

    }


    public function boot()
    {
        Schema::defaultStringLength(191);

        Product::updated(function ($product){
            if($product->quantity == 0 && $product->is_available()){
                $product->status = Product::UNAVAILABLE_PRODUCT;
                $product->save();
            }
        });
    }
}
