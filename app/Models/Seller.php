<?php

namespace App\Models;

use App\Scopes\SellerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Seller extends User
{
    use HasFactory;

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SellerScope());
    }

    public function products(){
        return $this->hasMany(Product::class);
    }



}// End of seller class
