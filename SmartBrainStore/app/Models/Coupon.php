<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Coupon.php
class Coupon extends Model
{
    protected $fillable = ['code', 'discount_type', 'discount_value', 'usage_limit', 'used_count', 'start_date', 'end_date'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

