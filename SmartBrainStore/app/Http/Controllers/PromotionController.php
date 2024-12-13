<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;

class PromotionController extends Controller
{
    public function getPromotions(Request $request)
    {
        // Xây dựng query
        $query = Promotion::query();
        $products = Product::where('status', 'active')->get();
        // Tìm kiếm theo tên hoặc mô tả
        if ($request->has('s') && $request->s !== '') {
            $query->where('name', 'like', '%' . $request->s . '%')
                ->orWhere('description', 'like', '%' . $request->s . '%');
        }

        // Phân trang (nếu cần)
        $promotions = $query->paginate(8); // 8 bản ghi mỗi trang

        // Kiểm tra nếu là AJAX request
        if ($request->ajax()) {
            $html = view('partials.promotion_table', compact('promotions'))->render();

            return response()->json([
                'html' => $html,
            ]);
        }

        // Nếu không phải AJAX, trả về trang chính
        return view('admin.promotion.promotion', compact('promotions', 'products'));
    }
    public function showDetail($id)
    {

        $promotion = Promotion::find($id);
        $product = Product::where('status', 'active')->get();
        if ($promotion) {
            $productsUsingPromotion = $promotion->products->where('status', 'active');
            return response()->json([
                'success' => true,
                'promotion' => $promotion,
                'productsUsingPromotion' => $productsUsingPromotion,
                'product' => $product
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Khuyến mãi không tồn tại.'
        ], 404);
    }
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|string|in:percentage,fixed', // Kiểm tra discount_type
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'products' => 'array', // Danh sách sản phẩm
        ]);

        // Kiểm tra giá trị discount_type có hợp lệ không
        if (!Promotion::isValidDiscountType($validated['discount_type'])) {
            return response()->json(['success' => false, 'message' => 'Loại giảm giá không hợp lệ.'], 400);
        }

        // Tạo mới khuyến mãi
        $promotion = new Promotion();
        $promotion->name = $validated['name'];
        $promotion->description = $validated['description'] ?? '';
        $promotion->discount_type = $validated['discount_type'];
        $promotion->discount_value = $validated['discount_value'];
        $promotion->start_date = $validated['start_date'];
        $promotion->end_date = $validated['end_date'];
        $promotion->save();

        // Gắn sản phẩm vào khuyến mãi
        if (!empty($validated['products'])) {
            $promotion->products()->sync($validated['products']);
        }

        // Trả về phản hồi cho client
        return redirect()->route('adminpromotion')->with('success', 'Chương trình khuyến mãi đã được cập nhật!');
    }
}
