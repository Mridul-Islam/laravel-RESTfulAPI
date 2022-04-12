<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserMailChanged;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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

        User::created(function ($user){
            retry(5, function() use($user){
                Mail::to($user)->send(new UserCreated($user));
            }, 200);

        });

        User::updated(function ($user){
            if($user->isDirty('email')){
                retry(5, function () use($user){
                    Mail::to($user)->send(new UserMailChanged($user));
                }, 200);
            }
        });

    }
}
