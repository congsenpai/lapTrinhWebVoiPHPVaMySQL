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
                'product'=>$product
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Khuyến mãi không tồn tại.'
        ], 404);
    }
}
