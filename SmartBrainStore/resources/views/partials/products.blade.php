@foreach ($products as $product)
    <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <div class="contain-product layout-default">
            <div class="product-thumb">
                <a href="#" class="link-to-product">
                    @php
                        $primaryImage = $product->images->where('is_primary', true)->first();
                        $imageUrl = $primaryImage
                            ? asset('storage/' . $primaryImage->image_url)
                            : asset('resources/images/default-product.jpg');
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                        style="object-fit: cover; width: 270px; height: 270px; overflow: hidden; border-radius: 5px;"
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
            <div class="slide-down-box">
                <p class="message">All products are carefully selected to ensure
                    food
                    safety.</p>
                <form action="{{ route('cart.add') }}" method="POST" class="buttons"
                    style="align-items: center; display:flex; justify-content:space-between">
                    @csrf
                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="discounted_price" value="{{ $product->discounted_price }}">
                    <input type="hidden" name="image" value="{{ $imageUrl }}">
                    <input type="hidden" name="qty" value="1">
                    @if ($product->stock > 0)
                        <button type="submit" class="btn add-to-cart-btn">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            Thêm vào giỏ hàng
                        </button>
                    @else
                        <button type="submit" class="btn add-to-cart-btn" style="min-width: 150px" disabled>
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            Hết hàng
                        </button>
                    @endif
                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                </form>
            </div>
        </div>
    </li>
@endforeach
