<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartBrain - Fresh fruit - Smart Store</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ Vite::asset('resources/images/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Vite CSS and JS -->
    @vite(['resources/css/bootstrap.min.css', 'resources/css/animate.min.css', 'resources/css/nice-select.css', 'resources/css/slick.min.css', 'resources/css/style.css', 'resources/css/main-color.css', 'resources/js/jquery-3.4.1.min.js', 'resources/js/bootstrap.min.js', 'resources/js/bootstrap.js', 'resources/js/jquery.countdown.min.js', 'resources/js/jquery.nice-select.min.js', 'resources/js/jquery.nicescroll.min.js', 'resources/js/slick.min.js', 'resources/js/biolife.framework.js', 'resources/js/functions.js'])
</head>


<body class="biolife-body">

    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">
        <div class="header-top bg-main hidden-xs">
            <div class="container">
                <div class="top-bar left">
                    <ul class="horizontal-menu">
                        <li><a href="#"><i class="fas fa-envelope"
                                    aria-hidden="true"></i>Smartbrain@company.com</a></li>
                        <li><a href="#">Miễn phí ship tất cả đơn hàng từ 99k</a></li>
                    </ul>
                </div>
                <div class="top-bar right">
                    <ul class="social-list">
                        <li><a href="#"><i class="fa-brands fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul>
                    <ul class="horizontal-menu">
                        <li class="horz-menu-item currency">
                            <select name="currency">
                                <option value="eur">€ EUR (Euro)</option>
                                <option value="usd">$ USD (Dollar)</option>
                                <option value="vnd" selected>VND (Đồng)</option>
                                <option value="usd">¥ JPY (Yen)</option>
                            </select>
                        </li>
                        <li class="horz-menu-item lang">
                            <select name="language">
                                <option value="fr">French (EUR)</option>
                                <option value="en">English (USD)</option>
                                <option value="vn" selected>Tiếng Việt</option>
                                <option value="jp">Japan (JPY)</option>
                            </select>
                        </li>
                        <li><a href="login.html" class="login-link"><i
                                    class="biolife-icon icon-login"></i>Login/Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-middle biolife-sticky-object ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-md-6 col-xs-6">
                        <a href="../index.html" class="biolife-logo"><img
                                src="{{ Vite::asset('resources/images/organic-3.png') }}" alt="biolife logo"
                                width="135" height="34"></a>
                    </div>
                    <div class="col-lg-6 col-md-7 hidden-sm hidden-xs">
                        <div class="primary-menu">
                            <ul class="menu biolife-menu clone-main-menu clone-primary-menu" id="primary-menu"
                                data-menuname="main menu">
                                <li class="menu-item"><a href="/index.html">Trang chủ</a></li>
                                <li class="menu-item menu-item-has-children has-megamenu">
                                    <a href="#" class="menu-name" data-title="Shop">Cửa hàng</a>
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
                                    <a href="#" class="menu-name" data-title="Products">Sản phẩm</a>
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
                                        <a href="#" class="menu-name" data-title="Vegetables"><i
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
                                        <a href="#" class="menu-name" data-title="Fresh Berries"><i
                                                class="biolife-icon icon-grape"></i>Fresh Berries</a>
                                        <div class="wrap-megamenu lg-width-900 md-width-640 background-mega-02">
                                            <div class="mega-content">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-3 col-md-4 sm-col-12 md-margin-bottom-83 xs-margin-bottom-25">
                                                        <div class="wrap-custom-menu vertical-menu">
                                                            <h4 class="menu-title">Fresh Berries</h4>
                                                            <ul class="menu">
                                                                <li><a href="#">Fruit & Nut Gifts</a></li>
                                                                <li><a href="#">Mixed Fruits</a></li>
                                                                <li><a href="#">Oranges</a></li>
                                                                <li><a href="#">Bananas & Plantains</a></li>
                                                                <li><a href="#">Fresh Gala Apples</a></li>
                                                                <li><a href="#">Berries</a></li>
                                                                <li><a href="#">Pears</a></li>
                                                                <li><a href="#">Produce</a></li>
                                                                <li><a href="#">Snack Foods</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-3 col-md-4 sm-col-12 lg-padding-left-23 xs-margin-bottom-36px md-margin-bottom-0">
                                                        <div class="wrap-custom-menu vertical-menu">
                                                            <h4 class="menu-title">Gifts</h4>
                                                            <ul class="menu">
                                                                <li><a href="#">Non-Dairy Coffee Creamers</a>
                                                                </li>
                                                                <li><a href="#">Coffee Creamers</a></li>
                                                                <li><a href="#">Mayonnaise</a></li>
                                                                <li><a href="#">Almond Milk</a></li>
                                                                <li><a href="#">Ghee</a></li>
                                                                <li><a href="#">Beverages</a></li>
                                                                <li><a href="#">Ranch Salad Dressings</a></li>
                                                                <li><a href="#">Hemp Milk</a></li>
                                                                <li><a href="#">Nuts & Seeds</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-6 col-md-4 sm-col-12 lg-padding-left-25 md-padding-top-55">
                                                        <div class="biolife-banner layout-01">
                                                            <h3 class="top-title">Farm Fresh</h3>
                                                            <p class="content"> All the Lorem Ipsum generators on the
                                                                Internet tend.</p>
                                                            <b class="bottomm-title">Berries Series</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="menu-item"><a href="#" class="menu-name"
                                            data-title="Ocean Foods"><i class="biolife-icon icon-fish"></i>Ocean
                                            Foods</a></li>
                                    <li class="menu-item menu-item-has-children has-child">
                                        <a href="#" class="menu-name" data-title="Butter & Eggs"><i
                                                class="biolife-icon icon-honey"></i>Butter & Eggs</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="#">Omelettes</a></li>
                                            <li class="menu-item"><a href="#">Breakfast Scrambles</a></li>
                                            <li class="menu-item menu-item-has-children has-child"><a href="#"
                                                    class="menu-name" data-title="Eggs & other considerations">Eggs &
                                                    other considerations</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="#">Classic Breakfast</a></li>
                                                    <li class="menu-item"><a href="#">Huevos Rancheros</a></li>
                                                    <li class="menu-item"><a href="#">Everything Egg
                                                            Sandwich</a></li>
                                                    <li class="menu-item"><a href="#">Egg Sandwich</a></li>
                                                    <li class="menu-item"><a href="#">Vegan Burrito</a></li>
                                                    <li class="menu-item"><a href="#">Biscuits and Gravy</a>
                                                    </li>
                                                    <li class="menu-item"><a href="#">Bacon Avo Egg Sandwich</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item"><a href="#">Griddle</a></li>
                                            <li class="menu-item menu-item-has-children has-child"><a href="#"
                                                    class="menu-name" data-title="Sides & Extras">Sides & Extras</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="#">Breakfast Burrito</a></li>
                                                    <li class="menu-item"><a href="#">Crab Cake Benedict</a>
                                                    </li>
                                                    <li class="menu-item"><a href="#">Corned Beef Hash</a></li>
                                                    <li class="menu-item"><a href="#">Steak & Eggs</a></li>
                                                    <li class="menu-item"><a href="#">Oatmeal</a></li>
                                                    <li class="menu-item"><a href="#">Fruit & Yogurt Parfait</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item"><a href="#">Biscuits</a></li>
                                            <li class="menu-item"><a href="#">Seasonal Fruit Plate</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-fast-food"></i>Fastfood</a></li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-beef"></i>Fresh Meat</a></li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-onions"></i>Fresh Onion</a></li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-avocado"></i>Papaya & Crisps</a></li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-contain"></i>Oatmeal</a></li>
                                    <li class="menu-item"><a href="#" class="menu-title"><i
                                                class="biolife-icon icon-fresh-juice"></i>Fresh Bananas & Plantains</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 padding-top-2px">
                        <div class="header-search-bar layout-01">
                            <form action="#" class="form-search" name="desktop-seacrh" method="get">
                                <input type="text" name="s" class="input-text" value=""
                                    placeholder="Tìm sản phẩm ở đây nè :>">
                                <select name="category">
                                    <option value="-1" selected>Tất cả</option>
                                    <option value="fresh_fruits">Trái cây tươi</option>
                                    <option value="frozen_fruits">Trái cây đông lạnh</option>
                                    <option value="dried_fruits">Trái cây sấy</option>
                                    <option value="finished_fruits">Trái cây chế biến</option>
                                    <option value="canned_fruits">Trái cây đóng hộp</option>
                                    <option value="gift_fruits">Quà tặng</option>
                                    <option value="imported_fruits">Trái cây nhập khẩu</option>
                                </select>
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
    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>


</body>

</html>
