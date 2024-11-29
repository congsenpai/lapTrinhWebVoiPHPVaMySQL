<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
// app/Models/User.php
class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'phone', 'address', 'role'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    protected $hidden = [
        'password',
    ];
}
