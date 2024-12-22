<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
// app/Models/User.php
class User extends Authenticatable
{
    use SoftDeletes;
    protected $fillable = ['name', 'email', 'password', 'phone', 'address', 'role'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected $hidden = [
        'password',
    ];
}
