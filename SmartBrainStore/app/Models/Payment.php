<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// app/Models/Payment.php
class Payment extends Model
{
    use SoftDeletes;
    protected $fillable = ['order_id', 'payment_method', 'payment_status', 'amount'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
