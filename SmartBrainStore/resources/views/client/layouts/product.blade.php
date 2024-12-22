<body class="biolife-body">
    <!--Hero Section-->
    <div class="hero-section hero-background">
        <h1 class="page-title">Smart Brain Fruits</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="{{ route('home') }}" class="permal-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('product') }}" class="permal-link">Product</a></li>
                <li class="nav-item"><span class="current-page">Fresh Fruit</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain category-page left-sidebar">
        <div class="container">
            <div class="row">
                <div id="main-content" class="main-content col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    {{-- Product content --}}
                    <div class="product-category grid-style">
                        <div id="top-functions-area" class="top-functions-area">
                            <div class="flt-item to-left group-on-mobile">
                                <span class="flt-title">Tìm kiếm theo</span>
                                <div class="wrap-selectors">
                                    <form action="" id="frm-refine" method="GET">
                                        <div data-title="Price:" class="selector-item">
                                            <select name="price" class="selector">
                                                <option value="all">Giá</option>
                                                <option value="class-1st">Ít hơn 100k</option>
                                                <option value="class-2nd">Từ 100k - 200k</option>
                                                <option value="class-3rd">Từ 200k - 500k</option>
                                                <option value="class-4th">Từ 500k - 1M</option>
                                                <option value="class-5th">Từ 1M - 2M</option>
                                                <option value="class-7th">Từ 2M trở lên</option>
                                            </select>
                                        </div>
                                        <div data-title="Brand:" class="selector-item">
                                            <select name="brand" class="selector">
                                                <option value="all">Tất cả</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <p class="btn-for-mobile"><button type="submit" class="btn-submit">Go</button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <div class="flt-item to-right">
                                <span class="flt-title">Sắp xếp</span>
                                <div class="wrap-selectors">
                                    <div class="selector-item orderby-selector">
                                        <select name="orderby" class="orderby" aria-label="Shop order">
                                            <option value="menu_order" selected="selected">Mặc định</option>
                                            <option value="popularity">Độ phổ biến</option>
                                            <option value="rating">Đánh giá</option>
                                            <option value="date">Mới nhất</option>
                                            <option value="price">Giá từ thấp đến cao</option>
                                            <option value="price-desc">Giá từ cao đến thấp</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <ul class="products-list" style="display: flex; flex-wrap: wrap;">
                                @foreach ($products as $product)
                                    <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <div class="contain-product layout-default">
                                            <div class="product-thumb">
                                                <a href="{{ route('productdetail', $product->id) }}"
                                                    class="link-to-product">
                                                    @php
                                                        $primaryImage = $product->images
                                                            ->where('is_primary', true)
                                                            ->first();
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
                                                <b
                                                    class="categories">{{ $product->category->name ?? 'Uncategorized' }}</b>
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
                                                        <ins><span
                                                                class="price-amount">{{ number_format($product->price, 0) }}
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
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart"
                                                            aria-hidden="true"></i></a>
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <input type="hidden" name="name"
                                                        value="{{ $product->name }}">
                                                    <input type="hidden" name="price"
                                                        value="{{ $product->price }}">
                                                    <input type="hidden" name="discounted_price"
                                                        value="{{ $product->discounted_price }}">
                                                    <input type="hidden" name="image"
                                                        value="{{ $imageUrl }}">
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
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random"
                                                            aria-hidden="true"></i></a>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <style>
                            /* Đảm bảo phân trang có thể nhìn thấy */
                            .pagination {
                                display: flex;
                                justify-content: center;
                                margin: 80px;
                            }

                            .pagination a {
                                padding: 8px 16px;
                                margin: 0 4px;
                                border: 1px solid #ccc;
                                text-decoration: none;
                            }

                            .pagination .active {
                                background-color: #007bff;
                                color: white;
                            }
                        </style>
                        {{-- Pagination content Ajax --}}
                        <ul class="pagination">
                            {{ $products->links() }}
                        </ul>
                    </div>

                </div>
                <!-- Sidebar -->
                <aside id="sidebar" class="sidebar col-lg-3 col-md-4 col-sm-12 col-xs-12">
                    <div class="biolife-mobile-panels">
                        <span class="biolife-current-panel-title">Sidebar</span>
                        <a class="biolife-close-btn" href="#" data-object="open-mobile-filter">&times;</a>
                    </div>
                    <div class="sidebar-contain">
                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Nhóm sản phẩm hot</h4>
                            <div class="wgt-content">
                                <ul class="cat-list">
                                    <li class="cat-list-item"><a href="#" class="cat-link">Trái cây tươi</a>
                                    </li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Trái cây đóng
                                            hộp</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Trái cây sấy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Xu thế mua hàng</h4>
                            <div class="wgt-content">
                                <ul class="cat-list">
                                    <li class="cat-list-item"><a href="#" class="cat-link">Giảm giá từ 20%</a>
                                    </li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Hot sale</a>
                                    </li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Hàng độc lạ</a>
                                    </li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Hàng gacha</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Xu hướng tìm kiếm</h4>
                            <div class="wgt-content">
                                <ul class="tag-cloud">
                                    <li class="tag-item"><a href="#" class="tag-link">Hoa quả tươi</a></li>
                                    <li class="tag-item"><a href="#" class="tag-link">Hoa quả thiên nhiên</a>
                                    </li>
                                    <li class="tag-item"><a href="#" class="tag-link">Hot</a></li>
                                    <li class="tag-item"><a href="#" class="tag-link">Hoa quả sấy khô</a></li>
                                    <li class="tag-item"><a href="#" class="tag-link">Kem trái cây</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
    </div>
    <script>
        // chức năng lọc sản phẩm
        $(document).ready(function() {
            function fetchProducts() {
                let form = $("#frm-refine");
                $.ajax({
                    url: form.attr("action"),
                    method: form.attr("method"),
                    data: form.serialize(),
                    beforeSend: function() {
                        // Hiển thị loading spinner nếu cần
                    },
                    success: function(response) {
                        $(".products-list").html(response.products);
                        $(".pagination").html(response.pagination);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    },
                });
            }

            $("#frm-refine").on("change", ".selector", function() {
                fetchProducts();
            });

            $(document).on("click", ".pagination a", function(e) {
                e.preventDefault();
                let url = $(this).attr("href");
                $("#frm-refine").attr("action", url);
                fetchProducts();
            });
        });
    </script>
