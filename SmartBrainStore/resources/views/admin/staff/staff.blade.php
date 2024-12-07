@extends('admin.layouts.app')
@section('content')
    <style>
        /* CSS for Modal */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            /* Black background with opacity */
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 8px;
            width: 60%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .modal-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .modal-footer {
            margin-top: 20px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        input,
        button {
            padding: 10px;
            margin: 5px 0;
            width: 90%;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        td button {
            width: 40%;
            float: left;
        }
    </style>

    <h1>Staff List</h1>
    <section class="p-3" style="padding-right: 30px">

        <div class="row" style="margin-bottom: 10px;width: 20%;float:right">
            <button data-toggle="modal" data-target="#addStaffModal" id="btnShowModal">Thêm Nhân Viên</button>
        </div>
        <!-- The Modal -->
        {{-- <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-header">Thêm Nhân Viên</div>
                @include('admin.staff.addstaff')
            </div>
        </div> --}}
        <!-- Modal Update-->
        <div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStaffModalLabel">Thêm nhân viên</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        @include('admin.staff.addstaff')
                    </div>

                    <!-- Modal Footer -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>email</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody id="data">
                        <div class="staff-data">
                            @include('admin.staff.pagination')
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Update-->
        <div class="modal fade" id="updateStaffModal" tabindex="-1" role="dialog" aria-labelledby="updateStaffModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStaffModalLabel">Sửa nhân viên</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        @include('admin.staff.updatestaff')
                    </div>

                    <!-- Modal Footer -->
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
                        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
                    </script>

                    <script>
                        // Populate modal form with data from button
                        $('#updateStaffModal').on('show.bs.modal', function(event) {
                            const button = $(event.relatedTarget); // Button that triggered the modal

                            // Get data attributes from button
                            const name = button.data('name');
                            const email = button.data('email');
                            const password = button.data('password');
                            const phone = button.data('phone');
                            const address = button.data('address');

                            // Populate form fields in the modal
                            const modal = $(this);
                            modal.find('#name').val(name);
                            modal.find('#email').val(email);
                            modal.find('#password').val(password);
                            modal.find('#phone').val(phone);
                            modal.find('#address').val(address);
                        });

                        // Save form data
                        // function saveForm() {
                        //     const form = $('#productForm');
                        //     const data = form.serializeArray();

                        //     let formData = {};
                        //     data.forEach(item => {
                        //         formData[item.name] = item.value;
                        //     });

                        //     alert(`Thông tin đã lưu:\n${JSON.stringify(formData, null, 2)}`);
                        // }
                    </script>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    fetch_data(page);
                });

                function fetch_data(page) {
                    $.ajax({
                        url: "/posts?page=" + page,
                        success: function(data) {
                            $('#post-data').html(data);
                        }
                    });
                }
            });
        </script>
        <!--Modal Form-->
        <script>
            const images = [
                "pic01.png",
                "pic02.jpg",
                "pic03.jpg",
                "pic04.jpg"
            ];

            const indicators = document.querySelector('#imageCarousel .carousel-indicators');
            const inner = document.querySelector('#imageCarousel .carousel-inner');

            const totalSlides = images.length; // Số slide cần tạo

            for (let index = 0; index < totalSlides; index++) {
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
                    img.src = images[imgIndex];
                    img.className = 'image-small mx-2';
                    group.appendChild(img);
                }

                item.appendChild(group);
                inner.appendChild(item);
            }
        </script>
        <!-- Hiển thị thông báo alert sau khi thêm sửa xóa-->
        @if (session('addsuccess'))
            <script>
                alert("{{ session('addsuccess') }}");
            </script>
        @endif
        @if (session('updatesuccess'))
            <script>
                alert("{{ session('updatesuccess') }}");
            </script>
        @endif
        @if (session('deletesuccess'))
            <script>
                alert("{{ session('deletesuccess') }}");
            </script>
        @endif

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            // JavaScript for Modal
            const modal = document.getElementById('myModal');
            const openModalBtn = document.getElementById('openModal');
            const closeModalSpan = document.querySelector('.close');
            const employeeForm = document.getElementById('employeeForm');

            // Open modal
            openModalBtn.onclick = function() {
                modal.style.display = 'block';
            };

            // Close modal when clicking on (x)
            closeModalSpan.onclick = function() {
                modal.style.display = 'none';
            };

            // Close modal when clicking outside the modal content
            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };

            // Handle form submission
            employeeForm.onsubmit = function(event) {
                event.preventDefault();
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const position = document.getElementById('position').value;

                alert(`Thông tin nhân viên:\nTên: ${name}\nEmail: ${email}\nChức vụ: ${position}`);

                // Clear the form and close the modal
                employeeForm.reset();
                modal.style.display = 'none';
            };
        </script>
    </section>
@endsection
