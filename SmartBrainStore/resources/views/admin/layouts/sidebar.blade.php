<nav class="navbar-default navbar-static-side"
    style="padding-left:20px;width:100%; padding-bottom:20px; background-color:#2f4050" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header" style="border-top-left-radius: 8px; border-top-right-radius:8px">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="{{ Vite::asset('resources/images/favicon.png') }}" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ Auth::user()->name }}</strong>
                            </span>
                            <span class="text-muted text-xs block">{{ Auth::user()->role }}<b class="caret"></b></span>
                        </span>
                    </a>
                    
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href="#"> <span class="nav-label">Tổng quan</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Nhân viên</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Thương hiệu</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Loại sản phẩm</span></a>
            </li>
            <li>
                <a href="{{ route('adminproduct') }}"><i class="fa fa-diamond"></i> <span class="nav-label">Sản
                        phẩm</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Hóa đơn</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Khách hàng</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Vocher</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Khuyến mãi</span></a>
            </li>
            <li class="special_link">
                <a href="#"><i class="fa fa-database"></i> <span class="nav-label">Đổi mật khẩu</span></a>
            </li>
        </ul>
    </div>
</nav>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Lấy tất cả các thẻ <li> có chứa class con 'nav-label'
        const listItems = document.querySelectorAll("li");

        // Lặp qua từng thẻ <li> và thêm sự kiện click nếu thẻ con có class 'nav-label'
        listItems.forEach((item) => {
            const hasNavLabel = item.querySelector(".nav-label"); // Kiểm tra class con
            if (hasNavLabel) {
                item.addEventListener("click", function() {
                    // Xóa class 'active' từ tất cả các thẻ <li> có chứa 'nav-label'
                    listItems.forEach((li) => {
                        if (li.querySelector(".nav-label")) {
                            li.classList.remove("active");
                        }
                    });

                    // Thêm class 'active' cho thẻ được click
                    this.classList.add("active");
                });
            }
        });
    });
</script>
