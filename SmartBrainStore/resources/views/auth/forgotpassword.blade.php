@extends('layouts.app')
@section('content')
    <div class="page-contain login-page">
        <div id="main-content" class="main-content">
            <div class="container">
                <div class="row">
                    <h5 style="padding: 14px">Quên mật khẩu <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </h5>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container" style="margin:20px">
                            <form action="{{ route('forgotpassword') }}" method="POST" name="frm-forgot-password">
                                @csrf
                                <p class="form-row">
                                    <label for="email">Email Address:<span class="requite">*</span></label>
                                    <input type="email" id="email" name="email" class="txt-input" required>
                                </p>
                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" type="submit">Gửi yêu cầu</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
