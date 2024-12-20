    {{-- Hiển thị thông báo lỗi nếu có --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
<form action="{{ route('updatestaff') }}" method="POST" enctype="multipart/form-data" style="display: block" id="updateStaffModal">
    @csrf {{-- Bảo vệ form CSRF --}}

    {{-- Họ tên--}}
    <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label">>Tên nhân viên:</label>
        <div class="col-sm-9">
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
    </div>

    {{-- Email --}}
    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email:</label>
        <div class="col-sm-9">
            <input type="text" name="email" id="email" class="form-control" readonly>
        </div>
    </div>

    {{-- Password --}}
    <div class="form-group row">
        <label for="Password" class="col-sm-3 col-form-label">Mật khẩu:</label>
        <div class="col-sm-9">
            <input type="text" name="password" id="password" class="form-control" required>
        </div>
    </div>

    {{-- Điện thoại--}}
    <div class="form-group row">
        <label for="price" class="col-sm-3 col-form-label">Điện thoại:</label>
        <div class="col-sm-9">
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
    </div>

    {{-- Địa chỉ --}}
    <div class="form-group row">
        <label for="stock" class="col-sm-3 col-form-label">Địa chỉ:</label>
        <div class="col-sm-9">
            <input type="text" name="address" id="address" class="form-control" required>
        </div>
    </div>
    <input type="hidden" name="role" id="role" class="form-control" value="staff"
             required>
    <input type="hidden" name="created_at" id="created_at" class="form-control" value="{{ time() }}"
             required>
    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width:30%;float:right;margin-bottom:20px;margin-left:20px">Đóng</button>

    {{-- Nút submit --}}
    <button type="submit" class="btn btn-primary mt-3" style="width:30%;float:right;margin-bottom:20px">Lưu</button>
</form>
