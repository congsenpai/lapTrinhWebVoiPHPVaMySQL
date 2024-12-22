<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// app/Models/Promotion.php
class Promotion extends Model
{
    use SoftDeletes;
        protected $fillable = ['name', 'description', 'discount_type', 'discount_value'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_products')->withTimestamps();
    }
    public static function validDiscountTypes(): array
    {
        return ['percentage', 'fixed'];
    }

    public static function isValidDiscountType($discountType): bool
    {
        return in_array($discountType, self::validDiscountTypes());
    }

}
