@foreach ($products as $product)
    <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <div class="contain-product layout-default">
            <div class="product-thumb">
                <a href="#" class="link-to-product">
                    @php
                        $primaryImage = $product->images
                            ->where('is_primary', true)
                            ->first();
                        $imageUrl = $primaryImage
                            ? asset('storage/' . $primaryImage->image_url)
                            : asset('resources/images/default-product.jpg');
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" width="270" height="270" class="product-thumbnail">
                </a>
            </div>
            <div class="info">
                <b class="categories">{{ $product->category->name ?? 'Uncategorized' }}</b>
                <h4 class="product-title">
                    <a href="#" class="pr-name">{{ $product->name }}</a>
                </h4>
                <div class="price">
                    <ins><span class="price-amount">{{ number_format($product->price, 0) }} Đ</span></ins>
                </div>
            </div>
            <div class="slide-down-box">
                <p class="message">All products are carefully selected to ensure food safety.</p>
                <div class="buttons">
                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </li>
@endforeach
