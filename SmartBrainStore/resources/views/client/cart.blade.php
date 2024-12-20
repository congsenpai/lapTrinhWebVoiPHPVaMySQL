@extends('client.layouts.app')
@section('content')
    <div class="page-contain shopping-cart">
        <!-- Main content -->
        <div id="main-content" class="main-content" style="padding-bottom:40px">
            <div class="container">

                <!--Cart Table-->
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">Giỏ hàng của bạn</h3>
                            <form class="shopping-cart-form" action="#" method="post">
                                <table class="shop_table cart-form">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Tên sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action="{{ route('cartUpdateAll') }}" method="POST">
                                            @csrf
                                            @foreach ($cartItems as $item)
                                                <tr class="cart_item">
                                                    <!-- Hình ảnh và tên sản phẩm -->
                                                    <td class="product-thumbnail" data-title="Product Name"
                                                        style="display:flex;align-items:center;">
                                                        <div class="action">
                                                            <a href="{{ route('cart.remove', $item->rowId) }}"
                                                                class="remove"><i class="fa-solid fa-trash"></i></a>
                                                        </div>
                                                        <a class="prd-thumb" href="#">
                                                            <figure>
                                                                <img width="113" height="113"
                                                                    src="{{ $item->options->image }}"
                                                                    alt="{{ $item->name }}">
                                                            </figure>
                                                        </a>
                                                        <a class="prd-name" href="#">{{ $item->name }}</a>
                                                    </td>

                                                    <!-- Giá sản phẩm -->
                                                    <td class="product-price" data-title="Price">
                                                        <div class="price price-contain">
                                                            <ins><span class="price-amount"
                                                                    style="color: red">{{ $item->price }}</span></ins>
                                                            <del><span
                                                                    class="price-amount old-price">{{ $item->options->old_price }}</span></del>
                                                        </div>
                                                    </td>

                                                    <!-- Số lượng -->
                                                    <td class="product-quantity" data-title="Quantity">
                                                        <input type="number" name="quantities[{{ $item->rowId }}]"
                                                            value="{{ $item->qty }}" min="1" max="20">
                                                    </td>

                                                    <!-- Tổng giá sản phẩm -->
                                                    <td class="product-subtotal" data-title="Total">
                                                        <div class="price price-contain">
                                                            <ins><span
                                                                    class="price-amount">{{ $item->subtotal }}</span></ins>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="cart_item wrap-buttons">
                                                <td class="wrap-btn-control" colspan="4">
                                                    <a href="{{ route('product') }}" class="btn back-to-shop">Back to
                                                        Shop</a>
                                                    <button class="btn btn-update" type="submit">Update all</button>
                                                    <a class="btn btn-clear" href="{{ route('cart.clear') }}">Clear all</a>
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>

                                </table>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="shpcart-subtotal-block">
                                <div class="subtotal-line">
                                    <b class="stt-name">Tổng tiền hàng <span class="sub">({{ $totalItems }}
                                            items)</span></b>
                                    <span class="stt-price">{{ number_format($subtotal) }}</span>
                                    <!-- Hiển thị tổng tiền sản phẩm -->
                                </div>
                                <div class="subtotal-line">
                                    <b class="stt-name">Phí ship</b>
                                    <span class="stt-price">{{ number_format($shipping) }}</span>
                                    <!-- Hiển thị phí vận chuyển -->
                                </div>
                                <div class="btn-checkout">
                                    <a href="{{route('checkout')}}" class="btn checkout">Check out</a>
                                </div>
                                <div class="biolife-progress-bar">
                                    <table>
                                        <tr>
                                            <td class="first-position">
                                                <span class="index">0</span>
                                            </td>
                                            <td class="mid-position">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $shippingPercent }}" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="last-position">
                                                <span class="index">{{ number_format($subtotal + $shipping) }}</span>
                                                <!-- Hiển thị tổng cộng -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
