@extends('client.layouts.app')


@section('content')
    <style>
        .rating .fa {
            font-size: 20px;
            color: #ccc;
            /* Màu sao rỗng */
        }

        .rating .checked {
            color: #f39c12;
            /* Màu sao đầy */
        }
    </style>
    <div class="page-contain about-us">

        <!-- Main content -->
        <div id="main-content" class="main-content">

            <div class="welcome-us-block">
                <div class="container">
                    <h4 class="title">Giới Thiệu Về Cửa Hàng!</h4>
                    <div class="text-wraper">
                        <p class="text-info" style="text-align: justify;">Cửa hàng thực phẩm Biolife không chỉ đơn thuần là
                            nơi mua sắm, mà là một điểm đến lý tưởng dành cho những người quan tâm đến sức khỏe và chất
                            lượng cuộc sống. Chúng tôi tận tâm cung cấp các sản phẩm thực phẩm hữu cơ và tự nhiên, cam kết
                            mang đến cho khách hàng những sản phẩm an toàn, ngon miệng và giàu dinh dưỡng.</p>
                        <p class="qt-text">“We Are the Best”</p>
                    </div>
                </div>
            </div>

            <div class="why-choose-us-block">
                <div class="container">
                    <h4 class="box-title">Tại Sao Chọn Chúng Tôi?</h4>
                    <b class="subtitle">Thực phẩm tự nhiên được lấy từ các nông trại tiên tiến và hiện đại nhất thế giới với
                        chu trình an toàn nghiêm ngặt</b>
                    <div class="showcase">
                        <div class="sc-child sc-left-position">
                            <ul class="sc-list">
                                <li>
                                    <div class="sc-element color-01">
                                        <span class="biolife-icon icon-fresh-drink"></span>
                                        <div class="txt-content">
                                            <span class="number">01</span>
                                            <b class="title">Luôn Luôn Tươi Mới</b>
                                            <p class="desc">Sản phẩm tự nhiên được bảo quản trong điều kiện tốt nhất để
                                                luôn luôn tươi mới</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="sc-element color-02">
                                        <span class="biolife-icon icon-healthy-about"></span>
                                        <div class="txt-content">
                                            <span class="number">02</span>
                                            <b class="title"> Sức Khỏe</b>
                                            <p class="desc">Sản phẩm tự nhiên được bảo quản trong điều kiện tốt nhất, mang
                                                đến những thành phần có lợi cho sức khỏe</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="sc-element color-03">
                                        <span class="biolife-icon icon-green-safety"></span>
                                        <div class="txt-content">
                                            <span class="number">03</span>
                                            <b class="title">An Toàn Với Môi Trường</b>
                                            <p class="desc">Sản phẩm tự nhiên, an toàn với thiên nhiên</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="sc-child sc-center-position">
                            <figure><img src="{{ Vite::asset('resources/images/about-us/bn04.jpg') }}" alt=""
                                    width="622" height="656"></figure>
                        </div>
                        <div class="sc-child sc-right-position">
                            <ul class="sc-list">
                                <li>
                                    <div class="sc-element color-04">
                                        <span class="biolife-icon icon-capacity-about"></span>
                                        <div class="txt-content">
                                            <span class="number">04</span>
                                            <b class="title">Năng Lượng</b>
                                            <p class="desc">Sản phẩm tự nhiên, cung cấp cho bạn một năng lương dồi dào</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="sc-element color-05">
                                        <span class="biolife-icon icon-arteries-about"></span>
                                        <div class="txt-content">
                                            <span class="number">05</span>
                                            <b class="title">Lợi Ích</b>
                                            <p class="desc">Sản phẩm tự nhiên tốt cho sức khởe</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="sc-element color-06">
                                        <span class="biolife-icon icon-title"></span>
                                        <div class="txt-content">
                                            <span class="number">06</span>
                                            <b class="title">Tiêu Chuẩn Chất Lượng</b>
                                            <p class="desc">Sản phẩm đạt chuẩn chất lượng và được kiểm định bởi các cơ
                                                quan có thẩm quyền</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="testimonial-block">
                <div class="container">
                    <h4 class="box-title">Thành Viên Nhóm 1</h4>
                    <ul class="testimonial-list biolife-carousel"
                        data-slick='{"arrows":false,"dots":true,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":3, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 2}},{"breakpoint":768, "settings":{ "slidesToShow": 2}},{"breakpoint":500, "settings":{ "slidesToShow": 1}}]}'>

                        <li>
                            <div class="testml-elem">
                                <div class="avata">
                                    <figure><img style="border-radius: 50%; object-fit: cover;"
                                            src="{{ Vite::asset('resources/images/about-us/1.png') }}" alt=""
                                            width="217" height="217"></figure>
                                </div>
                                <b class="name">Nguyễn Đức Công</b>
                                <b class="title">Nhóm Trưởng</b>
                                <div class="rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                </div>

                            </div>
                        </li>

                        <li>
                            <div class="testml-elem">
                                <div class="avata">
                                    <figure><img style="border-radius: 50%; object-fit: cover;"
                                            src="{{ Vite::asset('resources/images/about-us/2.png') }}" alt=""
                                            width="217" height="217"></figure>
                                </div>
                                <b class="name">Nguyễn Cảnh Phong</b>
                                <b class="title">Thành Viên</b>
                                <div class="rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="testml-elem">
                                <div class="avata">
                                    <figure><img style="border-radius: 50%; object-fit: cover;"
                                            src="{{ Vite::asset('resources/images/about-us/4.png') }}" alt=""
                                            width="217" height="217"></figure>
                                </div>
                                <b class="name">Nguyễn Thị Huyền Trang</b>
                                <b class="title">Thành Viên</b>
                                <div class="rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="testml-elem">
                                <div class="avata">
                                    <figure><img style="border-radius: 50%; object-fit: cover;"
                                            src="{{ Vite::asset('resources/images/about-us/3.png') }}" alt=""
                                            width="217" height="217"></figure>
                                </div>
                                <b class="name">Nguyễn Trường Giang</b>
                                <b class="title">Thành Viên</b>
                                <div class="rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                </div>

                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection
