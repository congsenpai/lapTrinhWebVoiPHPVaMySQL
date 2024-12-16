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
                                    <label for="itemType" class="form-label mr-2">Loại khuyến mại:</label>
                                    <select id="itemType" name="discount_type" class="form-control">
                                        <option value="percentage" selected>Giảm giá theo phần trăm</option>
                                        <option value="fixed">Giảm giá cố định</option>
                                    </select>
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="itemValue" class="form-label mr-2">Giá trị khuyến mại:</label>
                                    <input type="number" class="form-control" id="itemValue" name="discount_value">
                                </div>
                                <div class="dateTime-container d-flex" style="width:60%;justify-content:space-between;">
                                    <div class="form-group">
                                        <label for="startDate form-label mr-2" style="font-weight: bold;width:100%">Từ
                                            ngày:</label>
                                        <input type="date" id="startDate" name="start_date" class="form-control"
                                            style="width:100%">
                                    </div>
                                    <div class="form-group">
                                        <label for="endDate form-label mr-2" style="font-weight: bold;width:100%">Đến
                                            ngày:</label>
                                        <input type="date" id="endDate" name="end_date" class="form-control"
                                            style="width:100%">
                                    </div>
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <label for="description" class="form-label mr-2" style="width: 10%">Mô tả</label>
                                    <textarea class="form-control" id="description" rows="2" name="description" style="width: 90%;margin-left:30px"></textarea>
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
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="savePromotion" class="btn btn-success btn-save">Lưu</button>
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
                // Khi form được submit, kiểm tra giá trị của select và cập nhật nếu cần
                $('form').on('submit', function() {
                    // Kiểm tra nếu chưa thay đổi giá trị của select, đặt lại giá trị mặc định
                    var itemType = $('#itemType').val();
                    if (!itemType) {
                        $('#itemType').val('percentage'); // Đặt lại giá trị mặc định nếu không có giá trị
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Bắt sự kiện click vào nút .btn-view
                $('.btn-view').on('click', function() {
                    $('.btn-save').data('action', 'update'); // Đặt trạng thái là "Cập nhật"
                    const promotionId = $(this).data('id'); // Lấy ID từ nút
                    $('#promotionModalLabel').text('Thông tin chi tiết');

                    $('#promotionForm').attr('method', 'POST'); // Dùng POST mặc định
                    $('#promotionForm').attr('action', `/admin/promotion/${promotionId}`);
                    // Thêm trường ẩn để giả lập PUT method
                    if ($('input[name="_method"]').length === 0) {
                        $('#promotionForm').append('<input type="hidden" name="_method" value="PUT">');
                    }
                    $('#promotionModal').on('hidden.bs.modal', function() {
                        $('input[name="_method"]').remove(); // Xóa trường _method khi đóng modal
                    });
                    // Gửi yêu cầu AJAX để lấy chi tiết khuyến mãi

                    $.ajax({
                        url: `/admin/promotion/${promotionId}`, // Đường dẫn API hoặc route để lấy dữ liệu
                        type: 'GET',
                        success: function(response) {
                            // Kiểm tra dữ liệu trả về từ server
                            if (response.success) {
                                const promotion = response
                                .promotion; // Dữ liệu khuyến mãi từ server
                                const products = response.product;
                                const productsUsingPromotion = Array.isArray(response
                                        .productsUsingPromotion) ?
                                    response.productsUsingPromotion :
                                    Object.values(response
                                    .productsUsingPromotion); // Chuyển thành mảng nếu không phải là mảng
                                console.log(promotion);

                                // Đổ dữ liệu vào các trường trong modal
                                $('#itemCode').val(promotion.id); // Mã khuyến mãi
                                $('#itemName').val(promotion.name); // Tên khuyến mãi
                                $('#description').val(promotion.description); // Mô tả khuyến mãi
                                $('#itemType').val(promotion.discount_type);
                                $('#itemValue').val(promotion.discount_value);
                                $('#startDate').val(promotion.start_date);
                                $('#endDate').val(promotion.end_date);

                                // Đặt trạng thái checked cho các sản phẩm có ưu đãi
                                // Tạo danh sách sản phẩm trong productList
                                const productList = $('#productList');
                                productList.empty(); // Xóa các sản phẩm cũ
                                console.log(products);
                                console.log(productsUsingPromotion);

                                products.forEach(product => {
                                    // Kiểm tra xem sản phẩm có trong danh sách productsUsingPromotion không
                                    const isChecked = productsUsingPromotion.some(
                                        promotionProduct => promotionProduct.id ===
                                        product.id) ? 'checked' : '';

                                    const productItem = `
                <div class="product-item" data-name="${product.name.toLowerCase()}">
                <input type="checkbox" id="product${product.id}" name="products[]" value="${product.id}" ${isChecked}>
                <label for="product${product.id}">${product.name}</label></div>`;

                                    productList.append(productItem);
                                });
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
                // Bắt sự kiện thay đổi trạng thái áp dụng khuyến mãi
                $('#applyAll').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('#specificProducts').hide(); // Ẩn danh sách checkbox nếu áp dụng toàn bộ sản phẩm
                    }
                });

                $('#applySpecific').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('#specificProducts').show(); // Hiển thị danh sách checkbox nếu chọn sản phẩm cụ thể
                    }
                });

                // Ngăn hành động gửi form khi nhấn Enter trong ô tìm kiếm
                $('#searchProduct').on('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                    }
                });

                // Tìm kiếm sản phẩm trực tiếp
                $('#searchProduct').on('input', function() {
                    const keyword = $(this).val().toLowerCase(); // Lấy từ khóa tìm kiếm

                    // Lọc các sản phẩm trong danh sách
                    $('#productList .product-item').each(function() {
                        const productName = $(this).data('name'); // Lấy tên sản phẩm
                        if (productName.includes(keyword)) {
                            $(this).show(); // Hiển thị sản phẩm nếu khớp từ khóa
                        } else {
                            $(this).hide(); // Ẩn sản phẩm nếu không khớp
                        }
                    });
                });
            });
        </script>
        {{-- script nút btn-add --}}
        <script>
            $(document).ready(function() {
                // Get the product list from the server
                var products = <?php echo json_encode($products); ?>;
                console.log(products);

                $('.btn-add').on('click', function() {
                    $('.btn-save').data('action', 'add'); // Đặt trạng thái là "Thêm mới"
                    $('.btn-save').text('Lưu');
                    $('#promotionModalLabel').text('Thêm mới khuyến mãi');
                    $('#itemCode').val('');
                    $('#itemName').val('');
                    $('#description').val('');
                    $('#itemType').val('');
                    $('#itemValue').val('');
                    $('#startDate').val('');
                    $('#endDate').val('');

                    const productList = $('#productList');
                    productList.empty();
                    // hiển thị danh sách cách sản phẩm mặc định
                    products.forEach(product => {
                        try {
                            const productItem = `
                            <div class="product-item" data-name="${product.name.toLowerCase()}">
                            <input type="checkbox" id="product${product.id}" name="products[]" value="${product.id}">
                            <label for="product${product.id}">${product.name}</label>
                            </div>`;
                            productList.append(productItem);
                        } catch (error) {
                            console.error('Lỗi khi thêm sản phẩm:', error);
                        }
                    });
                });
            });
        </script>
    @endsection
