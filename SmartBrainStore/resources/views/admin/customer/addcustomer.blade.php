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
        <form action="{{ route('addcustomer') }}" method="POST" enctype="multipart/form-data" style="display: block" id="addcustomerModal">
            @csrf {{-- Bảo vệ form CSRF --}}

            {{-- Họ tên--}}
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Tên khách hàng:</label>
                <div class="col-sm-9">
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
            </div>

            {{-- Email --}}
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email:</label>
                <div class="col-sm-9">
                    <textarea name="email" id="email" class="form-control">{{ old('email') }}</textarea>
                </div>
            </div>

            {{-- Password --}}
            <div class="form-group row">
                <label for="Password" class="col-sm-3 col-form-label">Mật khẩu:</label>
                <div class="col-sm-9">
                    <textarea name="password" id="password" class="form-control">{{ old('password') }}</textarea>
                </div>
            </div>

            {{-- Điện thoại--}}
            <div class="form-group row">
                <label for="price" class="col-sm-3 col-form-label">Điện thoại:</label>
                <div class="col-sm-9">
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
            </div>

            {{-- Địa chỉ --}}
            <div class="form-group row">
                <label for="address" class="col-sm-3 col-form-label">Địa chỉ:</label>
                <div class="col-sm-9">
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
                </div>
            </div>
            <input type="hidden" name="role" id="role" class="form-control" value="customer"
                     required>
            <input type="hidden" name="created_at" id="created_at" class="form-control" value="{{ time() }}"
                     required>

            
                     
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width:30%;float:right;margin-bottom:20px;margin-left:20px">Đóng</button>

            {{-- Nút submit --}}
            <button type="submit" class="btn btn-primary mt-3" style="width:30%;float:right;margin-bottom:20px">Lưu</button>
        </form>

    {{-- <script>
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
    </script> --}}

