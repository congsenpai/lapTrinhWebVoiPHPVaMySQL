<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);  // Một sản phẩm thuộc về một danh mục
    }
}
