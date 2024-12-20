@extends('client.layouts.app')

@section('content')

    <section class="breadcrumb-section set-bg"
        data-setbg="{{ Vite::asset('resources/assets/images/top_banner_shopping_cart.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Lịch sử đơn hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Trang chủ</a>
                            <a href="{{route('order.check')}}">Lịch sử đơn hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="tabs" class="project-tab">
        <div class="container shadow-sm bg-body rounded">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane active show mt-5">
                            @if ($orders == null || $orders->isEmpty())
                                <div class="alert alert-info">Không tìm thấy đơn hàng nào.</div>
                            @else
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Người Đặt Hàng</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Thời gian</th>
                                            <th class="text-center">Phương thức thanh toán</th>
                                            <th class="text-center">Trạng thái</th>
                                            <th class="text-center">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ $order->user->phone }}</td>
                                                <td>{{ date_format($order->created_at, 'd-m-Y / H:i:s') }}</td>
                                                <td class="text-center">{{ $order->payment->payment_method }}
                                                </td>
                                                <td class="text-center">{{ $order->status}}
                                                </td>
                                                
                                                <td class="text-center">{{ number_format($order->total_amount) }}đ</td>
                        </div>


                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        @endif


                    </div>
                </div>
                @if ($orders != null && $orders->isNotEmpty())
                    <div class="text-center">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    </div>

@endsection
