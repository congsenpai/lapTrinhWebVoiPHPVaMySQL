@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tạo Voucher Mới</h5>
            <form method="POST" action="{{ route('voucher.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="discount_type" class="form-label">Loại giảm giá</label>
                    <select name="discount_type" id="discount_type" class="form-control @error('discount_type') is-invalid @enderror">
                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Cố định</option>
                        <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Phần trăm</option>
                    </select>
                    @error('discount_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-3">
                    <label for="discount_value" class="form-label">Giá trị giảm giá</label>
                    <input type="number" name="discount_value" class="form-control @error('discount_value') is-invalid @enderror" id="discount_value" value="{{ old('discount_value') }}">
                    @error('discount_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-3">
                    <label for="usage_limit" class="form-label">Giới hạn sử dụng</label>
                    <input type="number" name="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit" value="{{ old('usage_limit') }}">
                    @error('usage_limit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-3">
                    <label for="start_date" class="form-label">Ngày bắt đầu</label>
                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" value="{{ old('start_date') }}">
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="mb-3">
                    <label for="end_date" class="form-label">Ngày kết thúc</label>
                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" value="{{ old('end_date') }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
            
        </div>
    </div>
</div>
@endsection
