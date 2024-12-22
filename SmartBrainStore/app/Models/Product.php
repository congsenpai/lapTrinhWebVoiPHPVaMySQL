<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
// app/Models/Product.php
class Product extends Model
{
    use SoftDeletes;
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
    public static function getTopProducts()
    {
        // Truy vấn top 5 sản phẩm bán chạy nhất (theo tổng số lượng và giá trị đơn hàng)
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('order_items.product_id', DB::raw('SUM(order_items.quantity) as total_quantity'), DB::raw('SUM(order_items.quantity * order_items.price) as total_value'))
            ->groupBy('order_items.product_id')
            ->orderByDesc(DB::raw('SUM(order_items.quantity * order_items.price)'))  // Sắp xếp theo tổng giá trị đơn hàng
            ->orderByDesc(DB::raw('SUM(order_items.quantity)'))  // Nếu tổng giá trị bằng nhau, sắp xếp theo tổng số lượng
            ->limit(5)  // Giới hạn kết quả lấy 5 sản phẩm
            ->get();  // Lấy danh sách sản phẩm

        // Lấy thông tin chi tiết của từng sản phẩm
        foreach ($topProducts as $product) {
            $productDetails = Product::with(['images'])->find($product->product_id);  // Lấy thông tin chi tiết sản phẩm
            $product->name = $productDetails->name;  // Lấy tên sản phẩm
            $product->price = $productDetails->price;  // Lấy giá sản phẩm
            $product->stock = $productDetails->stock;  // Lấy số lượng tồn kho
            $product->images = $productDetails->images;  // Lấy hình ảnh sản phẩm // Tổng số lượng bán được
        }

        return $topProducts;
    }
}
