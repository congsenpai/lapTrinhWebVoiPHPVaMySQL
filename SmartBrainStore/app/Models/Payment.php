<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Payment.php
class Payment extends Model
{
    protected $fillable = ['order_id', 'payment_method', 'payment_status', 'amount'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}