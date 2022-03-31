<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Buyer extends User
{
    use HasFactory;

    protected $table = 'users';

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }



}// End of buyer class
