@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Chỉnh sửa Voucher</h5>

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form to edit voucher -->
                <form method="POST" action="{{ route('voucher.update', $voucher->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 d-flex align-items-center" >
                        <label for="discount_type" class="form-label">Loại giảm giá</label>
                        <select name="discount_type" class="form-select @error('discount_type') is-invalid @enderror"
                            id="discount_type">
                            <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="percentage" {{ $voucher->discount_type == 'percentage' ? 'selected' : '' }}>
                                Percentage</option>
                        </select>
                        @error('discount_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="discount_value" class="form-label">Giá trị giảm giá</label>
                        <input type="number" name="discount_value"
                            value="{{ old('discount_value', $voucher->discount_value) }}"
                            class="form-control @error('discount_value') is-invalid @enderror" id="discount_value">
                        @error('discount_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="usage_limit" class="form-label">Giới hạn sử dụng</label>
                        <input type="number" name="usage_limit" value="{{ old('usage_limit', $voucher->usage_limit) }}"
                            class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit">
                        @error('usage_limit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Ngày bắt đầu</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $voucher->start_date) }}"
                            class="form-control @error('start_date') is-invalid @enderror" id="start_date">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $voucher->end_date) }}"
                            class="form-control @error('end_date') is-invalid @enderror" id="end_date">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
