<tbody id="data">
    @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->payment->payment_method }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <button class="btn btn-info btn-sm btn-view" data-id="{{ $order->id }}">Xem</button>
                <button class="btn btn-success btn-sm btn-complete" data-id="{{ $order->id }}">Hoàn thành</button>
                <button class="btn btn-danger btn-sm btn-cancel" data-id="{{ $order->id }}">Hủy đơn</button>
            </td>
        </tr>
    @endforeach
</tbody>
