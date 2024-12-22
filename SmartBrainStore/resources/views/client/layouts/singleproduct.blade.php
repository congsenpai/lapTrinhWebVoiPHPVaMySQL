@extends('client.layouts.app')
@section('content')
    <div class="page-contain single-product" style="padding-top: 40px">
        <div class="container">
            <!-- Main content -->
            <div id="main-content" class="main-content">
                <!-- summary info -->
                <div class="sumary-product single-layout">
                    <div class="media">
                        @php
                            // Lấy hình ảnh chính của sản phẩm
                            $primaryImage = $product->images->where('is_primary', true)->first();
                            $imageUrl = $primaryImage
                                ? asset('storage/' . $primaryImage->image_url)
                                : asset('resources/images/default-product.jpg');

                            // Lọc các hình ảnh khác ngoài hình ảnh chính
                            $otherImages = $product->images->where('is_primary', false);
                        @endphp

                        <!-- Hình ảnh chính của sản phẩm -->
                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" width="500" height="500"
                            style="object-fit: contain" class="product-thumbnail">

                        <!-- Danh sách các hình ảnh khác (thumbnail) -->
                        <ul class="biolife-carousel slider-nav"
                            data-slick='{"arrows":false,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":4,"slidesToScroll":1,"asNavFor":".slider-for"}'>

                            <!-- Hình ảnh thumbnail khác ngoài hình ảnh chính -->
                            @foreach ($otherImages as $image)
                                <li>
                                    <img src="{{ asset('storage/' . $image->image_url) }}" alt="{{ $product->name }}"
                                        width="88" height="88">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="product-attribute">
                        <h3 class="title">
                            {{ $product->name }}
                        </h3>
                        <div class="rating">
                            <b class="category">Loại: {{ $product->category->name }}</b>
                            <b class="category">Thương hiệu: {{ $product->brand->name }}</b>
                        </div>
                        <p class="excerpt">
                            {{ $product->description }}
                        </p>
                        <div class="price">
                            <ins><span class="price-amount"><span
                                        class="currencySymbol"></span>{{ $product->discounted_price }}</span></ins>
                            <del><span class="price-amount"><span
                                        class="currencySymbol"></span>{{ $product->price }}</span></del>
                        </div>
                        <div class="shipping-info">
                            <p class="shipping-day">Miễn phí ship với đơn hàng từ 99k</p>
                        </div>
                    </div>
                    <div class="action-form">
                        <div class="buttons external-btn">
                            <form action="{{ route('cart.add') }}" method="POST" style="transform: translateX(28%)">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <input type="hidden" name="discounted_price" value="{{ $product->discounted_price }}">
                                <input type="hidden" name="image" value="{{ $imageUrl }}">
                                <button type="submit" class="btn add-to-cart-btn" style="min-width: 120px">Mua ngay</button>
                            </form>

                            <p class="pull-row">
                                <a href="#" class="btn wishlist-btn">wishlist</a>
                                <a href="#" class="btn compare-btn">compare</a>
                            </p>
                        </div>

                        <div class="location-shipping-to">
                            <span class="title">Ship to:</span>
                            <select name="shipping_to" class="country">
                                <option value="-1">Select Country</option>
                                <option value="america">America</option>
                                <option value="france">France</option>
                                <option value="germany">Germany</option>
                                <option value="japan">Japan</option>
                            </select>
                        </div>
                        <div class="social-media">
                            <ul class="social-list">
                                <li><a href="#" class="social-link"><i class="fa-brands fa-twitter"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="#" class="social-link"><i class="fa-brands fa-facebook"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="#" class="social-link"><i class="fa-brands fa-pinterest"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="#" class="social-link"><i class="fa fa-share-alt"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="#" class="social-link"><i class="fa-brands fa-instagram"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="acepted-payment-methods">
                            <ul class="payment-methods">
                                <li><img src="{{ Vite::asset('resources/images/card1.jpg') }}" alt=""
                                        width="51" height="36">
                                </li>
                                <li><img src="{{ Vite::asset('resources/images/card2.jpg') }}" alt=""
                                        width="51" height="36">
                                </li>
                                <li><img src="{{ Vite::asset('resources/images/card3.jpg') }}" alt=""
                                        width="51" height="36">
                                </li>
                                <li><img src="{{ Vite::asset('resources/images/card4.jpg') }}" alt=""
                                        width="51" height="36">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
