@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4" style="padding-bottom: 12px">
                    <h5 class="card-title fw-semibold mb-4">Thương hiệu</h5>
                    <form class="product-search d-flex align-items-center">
                        <input type="text" class="border border-1 border-primary rounded px-2" value="{{request('name')}}"
                        placeholder="Tên thương hiệu" name="name" style="margin-right: 10px">
                        <button type="submit" class="btn btn-primary" style="height:34px">Tìm kiếm</button>
                    </form>
                    <a href="{{route('brand.create')}}" class="btn btn-primary m-1"style="margin-left:5px">Tạo mới</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tên thương hiệu</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Hành động</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$brand->id}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-semibold">{{$brand->name}}</p>
                                    </td>
                                    <td class="border-bottom-0 text-center d-flex justify-content-center align-items-center">
                                        <a href="{{route('brand.edit', $brand)}}" class="btn btn-outline-secondary btn-info m-1" style="height:34px">Sửa</a>
                                        <form action="{{route('brand.destroy', $brand)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Do you really want to delete this items?')"
                                            type="submit" class="btn btn-outline-danger btn-danger m-1" style="margin: 0 0 0 5px">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="pagination" class="row"
                    style="display: flex; align-items:center; justify-content:center; padding:8px">
                    {{ $brands->links() }}
                </div>
        </div>
    </div>
</div>
@endsection