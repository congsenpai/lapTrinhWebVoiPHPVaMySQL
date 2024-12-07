@foreach ($staffs as $staff)
    <tr>
        <td> <a href="#">{{ $loop->iteration }}</a></td>
        
        {{-- <td> <img src="{{ $imageUrl }}" alt="{{ $product->name }}" width="50" height="50"
                style="object-fit: contain" class="product-thumbnail">
        </td> --}}
        <td> <a href="#">{{ $staff->name }}</a></td>
        <td> <a href="#">{{ $staff->email }}</a></td>
        <td> <a href="#">{{ $staff->phone }}</a></td>
        <td> <a href="#">{{ $staff->address }}</a></td>
        <td>
            <!-- View Product Modal Trigger -->
            {{-- <button class="btn btn-info btn-sm" id="btnShowModal" data-product-id="{{ $product->id }}"
                data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}"
                data-product-stock="{{ $product->stock }}" data-product-primary-image="{{ $imageUrl }}"
                data-product-images="{{ json_encode($product->images->pluck('image_url')) }}">Xem</button>
            <button class="btn btn-danger btn-sm" id="">Xóa</button> --}}
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateStaffModal" id="btnShowModal" data-name="{{ $staff->name }}"
                data-email="{{ $staff->email }}" data-phone="{{ $staff->phone }}" data-password="{{ $staff->password }}" 
                data-address="{{ $staff->address }}" 
                {{-- data-product-primary-image="{{ $imageUrl }}" --}}
                {{-- data-product-images="{{ json_encode($product->images->pluck('image_url')) }}" --}}
                >Xem</button>
            
            <a href="{{ route('deletestaff', ['email' => $staff->email]) }}" class="btn btn-danger btn-sm" style="float: left;width:40%;margin-top:5px;">Xóa</a>
        </td>
    </tr>
@endforeach

<div class="d-flex justify-content-center">
    {!! $staffs->links() !!}
</div>
