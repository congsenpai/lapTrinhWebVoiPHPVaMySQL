<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Brand.php
class Brand extends Model
{
    protected $fillable = ['name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
