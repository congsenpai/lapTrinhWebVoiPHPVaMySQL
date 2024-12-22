@extends('client.layouts.app')

@section('content')
    <div class="order-details" style="font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; padding: 20px;">
        <h1 style="font-size: 2rem; color: #333; margin-bottom: 20px; text-align: center;">Chi tiết đơn hàng #{{ $order->id }}</h1>

        <div class="user-info" style="margin-bottom: 20px;">
            <p style="font-size: 1.5rem; color: #666; margin: 5px 0;"><strong style="font-weight: bold; color: #333;">Người đặt hàng:</strong> {{ $order->user->name }}</p>
            <p style="font-size: 1.5rem; color: #666; margin: 5px 0;"><strong style="font-weight: bold; color: #333;">Email:</strong> {{ $order->user->email }}</p>
            <p style="font-size: 1.5rem; color: #666; margin: 5px 0;"><strong style="font-weight: bold; color: #333;">Số điện thoại:</strong> {{ $order->user->phone }}</p>
        </div>

        <div class="coupon-info" style="margin-top: 30px;">
            <h3 style="font-size: 1.5rem; color: #555; margin-bottom: 10px;">Thông tin phiếu giảm giá:</h3>
            @if($order->coupon)
                <p style="font-size: 1.5rem; color: #666; margin: 5px 0;">Mã phiếu giảm giá: {{ $order->coupon->code }}</p>
                <p style="font-size: 1.5rem; color: #666; margin: 5px 0;">Giảm giá: {{ number_format($order->coupon->discount_value) }} đ</p>
            @else
                <p style="font-size: 1.5rem; color: #666; margin: 5px 0;">Không có phiếu giảm giá.</p>
            @endif
        </div>

        <div class="order-items" style="margin-top: 30px;">
            <h3 style="font-size: 1.5rem; color: #555; margin-bottom: 10px;">Sản phẩm trong đơn hàng:</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px; background-color: #fff;">
                <thead>
                    <tr style="background-color: #f4f4f4;">
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd; color: #333;">Tên sản phẩm</th>
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd; color: #333;">Số lượng</th>
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd; color: #333;">Giá</th>
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd; color: #333;">Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr style="background-color: #f9f9f9;">
                            <td style="padding: 10px; text-align: left; border: 1px solid #ddd; color: #333;">{{ $item->product->name }}</td>
                            <td style="padding: 10px; text-align: left; border: 1px solid #ddd; color: #333;">{{ $item->quantity }}</td>
                            <td style="padding: 10px; text-align: left; border: 1px solid #ddd; color: #333;">{{ number_format($item->price) }} đ</td>
                            <td style="padding: 10px; text-align: left; border: 1px solid #ddd; color: #333;">{{ number_format($item->quantity * $item->price) }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="payment-info" style="margin-top: 20px; background-color: #e9f7f7; padding: 15px; border-radius: 5px; border: 1px solid #d1e7e7;">
            <h3 style="font-size: 1.5rem; color: #555; margin-bottom: 10px;">Thông tin thanh toán:</h3>
            @if($order->payment)
                <p style="font-size: 1.5rem; color: #666; margin: 5px 0;">Phương thức thanh toán: {{ $order->payment->payment_method }}</p>
                <p style="font-size: 1.5rem; color: #666; margin: 5px 0;">Trạng thái thanh toán: {{ $order->payment->status == 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}</p>
            @else
                <p style="font-size: 1.5rem; color: #666; margin: 5px 0;">Chưa có thông tin thanh toán.</p>
            @endif
        </div>

        <div class="total-amount" style="font-size: 1.8rem; font-weight: bold; color: red; margin-top: 20px;">
            <h3>Tổng tiền:</h3>
            <p>{{ number_format($order->total_amount) }} đ</p>
        </div>
    </div>
@endsection
