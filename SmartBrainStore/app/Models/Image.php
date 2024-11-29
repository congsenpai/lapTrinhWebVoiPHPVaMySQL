<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Image.php
class Image extends Model
{
    protected $fillable = ['product_id', 'image_url', 'is_primary'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
