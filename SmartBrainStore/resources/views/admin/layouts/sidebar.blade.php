@php
    $menuItems = [
        [
            'name' => 'dashboard',
            'label' => 'Tổng quan',
            'icon' => 'fa-table-columns',
            'url' => route('dashboard'),
        ],
        [
            'name' => 'adminstaff',
            'label' => 'Nhân viên',
            'icon' => 'fa-person-cane',
            'url' => route('adminstaff'),
        ],
        [
            'name' => 'adminbrand',
            'label' => 'Thương hiệu',
            'icon' => 'fa-copyright',
            'url' => route('adminbrand'),
        ],
        [
            'name' => 'admincategory',
            'label' => 'Loại sản phẩm',
            'icon' => 'fa-list',
            'url' => route('admincategory'),
        ],
        [
            'name' => 'adminproduct',
            'label' => 'Sản phẩm',
            'icon' => 'fa-lemon',
            'url' => route('adminproduct'),
        ],
        [
            'name' => 'adminorder',
            'label' => 'Hóa đơn',
            'icon' => 'fa-file-invoice',
            'url' => route('adminorder'),
        ],
        [
            'name' => 'admincustomer',
            'label' => 'Khách hàng',
            'icon' => 'fa-user',
            'url' => route('admincustomer'),
        ],
        [
            'name' => 'adminvoucher',
            'label' => 'Vocher',
            'icon' => 'fa-gem',
            'url' => route('adminvoucher'),
        ],
        [
            'name' => 'adminpromotion',
            'label' => 'Khuyến mãi',
            'icon' => 'fa-percent',
            'url' => route('adminpromotion'),
        ],
        [
            'name' => 'adminchangepass',
            'label' => 'Đổi mật khẩu',
            'icon' => 'fa-database',
            'url' => route('adminchangepass'),
            'class' => 'special_link', // Dùng để thêm class đặc biệt nếu cần
        ],
    ];
@endphp
<nav class="navbar-default navbar-static-side"
    style="padding-left:20px;width:100%; padding-bottom:20px; background-color:#2f4050" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header" style="border-top-left-radius: 8px; border-top-right-radius:8px">
                <div class="dropdown profile-element" style="display: flex;align-items:flex-start;">

                    @if (Auth::check())
                        <span>
                            <img alt="image" class="img-circle" style="padding-right:10px; width:60px"
                                src="{{ Vite::asset('resources/images/favicon.png') }}" />
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">

                                <span class="block m-t-xs">
                                    <strong class="font-bold">{{ Auth::user()->name }}</strong>
                                </span>
                                <span class="text-muted text-xs block">{{ Auth::user()->role }}</span>
                            @else
                                <img src="{{ Vite::asset('resources/images/favicon.png') }}" alt="Default Avatar"
                                    width="50" height="50" style="border-radius: 50%;">
                    @endif
                    </span>
                    </a>

                </div>
                <div class="logo-element">IN+</div>
            </li>
            @foreach ($menuItems as $menu)
                <li class="{{ Route::currentRouteName() == $menu['name'] ? 'active' : '' }} {{ $menu['class'] ?? '' }}">
                    <a href="{{ $menu['url'] }}">
                        @if ($menu['icon'])
                            <i class="fa {{ $menu['icon'] }}"></i>
                        @endif
                        <span class="nav-label">{{ $menu['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
