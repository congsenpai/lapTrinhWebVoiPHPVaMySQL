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
            <td> <a href="#"></a>
                <!-- Add actions like Edit or Delete -->
                <button class="btn btn-info btn-sm">Xem</button>
                <button class="btn btn-danger btn-sm">Xóa</button>
            </td>
        </tr>
    @endforeach
</tbody>