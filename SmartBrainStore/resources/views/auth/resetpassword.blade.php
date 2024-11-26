@extends('layouts.app')
@section('content')
    <div class="page-contain login-page">
        <div id="main-content" class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form action="{{ route('updatepassword') }}" method="POST" name="frm-reset-password">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <p class="form-row">
                                    <label for="password">New Password:<span class="requite">*</span></label>
                                    <input type="password" id="password" name="password" class="txt-input" required>
                                </p>
                                <p class="form-row">
                                    <label for="password">Confirm New Password:<span class="requite">*</span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="txt-input" required>
                                </p>
                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" type="submit">Cập nhật mật khẩu</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
