@extends('admin.layouts.app')
@section('content')
    <div class="page-contain login-page" >

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">
                <div class="row">
                    <!--Form Sign In-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form action="{{ route('loginAsAdmin') }}" method="POST" name="frm-login">
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
                                    <label for="remember"
                                        style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                                        <input type="checkbox" id="remember" name="remember"
                                            style="height: 14px; width: 14px;margin:0">
                                        Remember Me
                                    </label>
                                </p>


                                <p class="form-row wrap-btn" style="text-align: center">
                                    <button class="btn btn-submit btn-bold" type="submit">Đăng nhập</button>
                                    <a href="{{ route('forgotpassword') }}" class="link-to-help">Quên mật khẩu?</a>
                                </p>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
