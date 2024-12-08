@foreach ($promotions as $promotion)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $promotion->name }}</td>
    <td>{{ $promotion->discount_type }}</td>
    <td>{{ $promotion->discount_value }}</td>
    <td>{{ $promotion->end_date }}</td>
    <td>
        <button class="btn btn-info btn-sm btn-view" data-id="{{ $promotion->id }}">Xem</button>
        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $promotion->id }}">Xóa</button>
    </td>
</tr>
@endforeach
