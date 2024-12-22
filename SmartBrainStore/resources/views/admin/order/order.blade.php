@extends('admin.layouts.app')

@section('content')
    <style>
        /* Tùy chỉnh thanh cuộn trong Webkit (Chrome, Safari, Edge) */
        #specificProducts::-webkit-scrollbar {
            width: 8px;
        }

        #specificProducts::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 4px;
        }

        #specificProducts::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }
    </style>
    <section class="p-3" style="padding-right: 30px">
        <div class="row mb-3 d-flex" style="justify-content:space-between; padding-bottom: 10px;">
            <!-- Search bar (bên trái) -->
            <div class="col-8 d-flex"
                style=" justify-content:center;align-items:center; align-self:flex-start; padding-right:20%">
                <i class="fa-solid fa-magnifying-glass"></i>
                <div class="input-group">
                    <span class="input-group-text"></span>
                    <input type="text" class="form-control" placeholder="Search here..." aria-label="Search"
                        id="search-input" style="width: 320px">
                </div>
            </div>

            <div class="col-4 d-flex" style=" padding-left:20%;align-self:flex-end">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Tên khách hàng </th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="data">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->payment ? $order->payment->payment_method : 'Chưa có phương thức thanh toán' }}
                                </td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm btn-view" data-id="{{ $order->id }}">Xem</button>
                                    @if ($order->status == 'pending')
                                        
                                        <button class="btn btn-success btn-sm btn-complete"
                                            data-id="{{ $order->id }}">Hoàn
                                            thành</button>
                                        <button class="btn btn-danger btn-sm btn-cancel" data-id="{{ $order->id }}">Hủy
                                            đơn</button>
                                    @else
                                        <button class="btn btn-success btn-sm btn-complete"
                                            data-id="{{ $order->id }}" disabled>Hoàn
                                            thành</button>
                                        <button class="btn btn-danger btn-sm btn-cancel" data-id="{{ $order->id }}" disabled>Hủy
                                            đơn</button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div id="pagination" class="row"
                style="display: flex; align-items:center; justify-content:center; padding:8px">
                {{ $orders->links() }}
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-input');
                const dataContainer = document.getElementById('data');

                searchInput.addEventListener('input', function() {
                    const keyword = searchInput.value;

                    // Gửi yêu cầu AJAX
                    fetch(`/admin/order?s=${keyword}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.html) {
                                dataContainer.innerHTML = data.html; // Render lại tbody
                            }
                        })
                        .catch(error => console.error('Error fetching orders:', error));
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                // Xử lý sự kiện khi nhấn nút "Xem"
                $('.btn-view').on('click', function() {
                    var orderId = $(this).data('id');

                    // Chuyển hướng đến route 'adminorder.detail' với orderId
                    window.location.href = '/admin/order/' + orderId;
                });

                // Xử lý sự kiện khi nhấn nút "Hoàn thành"
                $('.btn-complete').on('click', function() {
                    var orderId = $(this).data('id');

                    // Xác nhận hành động
                    if (confirm('Bạn có chắc muốn hoàn thành đơn hàng này?')) {
                        // Gửi yêu cầu AJAX để thay đổi trạng thái đơn hàng thành "hoàn thành"
                        $.ajax({
                            url: '/admin/order/update-status', // Đường dẫn cần thay đổi
                            method: 'POST',
                            data: {
                                order_id: orderId,
                                status: 'complete',
                                _token: '{{ csrf_token() }}' // CSRF token để bảo vệ khỏi CSRF attacks
                            },
                            success: function(response) {
                                // Nếu thành công, cập nhật lại giao diện
                                alert('Đơn hàng đã được hoàn thành!');
                                location.reload(); // Tải lại trang để hiển thị thay đổi
                            },
                            error: function() {
                                alert('Có lỗi xảy ra! Vui lòng thử lại.');
                            }
                        });
                    }
                });

                // Xử lý sự kiện khi nhấn nút "Hủy đơn"
                $('.btn-cancel').on('click', function() {
                    var orderId = $(this).data('id');

                    // Xác nhận hành động
                    if (confirm('Bạn có chắc muốn hủy đơn hàng này?')) {
                        // Gửi yêu cầu AJAX để thay đổi trạng thái đơn hàng thành "hủy"
                        $.ajax({
                            url: '/admin/order/update-status', // Đường dẫn cần thay đổi
                            method: 'POST',
                            data: {
                                order_id: orderId,
                                status: 'cancel',
                                _token: '{{ csrf_token() }}' // CSRF token để bảo vệ khỏi CSRF attacks
                            },
                            success: function(response) {
                                // Nếu thành công, cập nhật lại giao diện
                                alert('Đơn hàng đã bị hủy!');
                                location.reload(); // Tải lại trang để hiển thị thay đổi
                            },
                            error: function() {
                                alert('Có lỗi xảy ra! Vui lòng thử lại.');
                            }
                        });
                    }
                });
            });
        </script>
    @endsection
