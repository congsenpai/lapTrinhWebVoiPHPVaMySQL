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
                            <form action="{{ route('login') }}" method="POST" name="frm-login">
                                @csrf
                                <p class="form-row">
                                    <label for="fid-email">Email Address:<span class="requite">*</span></label>
                                    <input type="email" id="fid-email" name="email" class="txt-input" required>
                                </p>
                                <p class="form-row">
                                    <label for="fid-pass">Password:<span class="requite">*</span></label>
                                    <input type="password" id="fid-pass" name="password" class="txt-input" required>
                                </p>
                                
                                <!-- Remember Me Checkbox -->
                                <p class="form-row">
                                    <label for="remember" style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                                        <input type="checkbox" id="remember" name="remember" style="height: 14px; width: 14px;margin:0">
                                        Remember Me
                                    </label>
                                </p>
                                

                                <p class="form-row wrap-btn" style="text-align: center">
                                    <button class="btn btn-submit btn-bold" type="submit">Đăng nhập</button>
                                    <a href="{{route('forgotpassword')}}" class="link-to-help">Quên mật khẩu?</a>
                                </p>
                            </form>
                        </div>
                    </div>

                    <!--Go to Register form-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="register-in-container">
                            <div class="intro">
                                <h4 class="box-title">Bạn là khách hàng mới?</h4>
                                <p class="sub-title">Tạo tài khoản để có thể</p>
                                <ul class="lis">
                                    <li>Thanh toán nhanh hơn</li>
                                    <li>Mua sắm tiết kiệm hơn</li>
                                    <li>Truy cập vào lịch sử mua hàng</li>
                                    <li>Kiểm tra các hóa đơn mới</li>
                                    <li>Lưu các sản phẩm yêu thích</li>
                                </ul>
                                <div class="row" style="display:flex;align-items:center;justify-content:space-between">
                                    <a href="{{ route('register') }}" class="btn btn-bold" style="width: 45%">Tạo tài khoản</a>
                                    <a href="{{ route('loginAsAdmin') }}" class="btn btn-bold admin" style="width: 45%">Đăng nhập với quyền quản trị</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
