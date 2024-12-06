@extends('admin.layouts.app')
@section('content')
    <section class="p-3" style="padding-right: 30px">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-12" style="display:flex;justify-content:flex-end">
                <button class="btn btn-primary btn-add newUser" data-toggle="modal" data-target="#productModal">Thêm sản
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

                                    // Lấy danh sách ảnh không phải ảnh chính
                                    $nonPrimaryImages = $product->images->where('is_primary', false);

                                    // Chuyển đổi danh sách ảnh thành URL
                                    $nonPrimaryImageUrls = $nonPrimaryImages->map(function ($image) {
                                        return asset('storage/' . $image->image_url);
                                    });
                                @endphp
                                <td> <img src="{{ $imageUrl }}" alt="{{ $product->name }}" width="50" height="50"
                                        style="object-fit: contain" class="product-thumbnail">
                                </td>
                                <td> <a href="#">{{ $product->name }}</a></td>
                                <td> <a href="#">{{ $product->price }}</a></td>
                                <td> <a href="#">{{ $product->stock }}</a></td>
                                <td>
                                    <!-- View Product Modal Trigger -->
                                    <button class="btn btn-info btn-sm btn-view" id="btnShowModal"
                                        data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                                        data-product-price="{{ $product->price }}"
                                        data-product-stock="{{ $product->stock }}"
                                        data-product-primary-image="{{ $imageUrl }}"
                                        data-product-images="{{ json_encode($product->images->pluck('image_url')) }}">Xem</button>
                                    <button class="btn btn-danger btn-sm btn-delete"
                                        data-product-id="{{ $product->id }}">Xóa</button>
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


        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel">
            <div class="modal-dialog modal-lg">
                <form action="" method="POST" enctype="multipart/form-data" class="modal-content" id="productForm">
                    @csrf {{-- Bảo vệ form CSRF --}}
                    <div class="modal-header">
                        <h3 class="modal-title" id="productModalLabel"></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Hình ảnh chính -->
                                <div class="mb-3 d-flex row justify-content-center align-items-center">
                                    <img id="primaryImage" src="{{ Vite::asset('resources/images/default-product.jpg') }}"
                                        alt="Large Image" class="image-large">
                                </div>

                                <!-- Carousel -->
                                <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators"></ol>
                                    <div class="carousel-inner"></div>
                                    <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <!-- Upload hình ảnh -->
                                <div id="container-uploadImages" class="d-flex justify-content-center form-group"
                                    style="display: none">
                                    <input type="file" id="fileInput" name="images[]" multiple style="display: none;"
                                        accept="image/*">
                                    <div id="filePreview" class="file-preview-container" style="display:none"></div>
                                    <label for="fileInput" class="file-label">
                                        <div class="file-selector"></div>
                                        <div class="file-selector"></div>
                                        <div class="file-selector"></div>
                                        <div class="file-selector"></div>
                                        <div class="file-selector"></div>
                                        <button id="clearAll" class="clear-button">
                                            <i class="fa-solid fa-circle-xmark" style="color: #ff0000;">
                                            </i>
                                        </button>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <!-- Form hiển thị thông tin sản phẩm -->
                                <div class="form-group d-flex align-items-center">
                                    <label for="itemCode" class="form-label mr-2">Mã hàng:</label>
                                    <input type="text" class="form-control" id="itemCode" readonly>
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="itemName" class="form-label mr-2">Tên hàng:</label>
                                    <input type="text" class="form-control" id="itemName" name="name">
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="itemCategory" class="form-label mr-2">Nhóm hàng:</label>
                                    <select class="form-control" id="itemCategory" name="category_id">
                                        <option value="" selected id="itemCategoryLabel">Chọn nhóm hàng</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="itemBrand" class="form-label mr-2">Thương hiệu:</label>
                                    <select class="form-control" id="itemBrand" name="brand_id">
                                        <option value="" selected id="itemBrandLabel">Chọn thương hiệu</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="sellingPrice" class="form-label mr-2">Giá bán:</label>
                                    <input type="number" class="form-control" id="sellingPrice" name="price">
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="stockQuantity" class="form-label mr-2">Tồn kho:</label>
                                    <input type="number" class="form-control" id="stockQuantity" name="stock">
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <label for="description" class="form-label mr-2">Mô tả</label>
                                    <textarea class="form-control" id="description" rows="1" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="saveProduct" class="btn btn-success">Lưu</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Bỏ qua</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const productModal = $('#productModal');
            const primaryImage = document.getElementById('primaryImage');
            const imageCarouselIndicators = document.querySelector('#imageCarousel .carousel-indicators');
            const imageCarouselInner = document.querySelector('#imageCarousel .carousel-inner');
            const uploadImages = document.getElementById('uploadImages');
            const productForm = document.getElementById('productForm')
            let imageList = []; // Danh sách hình ảnh đã upload
            $(document).ready(function() {
                // Khi nhấn nút "Thêm sản phẩm"
                $('.btn-add').on('click', function() {
                    // Đặt lại tiêu đề modal và cấu hình form cho "Thêm sản phẩm"
                    $('#productModalLabel').text('Thêm sản phẩm');
                    // Thay đổi nút thành "Tạo sản phẩm"
                    $('#saveProduct').text('Tạo sản phẩm');
                    productForm.action = '{{ route('createproduct') }}';
                    $('#primaryImage').attr('src',
                        '{{ Vite::asset('resources/images/default-product.jpg') }}');
                    resetModal();

                    // Ẩn carousel và hiển thị container-uploadImages
                    $('#imageCarousel').hide();
                    $('#container-uploadImages').show();

                    // Reset file input và file preview
                    $('#fileInput').val('');
                    $('#filePreview').empty();

                    // Hiển thị modal
                    productModal.modal('show');
                });

                // Khi nhấn nút "Xem sản phẩm"
                $('.btn-view').on('click', function() {
                    resetModal();

                    // Thay đổi nút thành "Cập nhật"
                    $('#saveProduct').text('Cập nhật');

                    // Lấy ID sản phẩm từ thuộc tính data của nút
                    const productId = $(this).data('product-id');
                    const productForm = $('#productForm');

                    // Cập nhật URL action cho form và phương thức
                    productForm.attr('action', `/admin/product/${productId}`);
                    productForm.attr('method', 'POST'); // Dùng POST mặc định

                    // Thêm trường ẩn để giả lập PUT method
                    if ($('input[name="_method"]').length === 0) {
                        productForm.append('<input type="hidden" name="_method" value="PUT">');
                    }

                    // Ẩn phần tải hình ảnh mới và hiển thị carousel
                    $('#imageCarousel').show();
                    $('#container-uploadImages').hide();

                    // Gọi API lấy thông tin sản phẩm
                    fetch(`/api/product/${productId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json(); // Chuyển phản hồi thành JSON
                        })
                        .then(product => {
                            console.log('Category ID:', product.category.name);
                            console.log('Brand ID:', product.brand.name);

                            // Hiển thị thông tin sản phẩm trong modal
                            $('#productModalLabel').text('Thông tin sản phẩm');
                            $('#itemCode').val(product.id); // Mã sản phẩm
                            $('#itemName').val(product.name); // Tên sản phẩm
                            $('#description').val(product.description); // Mô tả
                            $('#sellingPrice').val(product.price); // Giá bán
                            $('#stockQuantity').val(product.stock); // Tồn kho

                            // Cập nhật giá trị cho Nice Select
                            $('#itemCategory').val(product.category_id);
                            $('#itemBrand').val(product.brand_id);

                            // Cập nhật giao diện Nice Select
                            $('#itemCategory').niceSelect('update');
                            $('#itemBrand').niceSelect('update');

                            // Cập nhật hình ảnh sản phẩm
                            updateImageGallery(product.images);

                            // Hiển thị modal
                            $('#productModal').modal('show');
                        })
                        .catch(err => {
                            console.error('Error fetching product:', err);
                            alert('Không thể lấy thông tin sản phẩm.');
                        });
                    // Xóa trường _method sau khi cập nhật (giả sử sau khi submit form hoặc khi đóng modal)

                    $('#productModal').on('hidden.bs.modal', function() {
                        $('input[name="_method"]').remove(); // Xóa trường _method khi đóng modal
                    });
                });

                // khi người dùng nhấn vào nút xóa sản phẩm
                $('.btn-delete').on('click', function() {
                    var productId = $(this).data('product-id');

                    // Hiển thị hộp thoại xác nhận
                    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                        // Gửi yêu cầu AJAX để xóa sản phẩm
                        $.ajax({
                            url: '/admin/product/' + productId, // Đảm bảo đường dẫn đúng
                            type: 'DELETE',
                            data: {
                                id: productId,
                                _token: $('meta[name="csrf-token"]').attr('content') // Thêm token CSRF
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Sản phẩm đã được xóa.');
                                    // Xóa dòng sản phẩm khỏi bảng
                                    $('button[data-product-id="' + productId + '"]').closest('tr')
                                        .remove();
                                } else {
                                    alert('Có lỗi xảy ra khi xóa sản phẩm.');
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                                console.log(error); // Xem chi tiết lỗi nếu cần
                            }
                        });
                    }
                });
                // hàm reset Modal
                function resetModal() {
                    $('#itemCode').val(''); // Mã sản phẩm
                    $('#itemName').val(''); // Tên sản phẩm
                    $('#sellingPrice').val(''); // Giá bán
                    $('#stockQuantity').val(''); // Tồn kho
                    $('#description').val(''); // Mô tả
                    // Reset giá trị các ô select về giá trị mặc định
                    $('#itemCategory').val('').niceSelect('update'); // Đặt lại select nhóm hàng về giá trị mặc định
                    $('#itemBrand').val('').niceSelect('update'); // Đặt lại select thương hiệu về giá trị mặc định
                }
                // hàm cập nhật lại hình ảnh trong modal
                function updateImageGallery(images) {
                    const indicators = document.querySelector('#imageCarousel .carousel-indicators');
                    const inner = document.querySelector('#imageCarousel .carousel-inner');
                    const primaryImageElement = document.getElementById('primaryImage');
                    const baseUrl = window.location.origin;

                    const totalSlides = images.length; // Total number of slides needed
                    // Xóa các phần tử cũ trong carousel
                    indicators.innerHTML = '';
                    inner.innerHTML = '';

                    if (totalSlides === 0) {
                        console.log("No images to display.");
                        return; // Nếu không có ảnh, dừng hàm
                    }

                    let primaryImageFound = false; // Biến kiểm tra xem ảnh chính đã được tìm thấy chưa

                    // Tìm và gán ảnh chính vào phần tử primaryImage
                    const primaryImage = images.find(image => image.is_primary === 1);
                    if (primaryImage) {
                        primaryImageElement.src = `${baseUrl}/storage/${primaryImage.image_url}`;
                        primaryImageFound = true; // Đánh dấu là ảnh chính đã được tìm thấy và gán
                    }

                    // Tiến hành tạo carousel cho các ảnh còn lại
                    for (let index = 0; index < totalSlides; index++) {
                        // Nếu ảnh này là ảnh chính, bỏ qua nó trong carousel
                        if (images[index].is_primary === 1) {
                            continue;
                        }

                        // Add indicators
                        const indicator = document.createElement('li');
                        indicator.setAttribute('data-target', '#imageCarousel');
                        indicator.setAttribute('data-slide-to', index);
                        if (index === 0) indicator.classList.add('active');
                        indicators.appendChild(indicator);

                        // Add carousel items
                        const item = document.createElement('div');
                        item.className = `carousel-item ${index === 0 ? 'active' : ''}`;
                        const group = document.createElement('div');
                        group.className = 'd-flex justify-content-center';

                        // Add exactly 3 images per slide (wrapping around if needed)
                        for (let i = 0; i < 3; i++) {
                            const imgIndex = (index + i) % images.length; // Wrap around using modulo
                            const img = document.createElement('img');

                            // Extract the image URL from the current image object
                            const imageUrl = images[imgIndex].image_url;
                            // Construct the full image URL
                            img.src = `${baseUrl}/storage/${imageUrl}`;

                            img.className = 'image-small mx-2';
                            group.appendChild(img);
                        }

                        item.appendChild(group);
                        inner.appendChild(item);
                    }
                }
            });
        </script>
        <script>
            document.getElementById('fileInput').addEventListener('change', function(event) {
                const files = event.target.files; // Lấy các file người dùng chọn
                const maxSize = 5 * 1024 * 1024; // Giới hạn dung lượng là 5MB (5 * 1024 * 1024 bytes)
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif']; // Các loại file hợp lệ
                let valid = true;
                // Duyệt qua từng file
                for (let i = 0; i < files.length; i++) {
                    // Kiểm tra loại file
                    if (!allowedTypes.includes(files[i].type)) {
                        valid = false;
                        break; // Nếu một file không hợp lệ, dừng kiểm tra
                    }

                    // Kiểm tra dung lượng file
                    if (files[i].size > maxSize) {
                        valid = false;
                        break; // Nếu một file vượt quá dung lượng, dừng kiểm tra
                    }
                }

                // Hiển thị thông báo lỗi nếu file không hợp lệ hoặc dung lượng ảnh vượt quá giới hạn
                if (!valid) {
                    document.getElementById('errorMessage').style.display = 'block'; // Hiển thị lỗi
                    document.getElementById('fileInput').value = ''; // Xóa lựa chọn file
                } else {
                    document.getElementById('errorMessage').style.display = 'none'; // Ẩn thông báo lỗi
                }
            });


            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('fileInput');
                const fileSelectors = document.querySelectorAll('.file-selector');
                const clearAllButton = document.getElementById('clearAll');

                const maxFiles = 5;

                fileInput.addEventListener('change', function(event) {
                    const files = Array.from(event.target.files);

                    // Kiểm tra giới hạn số lượng file
                    if (files.length > maxFiles) {
                        alert(`Bạn chỉ có thể chọn tối đa ${maxFiles} hình ảnh.`);
                        fileInput.value = ''; // Reset input
                        return;
                    }

                    // Gán ảnh vào các thẻ selector
                    fileSelectors.forEach((selector, index) => {
                        if (files[index]) {
                            selector.style.backgroundImage =
                                `url(${URL.createObjectURL(files[index])})`;
                        } else {
                            selector.style.backgroundImage = ''; // Xóa ảnh nếu không có file
                        }
                    });

                    // Cập nhật phần preview
                    updatePreview(files);
                });

                // Hàm cập nhật preview
                function updatePreview(files) {
                    const filePreview = document.getElementById('filePreview');
                    filePreview.innerHTML = ''; // Xóa nội dung trước đó

                    files.forEach(() => {
                        // Tạo phần tử hiển thị preview
                        const previewItem = document.createElement('div');
                        previewItem.classList.add('file-preview-item');

                        // Không tạo thẻ <img>, chỉ để phần preview
                        filePreview.appendChild(previewItem);
                    });
                }

                // Xóa toàn bộ
                clearAllButton.addEventListener('click', function() {
                    fileInput.value = ''; // Reset file input
                    fileSelectors.forEach((selector) => {
                        selector.style.backgroundImage = ''; // Xóa ảnh trên selector
                    });
                    updatePreview([]); // Xóa toàn bộ preview
                });
            });
        </script>
    </section>
@endsection
