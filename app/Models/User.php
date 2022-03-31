<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Mutator for save name
    public function setNameAttribute($name){
        $this->attributes['name'] = strtolower($name);
    }

    // Accessor for show name
    public function getNameAttribute($name){
        return ucwords($name);
    }

    // Mutator for save email
    public function setEmailAttribute($email){
        $this->attributes['email'] = strtolower($email);
    }

    public function isVerified(){
        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin(){
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode(){
        return Str::random(40);
    }



}// End of User class
