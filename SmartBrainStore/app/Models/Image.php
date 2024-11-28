<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = ['product_id', 'image_url', 'is_primary'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
