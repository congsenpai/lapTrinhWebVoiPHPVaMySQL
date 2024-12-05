<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    // Hiển thị form thêm sản phẩm và truyền biến categories và brands sang form
    public function create()
    {
        // Lấy tất cả danh mục
        $categories = Category::all();
        // Lấy tất cả thương hiệu
        $brands = Brand::all();

        // Truyền dữ liệu qua view
        return view('admin.product.addproduct', compact('categories', 'brands'));
    }

    // Lưu sản phẩm mới 
    public function store(Request $request)
    {
        // Các trường bắt buộc
        $requiredFields = ['name', 'price', 'stock', 'category_id', 'brand_id'];

        // Kiểm tra xem có trường nào bị thiếu không
        foreach ($requiredFields as $field) {
            if (!$request->has($field)) {
                // Trả về thông báo lỗi nếu thiếu trường nào đó
                return back()->withErrors([$field => 'Trường ' . $field . ' không được phép bỏ trống.'])->withInput();
            }
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id', // Kiểm tra category_id có tồn tại trong bảng categories
            'brand_id' => 'required|exists:brands,id', // Kiểm tra brand_id có tồn tại trong bảng categories
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Lưu thông tin sản phẩm
        $product = Product::create($request->only(['name', 'description', 'price', 'stock', 'category_id', 'brand_id'])); // Thêm 'category_id' vào mảng

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

        return redirect()->route('adminproduct')->with('success', 'Sản phẩm đã được tạo!');
    }
    // Hiển thị danh sách sản phẩm
    public function index(Request $request)
    {
        $brands = Brand::all(); // Lấy danh sách thương hiệu
        // Lấy danh mục từ database
        $categories = Category::all();
        // Xây dựng query sản phẩm
        $query = Product::query();

        // Tìm kiếm theo tên sản phẩm
        if ($request->has('s') && $request->s !== '') {
            $query->where('name', 'like', '%' . $request->s . '%');
        }
        // Lọc theo loại sản phẩm
        if ($request->has('category') && $request->brand != 'all') {
            $query->where('category_id', $request->category);
        }


        // Lọc theo thương hiệu
        if ($request->has('brand') && $request->brand != 'all') {
            $query->where('brand_id', $request->brand);
        }

        // Lọc theo giá
        if ($request->has('price')) {
            switch ($request->price) {
                case 'class-1st':
                    $query->where('price', '<', 100000);
                    break;
                case 'class-2nd':
                    $query->whereBetween('price', [100000, 200000]);
                    break;
                case 'class-3rd':
                    $query->whereBetween('price', [200000, 500000]);
                    break;
                case 'class-4th':
                    $query->whereBetween('price', [500000, 1000000]);
                    break;
                case 'class-5th':
                    $query->whereBetween('price', [1000000, 2000000]);
                    break;
                case 'class-7th':
                    $query->where('price', '>', 2000000);
                    break;
            }
        }

        // Sắp xếp sản phẩm
        if ($request->has('orderby')) {
            switch ($request->orderby) {
                case 'popularity':
                    $query->orderBy('views', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'date':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('name', 'asc');
                    break;
            }
        }

        // Phân trang
        $products = $query->paginate(9); // 9 sản phẩm mỗi trang

        // Kiểm tra nếu là AJAX request
        if ($request->ajax()) {
            // Render HTML cho các sản phẩm và phân trang
            $productsHtml = view('partials.products', compact('products'))->render();
            $paginationHtml = view('partials.pagination', compact('products'))->render();

            return response()->json([
                'products' => $productsHtml,
                'pagination' => $paginationHtml
            ]);
        }

        // Trả về view chính
        return view('client.product', compact('products', 'brands', 'categories'));
    }
    // Trang chi tiết sản phẩm
    public function showProductDetail($id)
    {
        // Tìm sản phẩm theo ID và lấy thông tin brand, category và images
        $product = Product::with(['brand', 'category', 'images'])->findOrFail($id);

        // Trả về dữ liệu JSON với thông tin sản phẩm, thương hiệu, danh mục và hình ảnh
        return view('client.layouts.singleproduct', ['product' => $product]);
    }
    public function showProductDetailJson($id)
    {
        // Tìm sản phẩm theo ID và lấy thông tin brand, category và images
        $product = Product::with(['brand', 'category', 'images'])->findOrFail($id);

        // Trả về dữ liệu JSON với thông tin sản phẩm, thương hiệu, danh mục và hình ảnh
        return response()->json($product);
    }

    // chức năng dành cho admin 

    // hiển thị form CRUD sản phẩm
    // lấy thông tin sản phẩm, hình ảnh, thương hiệu, loại sản phẩm
    public function getAllProduct(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $brands = Brand::all(); // Lấy danh sách thương hiệu
        // Lấy danh mục từ database
        $categories = Category::all();
        // Xây dựng query sản phẩm
        $query = Product::query();

        // Tìm kiếm theo tên sản phẩm
        if ($request->has('s') && $request->s !== '') {
            $query->where('name', 'like', '%' . $request->s . '%');
        }
        // Lọc theo loại sản phẩm
        if ($request->has('category') && $request->brand != 'all') {
            $query->where('category_id', $request->category);
        }
        // Lọc theo thương hiệu
        if ($request->has('brand') && $request->brand != 'all') {
            $query->where('brand_id', $request->brand);
        }
        // Phân trang
        $products = $query->paginate(9); // 9 sản phẩm mỗi trang

        // Kiểm tra nếu là AJAX request
        if ($request->ajax()) {
            // Render HTML cho các sản phẩm và phân trang
            $productsHtml = view('partials.products', compact('products'))->render();
            $paginationHtml = view('partials.pagination', compact('products'))->render();

            return response()->json([
                'adminproduct' => $productsHtml,
                'pagination' => $paginationHtml
            ]);
        }

        // Trả về view chính
        return view('admin.product.product', compact('products', 'brands', 'categories'));
    }
}
