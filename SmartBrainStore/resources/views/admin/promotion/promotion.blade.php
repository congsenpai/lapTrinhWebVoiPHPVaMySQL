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

            <!-- Button (bên phải) -->
            <div class="col-4 d-flex" style=" padding-left:20%;align-self:flex-end">
                <button class="btn btn-primary btn-add newUser" data-toggle="modal" data-target="#promotionModal">Thêm
                    khuyến mại</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>Pro.No</th>
                            <th>Tên ưu đãi</th>
                            <th>Loại ưu đãi</th>
                            <th>Giá trị ưu đãi</th>
                            <th>Ngày kết thúc</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="data">
                        @foreach ($promotions as $promotion)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $promotion->name }}</td>
                                <td>{{ $promotion->discount_type }}</td>
                                <td>{{ $promotion->discount_value }}</td>
                                <td>{{ $promotion->end_date }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm btn-view" data-id="{{ $promotion->id }}">Xem</button>
                                    <button class="btn btn-danger btn-sm btn-delete"
                                        data-id="{{ $promotion->id }}">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div id="pagination" class="row"
                style="display: flex; align-items:center; justify-content:center; padding:8px">
                {{ $promotions->links() }}
            </div>
        </div>
        <!--Modal Form-->

        <div class="modal fade" id="promotionModal" tabindex="-1" aria-labelledby="promotionModalLabel">
            <div class="modal-dialog modal-lg">
                <form action="" method="POST" enctype="multipart/form-data" class="modal-content" id="promotionForm">
                    @csrf {{-- Bảo vệ form CSRF --}}
                    <div class="modal-header">
                        <h3 class="modal-title" id="promotionModalLabel"></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Form hiển thị thông tin sản phẩm -->
                                <div class="form-group d-flex align-items-center">
                                    <label for="itemCode" class="form-label mr-2">Mã khuyến mại:</label>
                                    <input type="text" class="form-control" id="itemCode" readonly>
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="itemName" class="form-label mr-2">Tên khuyến mại:</label>
                                    <input type="text" class="form-control" id="itemName" name="name">
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="itemName" class="form-label mr-2">Loại khuyến mại:</label>
                                    <input type="text" class="form-control" id="itemType" name="type">
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="itemName" class="form-label mr-2">Giá trị khuyến mại:</label>
                                    <input type="text" class="form-control" id="itemValue" name="value">
                                </div>
                                <div class="dateTime-container d-flex">
                                    <div class="form-group">
                                        <label for="startDate form-label mr-2" style="font-weight: bold">Từ ngày:</label>
                                        <input type="datetime-local" id="startDate" name="start_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="endDate form-label mr-2">Đến ngày:</label>
                                        <input type="datetime-local" id="endDate" name="end_date" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <label for="description" class="form-label mr-2">Mô tả</label>
                                    <textarea class="form-control" id="description" rows="2" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="applyType">Áp dụng khuyến mại:</label>
                                    <div>
                                        <input type="radio" id="applyAll" name="applyType" value="all" checked>
                                        <label for="applyAll">Toàn bộ sản phẩm</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="applySpecific" name="applyType" value="specific">
                                        <label for="applySpecific">Sản phẩm cụ thể</label>
                                    </div>
                                </div>

                                <div id="specificProducts" style="display: none; max-height: 300px; overflow-y: auto;">
                                    <label>Tìm sản phẩm:</label>
                                    <input type="text" id="searchProduct" placeholder="Tìm kiếm sản phẩm..."
                                        class="form-control">

                                    <label>Chọn sản phẩm:</label>
                                    <div id="productList">
                                        <!-- Danh sách sản phẩm sẽ được render tại đây -->
                                        @foreach ($products as $product)
                                            <div class="product-item" data-name="{{ strtolower($product->name) }}">
                                                <input type="checkbox" id="product{{ $product->id }}" name="products[]"
                                                    value="{{ $product->id }}"
                                                    @if ($promotion->products->contains($product->id)) checked @endif>
                                                <label for="product{{ $product->id }}">{{ $product->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="savePromotion" class="btn btn-success">Lưu</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Bỏ qua</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-input');
                const dataContainer = document.getElementById('data');

                searchInput.addEventListener('input', function() {
                    const keyword = searchInput.value;

                    // Gửi yêu cầu AJAX
                    fetch(`/admin/promotion?s=${keyword}`, {
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
                        .catch(error => console.error('Error fetching promotions:', error));
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Bắt sự kiện click vào nút .btn-view
                $('.btn-view').on('click', function() {
                    const promotionId = $(this).data('id'); // Lấy ID từ nút
                    $('#promotionModalLabel').text('Thông tin chi tiết');
                    // Gửi yêu cầu AJAX để lấy chi tiết khuyến mãi
                    $.ajax({
                        url: `/admin/promotion/${promotionId}`, // Đường dẫn API hoặc route để lấy dữ liệu
                        type: 'GET',
                        success: function(response) {
                            // Kiểm tra dữ liệu trả về từ server
                            if (response.success) {
                                const promotion = response.data; // Dữ liệu khuyến mãi từ server

                                // Đổ dữ liệu vào các trường trong modal
                                $('#itemCode').val(promotion.id); // Mã khuyến mãi
                                $('#itemName').val(promotion.name); // Tên khuyến mãi
                                $('#description').val(promotion.description); // Mô tả khuyến mãi
                                $('#itemType').val(promotion.discount_type);
                                $('#itemValue').val(promotion.discount_value);
                                $('#starDate').val(promotion.start_date);
                                $('#endDate').val(promotion.end_date);
                                // Hiển thị modal
                                $('#promotionModal').modal('show');
                            } else {
                                alert('Không thể tải dữ liệu khuyến mãi.'); // Xử lý lỗi nếu cần
                            }
                        },
                        error: function() {
                            alert('Có lỗi xảy ra khi kết nối đến server.');
                        }
                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const applyAllRadio = document.getElementById('applyAll');
                const applySpecificRadio = document.getElementById('applySpecific');
                const specificProductsDiv = document.getElementById('specificProducts');

                applyAllRadio.addEventListener('change', function() {
                    if (applyAllRadio.checked) {
                        specificProductsDiv.style.display = 'none'; // Ẩn danh sách checkbox
                    }
                });

                applySpecificRadio.addEventListener('change', function() {
                    if (applySpecificRadio.checked) {
                        specificProductsDiv.style.display = 'block'; // Hiển thị danh sách checkbox
                    }
                });
            });
            // ngăn hành động gửi form của id này
            document.getElementById('searchProduct').addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Ngăn hành động mặc định là gửi form
                }
            });
            // script tìm kiếm sản phẩm trực tiếp
            document.getElementById('searchProduct').addEventListener('input', function() {
                const keyword = this.value.toLowerCase(); // Lấy từ khóa tìm kiếm và chuyển thành chữ thường

                // Lấy tất cả các sản phẩm trong danh sách
                const productItems = document.querySelectorAll('.product-item');

                // Duyệt qua tất cả các sản phẩm và kiểm tra xem tên sản phẩm có chứa từ khóa tìm kiếm không
                productItems.forEach(item => {
                    const productName = item.getAttribute(
                        'data-name'); // Lấy tên sản phẩm (đã chuyển thành chữ thường)

                    if (productName.includes(keyword)) {
                        item.style.display = ''; // Hiển thị sản phẩm nếu tên chứa từ khóa
                    } else {
                        item.style.display = 'none'; // Ẩn sản phẩm nếu tên không chứa từ khóa
                    }
                });
            });
        </script>
    @endsection
