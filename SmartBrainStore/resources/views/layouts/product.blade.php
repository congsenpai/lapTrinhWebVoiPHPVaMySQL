<body class="biolife-body">
    <!--Hero Section-->
    <div class="hero-section hero-background">
        <h1 class="page-title">Smart Brain Fruits</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="{{route('home')}}" class="permal-link">Home</a></li>
                <li class="nav-item"><a href="{{route('product')}}" class="permal-link">Product</a></li>
                <li class="nav-item"><span class="current-page">Fresh Fruit</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain category-page left-sidebar">
        <div class="container">
            <div class="row">
                {{-- casrosell product --}}
                <div id="main-content" class="main-content col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="block-item recently-products-cat md-margin-bottom-39">
                        <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile"
                            data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":30}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="#" class="link-to-product">
                                            <img src="{{ Vite::asset('resources/images/products/p-08.jpg') }}" alt="dd" width="270"
                                                height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="#" class="pr-name">National Fresh
                                                Fruit</a>
                                        </h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span
                                                        class="currencySymbol">£</span>85.00</span></ins>
                                            <del><span class="price-amount"><span
                                                        class="currencySymbol">£</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    {{-- Product content --}}
                    <div class="product-category grid-style">
                        <div id="top-functions-area" class="top-functions-area">
                            <div class="flt-item to-left group-on-mobile">
                                <span class="flt-title">Tìm kiếm theo</span>
                                <div class="wrap-selectors">
                                    <form action="#" name="frm-refine" method="get">
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
                                            <select name="brad" class="selector">
                                                <option value="all">Thương hiệu</option>
                                                <option value="br2">Smart Brain</option>
                                                <option value="br3">Dole</option>
                                                <option value="br4">Del Monte</option>
                                                <option value="br5">Zespri</option>
                                                <option value="br6">Pink Lady</option>
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
                            <ul class="products-list">
                                <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="{{ Vite::asset('resources/images/products/p-11.jpg') }}" alt="dd" width="270"
                                                    height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name">National
                                                    Fresh
                                                    Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span
                                                            class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span
                                                            class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="shipping-info">
                                                <p class="shipping-day">3-Day Shipping</p>
                                                <p class="for-today">Pree Pickup Today</p>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food
                                                    safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart"
                                                            aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add
                                                        to
                                                        cart</a>
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="biolife-panigations-block">
                            <ul class="panigation-contain">
                                <li><span class="current-page">1</span></li>
                                <li><a href="#" class="link-page">2</a></li>
                                <li><a href="#" class="link-page">3</a></li>
                                <li><span class="sep">....</span></li>
                                <li><a href="#" class="link-page">20</a></li>
                                <li><a href="#" class="link-page next"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>

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
                        <div class="widget price-filter biolife-filter">
                            <h4 class="wgt-title">Giá</h4>
                            <div class="wgt-content">
                                <div class="frm-contain" style="width: 100%; padding-bottom:20px">
                                    <form action="#" name="price-filter" id="price-filter" method="get">
                                        <div class="price-container"
                                            style="display: flex; flex-direction: column; width: 100%; justify-content:center;align-items:center">
                                            <p class="f-item row"
                                                style="display: flex; align-items: center; margin-bottom: 10px; width: 100%;">
                                                <label for="pr-from" style="flex: 1;">Từ: </label>
                                                <input class="input-number" type="number" min="1"
                                                    step="1" id="pr-from" value="" name="price-from"
                                                    style="flex: 3;">
                                            </p>
                                            <p class="f-item row"
                                                style="display: flex; align-items: center; margin-bottom: 10px; width: 100%;">
                                                <label for="pr-to" style="flex: 1;">Đến: </label>
                                                <input class="input-number" type="number" min="1"
                                                    step="1" id="pr-to" value="" name="price-to"
                                                    style="flex: 3;">
                                            </p>
                                            <p class="f-item" style="margin-top: 10px;">
                                                <button class="btn-submit" type="submit"
                                                    style="transform: translateX(30px);padding:10px">Tìm kiếm</button>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Thương hiệu</h4>
                            <div class="wgt-content">
                                <ul class="check-list multiple">
                                    <li class="check-list-item"><a href="#" class="check-link">Smart Brain</a>
                                    </li>
                                    <li class="check-list-item"><a href="#" class="check-link">Dole</a>
                                    </li>
                                    <li class="check-list-item"><a href="#" class="check-link">Del Monte</a>
                                    </li>
                                    <li class="check-list-item"><a href="#" class="check-link">Zespri</a>
                                    </li>
                                    <li class="check-list-item"><a href="#" class="check-link">Pink Lady</a>
                                    </li>
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
