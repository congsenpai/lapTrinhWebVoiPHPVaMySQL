@extends('client.layouts.app')
@section('content')
    <div class="page-contain login-page">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">
                <div class="row">
                    <!--Form Sign In-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form action="{{ route('register') }}" method="POST" name="frm-register">
                                @csrf
                                <p class="form-row">
                                    <label for="fid-name">Name:<span class="requite">*</span></label>
                                    <input type="name" id="fid-name" name="name" class="txt-input" required
                                        value="{{ old('email') }}">
                                </p>
                                <p class="form-row">
                                    <label for="fid-email">Email Address:<span class="requite">*</span></label>
                                    <input type="email" id="fid-email" name="email" class="txt-input" required
                                        value="{{ old('email') }}">
                                </p>
                                <p class="form-row">
                                    <label for="fid-pass">Password:<span class="requite">*</span></label>
                                    <input type="password" id="fid-pass" name="password" class="txt-input" required>
                                </p>
                                <p class="form-row">
                                    <label for="fid-pass-confirm">Confirm Password:<span class="requite">*</span></label>
                                    <input type="password" id="fid-pass-confirm" name="password_confirmation"
                                        class="txt-input" required>
                                </p>
                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" type="submit">Đăng ký</button>
                                    <a href="{{route('forgotpassword')}}" class="link-to-help">Quên mật khẩu?</a>
                                </p>
                            </form>
                        </div>
                    </div>

                    <!--Go to Register form-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="register-in-container">
                            <div class="intro">
                                <h4 class="box-title">Bạn đã có tài khoản?</h4>
                                <p class="sub-title">Tạo tài khoản để có thể</p>
                                <ul class="lis">
                                    <li>Thanh toán nhanh hơn</li>
                                    <li>Mua sắm tiết kiệm hơn</li>
                                    <li>Truy cập vào lịch sử mua hàng</li>
                                    <li>Kiểm tra các hóa đơn mới</li>
                                    <li>Lưu các sản phẩm yêu thích</li>
                                </ul>

                                <a href="{{ route('login') }}" class="btn btn-bold">Đến trang đăng nhập</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
