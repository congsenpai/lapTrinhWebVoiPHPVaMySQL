@extends('layouts.app')

@section('content')
    <style>
        .file-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .file-preview-item {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            min-width: 200px;
            background: #f9f9f9;
            position: relative;
            flex: 1 1 auto;
        }

        .file-preview-item img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-right: 10px;
        }

        .file-preview-item .file-info {
            flex-grow: 1;
        }

        .file-preview-item .file-info .file-name {
            font-size: 14px;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-preview-item .file-info .file-type {
            font-size: 12px;
            color: #666;
        }

        .file-preview-item .remove-file {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-size: 16px;
            color: #e74c3c;
            background: none;
            border: none;
        }
    </style>
    <div class="container">
        <h1>Thêm sản phẩm mới</h1>
        <form action="{{ route('addproduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Số lượng</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>

            <div class="mb-3 ">
                <label for="images" class="form-label">Hình ảnh</label>
                <div class="container">
                    <input type="file" id="fileInput" name="images[]" multiple>
                    <div id="filePreview" class="file-preview-container"></div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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
