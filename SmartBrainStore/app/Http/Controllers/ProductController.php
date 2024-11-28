<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // Hiển thị form thêm sản phẩm
    public function create()
    {
        return view('products.create');
    }
    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id', // Kiểm tra category_id có tồn tại trong bảng categories
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Lưu thông tin sản phẩm
        $product = Product::create($request->only(['name', 'description', 'price', 'stock', 'category_id'])); // Thêm 'category_id' vào mảng

        // Lưu hình ảnh nếu có
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $imageFile) {
                // Tạo tên file mới để tránh trùng lặp
                $newFileName = uniqid() . '_' . time() . '.' . $imageFile->getClientOriginalExtension();

                // Lưu file vào thư mục 'products' trong 'storage/app/public'
                $path = $imageFile->storeAs('products', $newFileName, 'public');

                // Lưu thông tin hình ảnh vào bảng 'images'
                Image::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'is_primary' => $key === 0, // Ảnh đầu tiên là ảnh chính
                ]);
            }
        }

        return redirect()->route('product')->with('success', 'Sản phẩm đã được tạo!');
    }
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::with('images')->get();
        return view('products.index', compact('products'));
    }
}
