@extends('client.layouts.app')
@section('content')
        <form id="login-form" class="form" action="{{route('account.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="signin-container">
                        <br>
                        <div class="form-group">
                            <label for="email" class="text-dark">Email</label><br>
                            <div class="col-9 text-start">
                                <input class="form-control" type="email" name="email" id="email" value="{{ Auth::guard('web')->user()->email }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="text-dark">Họ Tên</label><br>
                            <div class="col-9 text-start">
                                <input class="form-control" type="text" name="name" id="name" value="{{ Auth::guard('web')->user()->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="text-dark">Số điện thoại</label><br>
                            <div class="col-9 text-start">
                                <input class="form-control" type="text" name="phone" id="phone" value="{{ Auth::guard('web')->user()->phone }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="text-dark">Địa chỉ</label><br>
                            <div class="col-9 text-start">
                                <input class="form-control" type="text" name="address" id="address" value="{{ Auth::guard('web')->user()->address }}">
                            </div>
                        </div>
                    </div>
                </div>
              
                <!-- Avatar Upload and Submit Button -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="register-in-container">
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md" style="background-color: #7fad39; color: white;">
                                Cập Nhật
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
    </div>
</section>


@endsection



