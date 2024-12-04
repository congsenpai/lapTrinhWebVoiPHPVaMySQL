@extends('admin.layouts.app')
@section('content')
    <section class="p-3" style="padding-right: 30px">

        <div class="row" style="margin-bottom: 10px">
            <div class="col-12" style="display:flex;justify-content:flex-end">
                <button class="btn btn-primary newUser" data-bs-toggle="modal" data-bs-target="#productForm">Thêm sản
                    phẩm</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>P.No</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Tồn kho</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="data">
                        @foreach ($products as $product)
                            <tr>
                                <td> <a href="#">{{ $loop->iteration }}</a></td>
                                @php
                                    $primaryImage = $product->images->where('is_primary', true)->first();
                                    $imageUrl = $primaryImage
                                        ? asset('storage/' . $primaryImage->image_url)
                                        : asset('resources/images/default-product.jpg');
                                @endphp
                                <td> <img src="{{ $imageUrl }}" alt="{{ $product->name }}" width="50" height="50"
                                        style="object-fit: contain" class="product-thumbnail">
                                </td>
                                <td> <a href="#">{{ $product->name }}</a></td>
                                <td> <a href="#">{{ $product->price }}</a></td>
                                <td> <a href="#">{{ $product->stock }}</a></td>
                                <td>
                                    <!-- View Product Modal Trigger -->
                                    <button class="btn btn-info btn-sm" id="btnShowModal"
                                        data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                                        data-product-price="{{ $product->price }}"
                                        data-product-stock="{{ $product->stock }}"
                                        data-product-primary-image="{{ $imageUrl }}"
                                        data-product-images="{{ json_encode($product->images->pluck('image_url')) }}">Xem</button>
                                    <button class="btn btn-danger btn-sm" id="">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="pagination" class="row"
                style="display: flex; align-items:center; justify-content:center; padding:8px">
                {{ $products->links() }}
            </div>
        </div>
        <!--Modal Form-->
    </section>
@endsection
