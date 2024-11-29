<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Promotion.php
class Promotion extends Model
{
    protected $fillable = ['name', 'description', 'discount_type', 'discount_value', 'start_date', 'end_date'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_products');
    }
}
