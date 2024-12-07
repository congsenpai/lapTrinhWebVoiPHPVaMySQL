<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Product.php
class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id', 'brand_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_products');
    }
}
