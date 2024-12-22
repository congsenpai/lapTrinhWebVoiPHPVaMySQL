<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// app/Models/PromotionProduct.php
class PromotionProduct extends Model
{
    use SoftDeletes;
    protected $fillable = ['promotion_id', 'product_id'];
}

