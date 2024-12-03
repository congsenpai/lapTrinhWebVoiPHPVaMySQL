@extends('admin.layouts.app') {{-- Kế thừa layout chính, nếu có --}}

@section('content')
    <style>
        .file-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            /* Grid responsive */
            gap: 10px;
            /* Khoảng cách giữa các hình ảnh */
        }

        .file-preview-item img {
            width: 100%;
            /* Tự động điều chỉnh theo kích thước cột */
            height: 100px;
            /* Chiều cao cố định */
            object-fit: cover;
            /* Căn chỉnh hình ảnh trong khung */
            border-radius: 5px;
            /* Bo góc cho hình ảnh */
            border: 1px solid #ddd;
            /* Đường viền nhạt */
        }

        .file-preview-item {
            position: relative;
            text-align: center;
            /* Canh giữa nội dung bên trong */
        }

        .remove-file {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
        }
        .nice-select .current{
            width: 100px;
            color: black;
        }
    </style>

    <div class="container">
        <h1>Thêm Sản Phẩm Mới</h1>

        {{-- Hiển thị thông báo lỗi nếu có --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form thêm sản phẩm --}}
        <form action="{{ route('addproduct') }}" method="POST" enctype="multipart/form-data">
            @csrf {{-- Bảo vệ form CSRF --}}

            {{-- Tên sản phẩm --}}
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            {{-- Mô tả sản phẩm --}}
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            {{-- Giá sản phẩm --}}
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                    min="0" step="0.01" required>
            </div>

            {{-- Số lượng tồn kho --}}
            <div class="form-group">
                <label for="stock">Số lượng tồn kho:</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}"
                    min="0" required>
            </div>

            {{-- Danh mục sản phẩm --}}
            <div class="form-group">
                <label for="category_id">Danh mục:</label>
                <select name="category_id" id="category_id" class="form-control"  required>
                    <option value="" selected>Chọn danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="brand_id">Thương hiệu:</label>
                <select name="brand_id" id="brand_id" class="form-control"  required>
                    <option value="" selected>Chọn thương hiệu</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('category_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Hình ảnh sản phẩm --}}
            <div class="form-group">
                <label for="images">Hình ảnh:</label>
                <div class="container">
                    <input type="file" id="fileInput" name="images[]" multiple>
                    <div id="filePreview" class="file-preview-container"></div>
                </div>
            </div>

            {{-- Nút submit --}}
            <button type="submit" class="btn btn-primary mt-3">Thêm sản phẩm</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('fileInput').addEventListener('change', function(event) {
                const filePreview = document.getElementById('filePreview');
                filePreview.innerHTML = ''; // Clear previous previews

                const files = event.target.files;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    // Create preview item
                    const previewItem = document.createElement('div');
                    previewItem.classList.add('file-preview-item');

                    // Create thumbnail (default to PDF icon if file is not an image)
                    const thumbnail = document.createElement('img');
                    thumbnail.style.width = '80px'; // Thumbnail width
                    thumbnail.style.height = '80px'; // Thumbnail height
                    thumbnail.style.objectFit = 'cover'; // Maintain aspect ratio
                    if (file.type.startsWith('image/')) {
                        thumbnail.src = URL.createObjectURL(file);
                    } else {
                        thumbnail.src = 'https://via.placeholder.com/40?text=PDF';
                    }
                    previewItem.appendChild(thumbnail);

                    // Create file info
                    const fileInfo = document.createElement('div');
                    fileInfo.classList.add('file-info');

                    const fileName = document.createElement('div');
                    fileName.classList.add('file-name');
                    fileName.textContent = file.name;
                    fileInfo.appendChild(fileName);

                    const fileType = document.createElement('div');
                    fileType.classList.add('file-type');
                    fileType.textContent = file.type.split('/')[1] || 'Unknown';
                    fileInfo.appendChild(fileType);

                    previewItem.appendChild(fileInfo);

                    // Add remove button
                    const removeButton = document.createElement('button');
                    removeButton.classList.add('remove-file');
                    removeButton.innerHTML = '&times;';
                    removeButton.addEventListener('click', () => {
                        previewItem.remove(); // Remove item from preview
                    });
                    previewItem.appendChild(removeButton);

                    filePreview.appendChild(previewItem);
                }
            });
        });

        document.getElementById('fileInput').addEventListener('change', function(event) {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const maxSize = 5 * 1024 * 1024; // 2MB

                if (file.size > maxSize) {
                    alert('Kích thước 1 ảnh không được vượt quá 5MB');
                    event.target.value = ''; // Reset file input
                    return;
                }
            }
        });
    </script>
@endsection
