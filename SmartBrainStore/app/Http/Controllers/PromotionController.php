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
        // In thông tin request để kiểm tra
       // dd($request);

        // Xác thực dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|string|in:percentage,fixed', // Kiểm tra discount_type
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'products' => 'array', // Danh sách sản phẩm
            'applyType' => 'required|string|in:all,specific', // Kiểm tra kiểu áp dụng
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

        // Kiểm tra kiểu áp dụng khuyến mãi
        if ($validated['applyType'] == 'all') {
            // Nếu applyType là 'all', lấy tất cả các sản phẩm từ cơ sở dữ liệu
            $allProducts = Product::all(); // Hoặc thay bằng truy vấn sản phẩm phù hợp
            $productIds = $allProducts->pluck('id')->toArray(); // Lấy tất cả id sản phẩm
        } else {
            // Nếu applyType là 'specific', lấy các sản phẩm được chọn từ request
            $productIds = $validated['products'];
        }

        // Gắn sản phẩm vào khuyến mãi
        if (!empty($productIds)) {
            $promotion->products()->sync($productIds); // Gắn sản phẩm vào khuyến mãi
        }

        // Trả về phản hồi cho client
        return redirect()->route('adminpromotion')->with('success', 'Chương trình khuyến mãi đã được thêm thành công!');
    }

    public function update(Request $request, $id)
    {
        // In thông tin request để kiểm tra
        //dd($request);

        // Validate dữ liệu gửi lên
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|string|in:percentage,fixed', // Giá trị phải là 'percentage' hoặc 'fixed'
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'applyType' => 'required|string|in:all,specific', // Kiểm tra kiểu áp dụng
            'products' => 'nullable|array', // Danh sách ID sản phẩm
            'products.*' => 'exists:products,id', // Mỗi ID phải tồn tại trong bảng products
        ]);

        try {
            // Tìm khuyến mãi cần cập nhật
            $promotion = Promotion::findOrFail($id);

            // Cập nhật thông tin khuyến mãi
            $promotion->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'] ?? null,
                'discount_type' => $validatedData['discount_type'],
                'discount_value' => $validatedData['discount_value'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
            ]);

            // Kiểm tra kiểu áp dụng khuyến mãi
            if ($validatedData['applyType'] == 'all') {
                // Nếu applyType là 'all', lấy tất cả các sản phẩm từ cơ sở dữ liệu
                $allProducts = Product::all(); // Lấy tất cả sản phẩm
                $productIds = $allProducts->pluck('id')->toArray(); // Lấy tất cả id sản phẩm
            } else {
                // Nếu applyType là 'specific', lấy các sản phẩm được chọn từ request
                $productIds = $validatedData['products'] ?? [];
            }

            // Cập nhật danh sách sản phẩm áp dụng khuyến mãi
            if (!empty($productIds)) {
                $promotion->products()->sync($productIds); // Gắn các sản phẩm vào khuyến mãi
            } else {
                $promotion->products()->detach(); // Xóa tất cả sản phẩm nếu không có sản phẩm nào được chọn
            }

            return redirect()->route('adminpromotion')->with('success', 'Chương trình khuyến mãi đã được cập nhật thành công!');
        } catch (\Exception $e) {
            // Xử lý lỗi
            return redirect()->route('adminpromotion')->with('error', 'Có lỗi xảy ra khi cập nhật khuyến mãi!');
        }
    }
}
