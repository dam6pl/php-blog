<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['display_name', 'login', 'password'];

    public static function isAdmin()
    {
        return (bool)\auth()->user()->is_admin;
    }
}
