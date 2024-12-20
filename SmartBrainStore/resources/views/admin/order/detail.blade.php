@extends('admin.layouts.app')

@section('content')
    <h1>Chi tiết đơn hàng #{{ $order->id }}</h1>

    <p><strong>Người đặt hàng:</strong> {{ $order->user->name }}</p>
    <p><strong>Email:</strong> {{ $order->user->email }}</p>
    <p><strong>Số điện thoại:</strong> {{ $order->user->phone }}</p>

    <h3>Thông tin phiếu giảm giá:</h3>
    @if($order->coupon)
        <p>Mã phiếu giảm giá: {{ $order->coupon->code }}</p>
        <p>Giảm giá: {{ number_format($order->coupon->discount_value) }} đ</p>
    @else
        <p>Không có phiếu giảm giá.</p>
    @endif

    <h3>Sản phẩm trong đơn hàng:</h3>
    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }} đ</td>
                    <td>{{ number_format($item->quantity * $item->price) }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Thông tin thanh toán:</h3>
    @if($order->payment)
        <p>Phương thức thanh toán: {{ $order->payment->method }}</p>
        <p>Trạng thái thanh toán: {{ $order->payment->status == 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}</p>
    @else
        <p>Chưa có thông tin thanh toán.</p>
    @endif
    <h3>Tổng tiền:</h3>
    <p>{{ number_format($order->total_amount) }} đ</p>
@endsection
