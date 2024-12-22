@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4" style="padding-bottom: 12px">
                        <h5 class="card-title fw-semibold mb-4">Danh mục</h5>
                        <form class="product-search d-flex align-items-center">
                            <input type="text" class="border border-1 border-primary rounded px-2"
                                value="{{ request('name') }}" placeholder="Tên danh mục" name="name"
                                style="margin-right: 10px">
                            <button type="submit" class="btn btn-primary" style="height:34px">Tìm kiếm</button>
                        </form>
                        <a href="{{ route('category.create') }}" class="btn btn-primary m-1" style="margin-left:5px">Tạo
                            mới</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mt-3 text-center table-bordered">
                            <thead class="text-dark fs-4">
                                <tr>
                                <tr>
                                    <th>C.No</th>
                                    <th>Tên loại sản phẩm</th>
                                    <th>Mô tả loại sản phẩm</th>
                                    <th>Hành động</th>
                                </tr>
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $category->id }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-semibold">{{ $category->name }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $category->description }}</h6>
                                        </td>
                                        <td class="border-bottom-0 text-center d-flex justify-content-center"
                                            style="align-items: center">
                                            <a href="{{ route('category.edit', $category) }}" class="btn btn-info btn-sm"
                                                style="line-height:2; height:36px">Sửa</a>
                                            <form action="{{ route('category.destroy', $category) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Do you really want to delete this items?')"
                                                    type="submit" class="btn btn-danger btn-sm "
                                                    style="margin: 0 5px 0 5px; height:36px ">Xóa</button>
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
