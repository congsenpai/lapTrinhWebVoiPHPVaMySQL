<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/PasswordReset.php
class PasswordReset extends Model
{
    protected $fillable = ['email', 'token'];
}

