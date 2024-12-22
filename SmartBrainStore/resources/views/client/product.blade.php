@extends('client.layouts.app')
@section('content')
    @include('client.layouts.product')
    <style>
        li {
            list-style-type: none
        }
    </style>
    <div class="widget biolife-filter">
        <h4 class="wgt-title" style="font-size: 30px;transform: translateX(35%);">Top Sản Phẩm Bán Chạy Nhất</h4>
        <div class="wgt-content" style="padding-top:20px">
            <ul class="products">
                <div class="row">
                    <ul class="products-list" style="display: flex; flex-wrap: wrap;">
                        @foreach ($products as $product)
                            <li class="pr-item col-md-4 col-lg-4 ">
                                <div class="contain-product style-widget">
                                    <div class="product-thumb">
                                        <a href="{{ route('productdetail', $product->id) }}" class="link-to-product">
                                            @php
                                                $primaryImage = $product->images->where('is_primary', true)->first();
                                                $imageUrl = $primaryImage
                                                    ? asset('storage/' . $primaryImage->image_url)
                                                    : asset('resources/images/default-product.jpg');
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                                            style="object-fit: cover; width: 50px; height: 50px; overflow: hidden; border-radius: 5px;"
                                            class="product-thumbnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">{{ $product->category->name ?? 'Uncategorized' }}</b>
                                        <h4 class="product-title">
                                            <a href="#" class="pr-name">{{ $product->name }}</a>
                                        </h4>
                                        <div class="price">
                                            @if ($product->price != $product->discounted_price)
                                                <ins><span class="price-amount new-price"
                                                        style="color: red; align-self:center">{{ number_format($product->discounted_price, 0) }}
                                                    </span></ins>
                                                <del><span class="price-amount old-price"
                                                        style="color: #ccc">{{ number_format($product->price, 0) }}
                                                    </span></del>
                                            @else
                                                <ins><span class="price-amount">{{ number_format($product->price, 0) }}
                                                    </span></ins>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </ul>
        </div>
    </div>
@endsection
