<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// app/Models/Image.php
class Image extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id', 'image_url', 'is_primary'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
