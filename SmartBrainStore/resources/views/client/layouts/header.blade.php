    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">
        <div class="header-top bg-main hidden-xs row">
            <div class="container" style="display: flex!important;justify-content:space-between">
                <div class="top-bar left col-md-6" style="display: flex!important;">
                    <ul class="horizontal-menu">
                        <li><a href="#"><i class="fas fa-envelope" aria-hidden="true"></i>Smartbrain@company.com</a>
                        </li>
                        <li><a href="#">Miễn phí ship tất cả đơn hàng từ 99k</a></li>
                    </ul>
                </div>
                <div class="top-bar right col-md-6" style="display: flex!important; justify-content:flex-end">
                    <ul class="social-list" style="padding: 8px;display:flex; align-item:center">
                        <li><a href="#"><i style="padding: 8px;display:flex; align-item:center"
                                    class="fa-brands fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i style="padding: 8px;display:flex; align-item:center"
                                    class="fa-brands fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i style="padding: 8px;display:flex; align-item:center"
                                    class="fa-brands fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul>
                    <ul class="horizontal-menu"; style="display:flex;justify-content:center; align-item:center">
                        @auth
                            <li>
                                <a href="#" class="user-link" style="font-weight: bold">
                                    <i class="biolife-icon icon-user"></i>Xin chào, {{ Auth::user()->name }}
                                </a>

                            </li>
                            <li
                                style="padding: 0; text-align:center; display:flex;justify-content:center; align-items:center">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="user-link"
                                        style="padding: 0; border: none; background: none; color: white; font-size: 14px; line-height:0">
                                        Đăng xuất
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="login-link">
                                    <i class="biolife-icon icon-login"></i>Đăng ký/Đăng nhập
                                </a>
                            </li>
                        @endauth
                    </ul>

                </div>
            </div>
        </div>
        <div class="header-middle biolife-sticky-object ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-md-6 col-xs-6">
                        <a href="{{ route('home') }}" class="biolife-logo"><img
                                src="{{ Vite::asset('resources/images/organic-3.png') }}" alt="biolife logo"
                                width="135" height="34"></a>
                    </div>
                    <div class="col-lg-6 col-md-7 hidden-sm hidden-xs">
                        <div class="primary-menu">
                            <ul class="menu biolife-menu clone-main-menu clone-primary-menu" id="primary-menu"
                                data-menuname="main menu">
                                <li class="menu-item"><a href="/index.html">Trang chủ</a></li>
                                <li class="menu-item menu-item-has-children has-megamenu">
                                    <a href="#" class="menu-name">Cửa hàng</a>
                                    <div class="wrap-megamenu lg-width-900 md-width-750">
                                        <div class="mega-content">
                                            <div
                                                class="col-lg-3 col-md-3 col-xs-12 md-margin-bottom-0 xs-margin-bottom-25">
                                                <div class="wrap-custom-menu vertical-menu">
                                                    <h4 class="menu-title">Quả mọng</h4>
                                                    <ul class="menu">
                                                        <li><a href="#">Dâu tây</a></li>
                                                        <li><a href="#">Việt quất</a></li>
                                                        <li><a href="#">Mâm xôi</a></li>
                                                        <li><a href="#">Nho</a></li>
                                                        <li><a href="#">Cà chua</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div
                                                class="col-lg-3 col-md-3 col-xs-12 md-margin-bottom-0 xs-margin-bottom-25">
                                                <div class="wrap-custom-menu vertical-menu">
                                                    <h4 class="menu-title">Trái cây tươi</h4>
                                                    <ul class="menu">
                                                        <li><a href="#">Táo</a></li>
                                                        <li><a href="#">Cam</a></li>
                                                        <li><a href="#">Dứa</a></li>
                                                        <li><a href="#">Ổi</a></li>
                                                        <li><a href="#">Lê</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div
                                                class="col-lg-3 col-md-3 col-xs-12 md-margin-bottom-0 xs-margin-bottom-25">
                                                <div class="wrap-custom-menu vertical-menu ">
                                                    <h4 class="menu-title">Trái cây khô</h4>
                                                    <ul class="menu">
                                                        <li><a href="#">Táo tàu</a></li>
                                                        <li><a href="#">Nho khô</a></li>
                                                        <li><a href="#">Chuối sấy</a></li>
                                                        <li><a href="#">Mâm xôi khô</a></li>
                                                        <li><a href="#">Cherry khô</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div
                                                class="col-lg-3 col-md-3 col-xs-12 md-margin-bottom-0 xs-margin-bottom-25">
                                                <div class="wrap-custom-menu vertical-menu">
                                                    <h4 class="menu-title">Hàng độc lạ</h4>
                                                    <ul class="menu">
                                                        <li><a href="#">Quả mây</a></li>
                                                        <li><a href="#">Quả xương rồng</a></li>
                                                        <li><a href="#">Quả vả</a></li>
                                                        <li><a href="#">Quả dâu tằm</a></li>
                                                        <li><a href="#">Quả dâu da</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="menu-item menu-item-has-children has-child">
                                    <a href="#" class="menu-name">Sản phẩm</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#">Trái cây tươi</a></li>
                                        <li class="menu-item"><a href="#">Quà tặng</a></li>
                                        <li class="menu-item menu-item-has-children has-child">
                                            <a href="#" class="menu-name">Trái cây sấy</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="#">Sấy nguyên quả</a></li>
                                                <li class="menu-item"><a href="#">Sấy miếng</a></li>
                                                <li class="menu-item"><a href="#">Sấy khô</a></li>
                                                <li class="menu-item"><a href="#">Sấy dẻo</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item"><a href="#">Trái cây nhập khẩu</a></li>
                                        <li class="menu-item menu-item-has-children has-child"><a href="#"
                                                class="menu-name">Trái cây chế biến</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="#">Nước ép</a></li>
                                                <li class="menu-item"><a href="#">Mứt</a></li>
                                                <li class="menu-item"><a href="#">Thạch</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item menu-item-has-children has-child"><a href="#"
                                                class="menu-name">Trái cây đông lạnh</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="#">Nguyên quả</a></li>
                                                <li class="menu-item"><a href="#">Xay nhuyễn</a></li>

                                            </ul>
                                        </li>

                                    </ul>
                                </li>

                                <li class="menu-item"><a href="/contact.html">Về chúng tôi</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-md-6 col-xs-6"
                        style="display:flex; justify-content:space-between; padding:5px">
                        <button onclick="" class="cart-config">
                            Giỏ hàng
                            <i class="fa-solid fa-cart-shopping" style="color: #ff0000;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom hidden-sm hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="vertical-menu vertical-category-block">
                            <div class="block-title">
                                <span class="menu-icon">
                                    <span class="line-1"></span>
                                    <span class="line-2"></span>
                                    <span class="line-3"></span>
                                </span>
                                <span class="menu-title">Danh mục sản phẩm</span>
                                <span class="angle" data-tgleclass="fas fa-caret-down"><i class="fas fa-caret-up"
                                        aria-hidden="true"></i></span>
                            </div>
                            <div class="wrap-menu">
                                <ul class="menu clone-main-menu">
                                    <li class="menu-item menu-item-has-children has-megamenu">
                                        <a href="#" class="menu-name"><i
                                                class="biolife-icon icon-fruits"></i>Trái cây tươi</a>
                                        <div class="wrap-megamenu lg-width-900 md-width-640">
                                            <div class="mega-content">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-3 col-md-4 col-sm-12 xs-margin-bottom-25 md-margin-bottom-0">
                                                        <div class="wrap-custom-menu vertical-menu">
                                                            <h4 class="menu-title">Trái cây tươi</h4>
                                                            <ul class="menu">
                                                                <li><a href="#">Táo</a></li>
                                                                <li><a href="#">Dâu tây</a></li>
                                                                <li><a href="#">Cam</a></li>
                                                                <li><a href="#">Chuối</a></li>
                                                                <li><a href="#">Mâm xôi</a></li>
                                                                <li><a href="#">Cherry</a></li>
                                                                <li><a href="#">Xoài</a></li>
                                                                <li><a href="#">Dưa</a></li>
                                                                <li><a href="#">Combo hoa quả</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-3 col-md-4 col-sm-12 lg-padding-left-23 xs-margin-bottom-25 md-margin-bottom-0">
                                                        <div class="wrap-custom-menu vertical-menu">
                                                            <h4 class="menu-title">Giỏ quà trái cây</h4>
                                                            <ul class="menu">
                                                                <li><a href="#">Giỏ quà mùa đông</a></li>
                                                                <li><a href="#">Giỏ quà mùa hè</a></li>
                                                                <li><a href="#">Giỏ quà mùa thu</a></li>
                                                                <li><a href="#">Giỏ quà mùa xuân</a></li>
                                                                <li><a href="#">Giỏ quà xanh</a></li>
                                                                <li><a href="#">Giỏ quà đỏ</a></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-6 col-md-4 col-sm-12 lg-padding-left-50 xs-margin-bottom-25 md-margin-bottom-0">
                                                        <div class="biolife-products-block max-width-270">
                                                            <h4 class="menu-title">Sản phẩm bán chạy</h4>
                                                            <ul class="products-list default-product-style biolife-carousel nav-none-after-1k2 nav-center"
                                                                data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":1, "responsive":[{"breakpoint":767, "settings":{ "arrows": false}}]}'>
                                                                <li class="product-item">
                                                                    <div class="contain-product none-overlay">
                                                                        <div class="product-thumb">
                                                                            <a href="#" class="link-to-product">
                                                                                <img src="{{ Vite::asset('resources/images/products/p-08.jpg') }}"
                                                                                    alt="dd" width="270"
                                                                                    height="270"
                                                                                    class="product-thumnail">
                                                                            </a>
                                                                        </div>
                                                                        <div class="info">
                                                                            <b class="categories">Trái cây thành
                                                                                phẩm</b>
                                                                            <h4 class="product-title"><a
                                                                                    href="#"
                                                                                    class="pr-name">Nước ép lựu, việt
                                                                                    quất</a></h4>
                                                                            <div class="price">
                                                                                <ins><span
                                                                                        class="price-amount">85.000</span></ins>
                                                                                <del><span
                                                                                        class="price-amount">95.000</span></del>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="product-item">
                                                                    <div class="contain-product none-overlay">
                                                                        <div class="product-thumb">
                                                                            <a href="#" class="link-to-product">
                                                                                <img src="{{ Vite::asset('resources/images/products/p-11.jpg') }}"
                                                                                    alt="dd" width="270"
                                                                                    height="270"
                                                                                    class="product-thumnail">
                                                                            </a>
                                                                        </div>
                                                                        <div class="info">
                                                                            <b class="categories">Trái cây chế biến</b>
                                                                            <h4 class="product-title"><a
                                                                                    href="#" class="pr-name">Lựu
                                                                                    dầm bơ</a></h4>
                                                                            <div class="price">
                                                                                <ins><span
                                                                                        class="price-amount">85.000</span></ins>
                                                                                <del><span
                                                                                        class="price-amount">95.000</span></del>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="product-item">
                                                                    <div class="contain-product none-overlay">
                                                                        <div class="product-thumb">
                                                                            <a href="#" class="link-to-product">
                                                                                <img src="{{ Vite::asset('resources/images/products/p-15.jpg') }}"
                                                                                    alt="dd" width="270"
                                                                                    height="270"
                                                                                    class="product-thumnail">
                                                                            </a>
                                                                        </div>
                                                                        <div class="info">
                                                                            <b class="categories">Trái cây sấy</b>
                                                                            <h4 class="product-title"><a
                                                                                    href="#" class="pr-name">Mâm
                                                                                    xôi sấy khô nguyên quả</a></h4>
                                                                            <div class="price">
                                                                                <ins><span
                                                                                        class="price-amount">85.000</span></ins>
                                                                                <del><span
                                                                                        class="price-amount">95.000</span></del>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 md-margin-top-9">
                                                        <div class="biolife-brand">
                                                            <ul class="brands">
                                                                <li><a href="#"><img
                                                                            src="{{ Vite::asset('resources/images/megamenu/brand-organic.png') }}"
                                                                            width="161" height="136"
                                                                            alt="organic"></a>
                                                                </li>
                                                                <li><a href="#"><img
                                                                            src="{{ Vite::asset('resources/images/megamenu/brand-explore.png') }}"
                                                                            width="160" height="136"
                                                                            alt="explore"></a>
                                                                </li>
                                                                <li><a href="#"><img
                                                                            src="{{ Vite::asset('resources/images/megamenu/brand-organic-2.png') }}"
                                                                            width="99" height="136"
                                                                            alt="organic 2"></a>
                                                                </li>
                                                                <li><a href="#"><img
                                                                            src="{{ Vite::asset('resources/images/megamenu/brand-eco-teas.png') }}"
                                                                            width="164" height="136"
                                                                            alt="eco teas"></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="menu-item menu-item-has-children has-megamenu">
                                        <a href="#" class="menu-name"><i
                                                class="biolife-icon icon-broccoli-1"></i>Trái cây đông lạnh</a>
                                        <div class="wrap-megamenu lg-width-900 md-width-640 background-mega-01">
                                            <div class="mega-content">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-3 col-md-4 col-sm-12 xs-margin-bottom-25 md-margin-bottom-0">
                                                        <div class="wrap-custom-menu vertical-menu">
                                                            <h4 class="menu-title">Trái cây nguyên quả</h4>
                                                            <ul class="menu">
                                                                <li><a href="#">Trái cây lạnh đóng gói</a></li>
                                                                <li><a href="#">Kem trái cây</a></li>
                                                                <li><a href="#">Trái cây lạnh đóng hộp</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-4 col-md-4 col-sm-12 lg-padding-left-23 xs-margin-bottom-25 md-margin-bottom-0">
                                                        <div class="wrap-custom-menu vertical-menu">
                                                            <h4 class="menu-title">Trái cây đông lạnh xay nhuyễn</h4>
                                                            <ul class="menu">
                                                                <li><a href="#">Một loại trái cây</a>
                                                                </li>
                                                                <li><a href="#">Mix nhiều loại</a></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-5 col-md-4 col-sm-12 lg-padding-left-57 md-margin-bottom-30">
                                                        <div class="biolife-brand vertical md-boder-left-30">
                                                            <h4 class="menu-title">Hot Brand</h4>
                                                            <ul class="brands">
                                                                <li><a href="#"><img
                                                                            src="{{ Vite::asset('resources/images/megamenu/v-brand-organic.png') }}"
                                                                            width="167" height="74"
                                                                            alt="organic"></a>
                                                                </li>
                                                                <li><a href="#">
                                                                        <img"
                                                                            src="{{ Vite::asset('resources/images/megamenu/v-brand-explore.png') }}"
                                                                            width="167" height="72"
                                                                            alt="explore">
                                                                    </a>
                                                                </li>
                                                                <li><a href="#"><img
                                                                            src="{{ Vite::asset('resources/images/megamenu/v-brand-organic-2.png') }}"
                                                                            width="167" height="99"
                                                                            alt="organic 2"></a>
                                                                </li>
                                                                <li><a href="#"><img
                                                                            src="{{ Vite::asset('resources/images/megamenu/v-brand-eco-teas.png') }}"
                                                                            width="167" height="67"
                                                                            alt="eco teas"></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="menu-item menu-item-has-children has-megamenu">
                                        <a href="#" class="menu-name"><i
                                                class="biolife-icon icon-grape"></i>Trái cây sấy</a>
                                        <div class="wrap-megamenu lg-width-900 md-width-640 background-mega-02">
                                            <div class="mega-content">
                                                <div class="row" style="height: 450px !important">
                                                    <div
                                                        class="col-lg-3 col-md-4 sm-col-12 md-margin-bottom-83 xs-margin-bottom-25">
                                                        <div class="wrap-custom-menu vertical-menu">
                                                            <h4 class="menu-title">Trái cây sấy khô</h4>
                                                            <ul class="menu">
                                                                <li><a href="#">Sấy nguyên quả</a></li>
                                                                <li><a href="#">Sấy miếng</a></li>
                                                                <li><a href="#">Sấy thăng hoa</a></li>
                                                                <li><a href="#">Sấy giòn mix loại</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-3 col-md-4 sm-col-12 lg-padding-left-23 xs-margin-bottom-36px md-margin-bottom-0">
                                                        <div class="wrap-custom-menu vertical-menu">
                                                            <h4 class="menu-title">Sấy dẻo</h4>
                                                            <ul class="menu">
                                                                <li><a href="#">Sấy dẻo thái lát</a></li>
                                                                <li><a href="#">Sấy dẻo nguyên quả</a></li>
                                                                <li><a href="#">Sấy dẻo thêm đường</a></li>
                                                                <li><a href="#">Sấy dẻo mật ong</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-6 col-md-4 sm-col-12 lg-padding-left-25 md-padding-top-55">
                                                        <div class="biolife-banner layout-01">
                                                            <h3 class="top-title">Nông trại sạch</h3>
                                                            <p class="content">Tất cả các khâu chăm sóc sản phẩm đều
                                                                được kiểm duyệt</p>
                                                            <b class="bottomm-title">Sấy siêu sạch</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="menu-item menu-item-has-children has-child">
                                        <a href="#" class="menu-name"><i
                                                class="biolife-icon icon-honey"></i>Trái cây chế biến</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="#">Nước ép</a></li>
                                            <li class="menu-item"><a href="#">Mứt</a></li>
                                            <li class="menu-item menu-item-has-children has-child"><a href="#"
                                                    class="menu-name">Thạch</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="#">Thạch rau câu</a></li>
                                                    <li class="menu-item"><a href="#">Thạch trái cây</a></li>
                                                    <li class="menu-item"><a href="#">Thạch gelatin</a></li>
                                                    <li class="menu-item"><a href="#">Thạch caramel</a></li>
                                                    <li class="menu-item"><a href="#">Thạch sương sáo</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children has-child"><a href="#"
                                                    class="menu-name">Kem</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="#">Kem que</a></li>
                                                    <li class="menu-item"><a href="#">Kem ly</a>
                                                    </li>
                                                    <li class="menu-item"><a href="#">Kem hộp</a></li>
                                                    <li class="menu-item"><a href="#">Kem ốc quế</a></li>
                                                    <li class="menu-item"><a href="#">Kem đá bào</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-fast-food"></i>Trái cây ngâm</a></li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-beef"></i>Quà tặng</a></li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-onions"></i>Trái cây nhập khẩu</a></li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-avocado"></i>Trái cây đóng hộp</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 padding-top-2px">
                        <div class="header-search-bar layout-01">
                            <form action="{{ route('product') }}" class="form-search" name="search" method="get"
                                id="search">
                                <input type="text" name="s" class="input-text" value="{{ request('s') }}"
                                    placeholder="Tìm sản phẩm ở đây nè :>">

                                <button type="submit" class="btn-submit"><i
                                        class="biolife-icon icon-search"></i></button>
                            </form>

                        </div>
                        <div class="live-info">
                            <p class="telephone"><i class="fas fa-phone" aria-hidden="true"></i><b
                                    class="phone-number">(+84) 123 456 789</b></p>
                            <p class="working-time">Mon-Fri: 8:30am-7:30pm; Sat-Sun: 9:30am-4:30pm</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
