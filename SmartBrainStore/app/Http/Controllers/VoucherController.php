<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use CouponCode\CouponCode;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    public function create()
    {
        return view('admin.voucher.create');
    }
    public function edit(Coupon $voucher)
    {
        return view('admin.voucher.edit', compact('voucher'));
    }
    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'discount_type' => 'required|in:fixed,percentage',
            'discount_value' => 'required|numeric',
            'usage_limit' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ], [
            'discount_type.in' => 'Loại giảm giá phải là "fixed" hoặc "percentage".',
            'discount_value.numeric' => 'Giá trị giảm giá phải là một số.',
            'usage_limit.numeric' => 'Giới hạn sử dụng phải là một số.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'end_date.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
        ]);

        // Tạo mã coupon ngẫu nhiên
        $couponCode = Str::upper(Str::random(8)) . '-' . Str::upper(Str::random(8)) . '-' . Str::upper(Str::random(8));

        // Tạo coupon mới và lưu vào cơ sở dữ liệu
        Coupon::create([
            'code' => $couponCode,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'usage_limit' => $request->usage_limit,
            'used_count' => 0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Trả về thông báo thành công
        return redirect()->route('adminvoucher')->with('success', 'Coupon đã được tạo thành công!');
    }
    public function update(Request $request, Coupon $voucher)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'discount_type' => 'required|in:fixed,percentage',
            'discount_value' => 'required|numeric',
            'usage_limit' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ], [
            'discount_type.in' => 'Loại giảm giá phải là "fixed" hoặc "percentage".',
            'discount_value.numeric' => 'Giá trị giảm giá phải là một số.',
            'usage_limit.numeric' => 'Giới hạn sử dụng phải là một số.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'end_date.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
        ]);

        // Cập nhật coupon với dữ liệu mới
        $voucher->update([
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'usage_limit' => $request->usage_limit,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Trả về thông báo thành công
        return redirect()->route('adminvoucher')->with('success', 'Coupon đã được cập nhật thành công!');
    }
    

    /**
     * Xóa coupon
     */
    public function destroy($id)
    {
        // Tìm coupon theo ID
        $coupon = Coupon::findOrFail($id);

        // Xóa coupon
        $coupon->delete();

        // Trả về thông báo thành công
        return redirect()->route('adminvoucher')->with('success', 'Coupon đã được xóa thành công!');
    }

    /**
     * Hiển thị danh sách coupon
     */
    public function index()
    {
        $vouchers = Coupon::all();
        return view('admin.voucher.list', compact('vouchers'));
    }
}
