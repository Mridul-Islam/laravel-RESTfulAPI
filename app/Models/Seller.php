<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Seller extends User
{
    use HasFactory;

    protected $table = 'users';

    public function products(){
        return $this->hasMany(Product::class);
    }



}// End of seller class
