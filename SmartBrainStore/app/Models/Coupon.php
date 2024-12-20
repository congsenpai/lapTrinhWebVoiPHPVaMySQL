<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = ['code', 'discount_type', 'discount_value', 'usage_limit', 'used_count', 'start_date', 'end_date'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Kiểm tra tính hợp lệ của coupon
    public function isValid()
    {
        // Kiểm tra xem coupon có hết hạn không
        if (Carbon::now()->lt(Carbon::parse($this->start_date))) {
            return false; // Coupon chưa bắt đầu
        }

        if (Carbon::now()->gt(Carbon::parse($this->end_date))) {
            return false; // Coupon đã hết hạn
        }

        // Kiểm tra số lượt sử dụng không vượt quá giới hạn
        if ($this->used_count >= $this->usage_limit) {
            return false; // Số lượt sử dụng đã hết
        }

        return true;
    }

    // Giảm số lượt sử dụng khi coupon được sử dụng
    public function decrementUsage()
    {
        $this->decrement('used_count'); // Giảm số lượt sử dụng
    }
    public function calculateDiscount($totalAmount)
    {
        if ($this->discount_type == 'percentage') {
            // Giảm theo phần trăm
            return $totalAmount * ($this->discount_value / 100);
        }

        if ($this->discount_type == 'fixed') {
            // Giảm theo số tiền cố định
            return $this->discount_value;
        }

        return 0; // Nếu không phải giảm giá hợp lệ, không giảm
    }
}
