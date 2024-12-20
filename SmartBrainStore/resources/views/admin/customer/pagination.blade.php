@foreach ($customers as $customer)
    <tr>
        <td> <a href="#">{{ $loop->iteration }}</a></td>
        
        {{-- <td> <img src="{{ $imageUrl }}" alt="{{ $product->name }}" width="50" height="50"
                style="object-fit: contain" class="product-thumbnail">
        </td> --}}
        <td> <a href="#">{{ $customer->name }}</a></td>
        <td> <a href="#">{{ $customer->email }}</a></td>
        <td> <a href="#">{{ $customer->phone }}</a></td>
        <td> <a href="#">{{ $customer->address }}</a></td>
        <td>
            <!-- View Product Modal Trigger -->
            {{-- <button class="btn btn-info btn-sm" id="btnShowModal" data-product-id="{{ $product->id }}"
                data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}"
                data-product-stock="{{ $product->stock }}" data-product-primary-image="{{ $imageUrl }}"
                data-product-images="{{ json_encode($product->images->pluck('image_url')) }}">Xem</button>
            <button class="btn btn-danger btn-sm" id="">Xóa</button> --}}
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateCustomerModal" id="btnShowModal" data-name="{{ $customer->name }}"
                data-email="{{ $customer->email }}" data-phone="{{ $customer->phone }}" data-password="{{ $customer->password }}" 
                data-address="{{ $customer->address }}" 
                {{-- data-product-primary-image="{{ $imageUrl }}" --}}
                {{-- data-product-images="{{ json_encode($product->images->pluck('image_url')) }}" --}}
                >Xem</button>
            
            <a href="{{ route('deletecustomer', ['email' => $customer->email]) }}" class="btn btn-danger btn-sm" style="float: left;width:40%;margin-top:5px;">Xóa</a>
        </td>
    </tr>
@endforeach

<div class="d-flex justify-content-center">
    {!! $customers->links() !!}
</div>
