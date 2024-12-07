<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Order.php
class Order extends Model
{
    protected $fillable = ['user_id', 'total_amount', 'discount', 'coupon_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

