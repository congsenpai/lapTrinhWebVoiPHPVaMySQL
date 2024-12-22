@extends('admin.layouts.app')
@section('content')
    
    <style>
        .filter-buttons {
            text-align: center;
            position: absolute;
            right: -1%;
            top: -1%;
        }

        .filter-buttons button {
            margin: 0 5px;
            padding: 0;
            border: none;
            font-size: 8px;
            width: 50px;
            height: 28px;
            cursor: pointer;
        }

        .chart-container {
            position: relative;
        }

        .justify-content-center {

            -webkit-box-pack: center !important;
            -ms-flex-pack: center !important;
            justify-content: center !important;

        }

        .ti {

            -ms-flex-negative: 0;
            flex-shrink: 0;
            font-size: 21px;

        }

        .fw-semibold {

            font-weight: 800 !important;
            font-size: 32px;
            color: #fff;
            transform: translateX(38%);
        }

        .text-white {

            --bs-text-opacity: 1;
            color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;

        }

        .text-dark {

            --bs-text-opacity: 1;
            color: rgba(var(--bs-dark-rgb), var(--bs-text-opacity)) !important;

        }

        .mb-9 {

            margin-bottom: 20px !important;

        }

        .col-lg-5 {

            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 41.66666667%;

        }

        .row {

            --bs-gutter-x: 24px;
            --bs-gutter-y: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-0.5 * var(--bs-gutter-x));
            margin-left: calc(-0.5 * var(--bs-gutter-x));

        }

        .mb-sm-0 {

            margin-bottom: 0 !important;

        }

        .bg-secondary {

            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-secondary-rgb),
                    var(--bs-bg-opacity)) !important;

        }

        .d-flex {

            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;

        }

        .col-8 {

            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 66.66666667%;


        }

        .rounded-circle {

            border-radius: 50% !important;

        }

        .mb-1 {

            margin-bottom: 0.25rem !important;

        }

        .fs-6 {

            font-size: 1.25rem !important;

        }

        .align-items-stretch {

            -webkit-box-align: stretch !important;
            -ms-flex-align: stretch !important;
            align-items: stretch !important;

        }

        .card {
            border-radius: 18px !important;
            --bs-card-spacer-y: 30px;
            --bs-card-spacer-x: 30px;
            --bs-card-title-spacer-y: 0.5rem;
            --bs-card-title-color: #ffffff;
            --bs-card-subtitle-color: #2a3547;
            --bs-card-border-width: 0px;
            --bs-card-border-color: #ebf1f6;
            --bs-card-border-radius: 7px;
            --bs-card-box-shadow: rgba(145, 158, 171, 0.2) 0px 0px 2px 0px,
                rgba(145, 158, 171, 0.12) 0px 12px 24px -4px;
            --bs-card-inner-border-radius: 7px;
            --bs-card-cap-padding-y: 15px;
            --bs-card-cap-padding-x: 30px;
            --bs-card-cap-bg: rgba(var(--bs-body-color-rgb), 0.03);
            --bs-card-cap-color: ;
            --bs-card-height: ;
            --bs-card-color: #313896;
            --bs-card-bg: var(--bs-body-bg);
            --bs-card-img-overlay-padding: 1rem;
            --bs-card-group-margin: 12px;
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            height: var(--bs-card-height);
            word-wrap: break-word;
            background-color: var(--bs-card-bg);
            background-clip: border-box;
            border: var(--bs-card-border-width) solid var(--bs-card-border-color);
            border-radius: var(--bs-card-border-radius);
            -webkit-box-shadow: var(--bs-card-box-shadow);
            box-shadow: var(--bs-card-box-shadow);

            margin-bottom: var(--bs-card-group-margin);

            -webkit-box-flex: 1;
            -ms-flex: 1 0 0%;
            flex: 1 0 0%;
            margin-bottom: 0;

            margin-left: 0;
            border-left: 0;

            margin-bottom: 30px;

        }

        .col-lg-4 {

            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 33.33333333%;

        }

        .p-4 {

            padding: 1.5rem !important;

        }

        .bg-dark {

            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;

        }

        .form-select {

            --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            display: block;
            /*   width: 100%; */
            padding: 8px 38px 8px 16px;
            -moz-padding-start: 13px;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #5a6a85;
            background-color: transparent;
            background-image: var(--bs-form-select-bg-img),
                var(--bs-form-select-bg-icon, none);
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px 12px;
            border: var(--bs-border-width) solid #dfe5ef;
            border-radius: 7px;
            -webkit-box-shadow: unset;
            box-shadow: unset;
            -webkit-transition: border-color 0.15s ease-in-out,
                -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out,
                -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out,
                -webkit-box-shadow 0.15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;

            -webkit-transition: none;
            transition: none;

            --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%235A6A85' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");

            height: calc(3.5rem + calc(var(--bs-border-width) * 2));
            line-height: 1.25;

            padding-top: 1.625rem;
            padding-bottom: 0.625rem;

            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;

            padding-right: 54px;

            border-top-left-radius: 0;
            border-bottom-left-radius: 0;

        }

        .bg-info {

            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-info-rgb), var(--bs-bg-opacity)) !important;

        }

        .mb-3 {

            margin-bottom: 1rem !important;

        }

        .me-2 {

            margin-right: 0.5rem !important;

        }

        .p-6 {

            padding: 12px !important;

        }

        .mb-4 {

            margin-bottom: 1.5rem !important;

        }

        .align-items-center {

            -webkit-box-align: center !important;
            -ms-flex-align: center !important;
            align-items: center !important;

        }

        .table {

            --bs-table-color: var(--bs-body-color);
            --bs-table-bg: transparent;
            --bs-table-border-color: #ebf1f6;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: var(--bs-body-color);
            --bs-table-striped-bg: #eaeff4;
            --bs-table-active-color: var(--bs-body-color);
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: var(--bs-body-color);
            --bs-table-hover-bg: #f6f9fc;
            width: 100%;
            margin-bottom: 1rem;
            color: var(--bs-table-color);
            vertical-align: top;
            border-color: var(--bs-table-border-color);

        }

        .fw-normal {

            font-weight: 400 !important;

        }

        .align-middle {

            vertical-align: middle !important;

        }

        .d-block {

            display: block !important;

        }

        .justify-content-between {

            -webkit-box-pack: justify !important;
            -ms-flex-pack: justify !important;
            justify-content: space-between !important;

        }

        .w-100 {

            width: 100% !important;

        }

        .text-center {

            text-align: center !important;

        }

        .bg-warning {

            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-warning-rgb),
                    var(--bs-bg-opacity)) !important;

        }

        .text-nowrap {

            white-space: nowrap !important;

        }

        .table-responsive {

            overflow-x: auto;
            -webkit-overflow-scrolling: touch;

        }

        .fs-4 {

            font-size: 1rem !important;

        }

        .justify-content-end {

            -webkit-box-pack: end !important;
            -ms-flex-pack: end !important;
            justify-content: flex-end !important;

        }

        .col-lg-7 {

            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 58.33333333%;

        }

        .col-4 {

            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 33.33333333%;

        }

        .card-title {

            margin-bottom: var(--bs-card-title-spacer-y);
            color: var(--bs-card-title-color);

            font-size: 15px;
            transform: translateX(38%);
        }

        .mb-0 {

            margin-bottom: 0 !important;

        }

        .border-bottom-0 {

            border-bottom: 0 !important;

        }

        .col-lg-12 {

            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 100%;

        }

        .card-body {

            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
            background-color: var(--bs-card-color);
            border-radius: 18px;

        }

        .rounded-3 {

            border-radius: var(--bs-border-radius-lg) !important;

        }

        .d-sm-flex {

            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;

        }

        .badge {

            --bs-badge-padding-x: 10px;
            --bs-badge-padding-y: 5px;
            --bs-badge-font-size: 0.875rem;
            --bs-badge-font-weight: 400;
            --bs-badge-color: #fff;
            --bs-badge-border-radius: 4px;
            display: inline-block;
            padding: var(--bs-badge-padding-y) var(--bs-badge-padding-x);
            font-size: var(--bs-badge-font-size);
            font-weight: var(--bs-badge-font-weight);
            line-height: 1;
            color: var(--bs-badge-color);
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: var(--bs-badge-border-radius);

            position: relative;
            top: -1px;

        }

        .bg-success {

            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-success-rgb),
                    var(--bs-bg-opacity)) !important;

        }

        .bg-danger {

            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-danger-rgb),
                    var(--bs-bg-opacity)) !important;

        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body" style="background-color:#1ab394">
                                <div class="row alig n-items-start">
                                    <div class="col-8">
                                        <h5 class="card-title mb-9 fw-semibold">Tổng sản phẩm </h5>
                                        <h2 class="fw-semibold mb-3">{{ $totalProducts }}</h2>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div
                                                class="text-white bg-danger rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-apple fs-6"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Monthly Earnings -->
                        <div class="card">
                            <div class="card-body " style="background-color: rgb(243 237 237)">
                                <div class="row align-items-start">
                                    <div class="col-8 ">
                                        <h5 class="card-title mb-9 fw-semibold"
                                            style="transform: translateX(38%); color:black">Tổng đơn
                                            hàng</h5>

                                        <h2 class="fw-semibold mb-3" style="color: black">{{ $totalOrders }}</h2>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div
                                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-users fs-6"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Monthly Earnings -->
                        <div class="card">
                            <div class="card-body" style="background-color: rgb(118, 184, 245)">
                                <div class="row align-items-start">
                                    <div class="col-8">
                                        <h5 class="card-title mb-9 fw-semibold">Tổng doanh thu</h5>
                                        <h2 class="fw-semibold mb-3">
                                            @if ($totalRevenue > 1000)
                                                {{ number_format($totalRevenue / 1000, 2) }}K
                                            @elseif ($totalRevenue > 1000000)
                                                {{ number_format($totalRevenue / 1000000, 2) }}M
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div
                                                class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-cash fs-6"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Chart --}}
        <div id="ChartForm" class=" row d-flex justify-content-center align-items-center" style="margin-top:50px ">
            <div class="col-lg-9 chart-container">
                <div style="width: 80%; margin: auto;">
                    <canvas id="revenueChart" style="width: 100%"></canvas>
                    <div class="filter-buttons">
                        <button onclick="updateChart('daily')">Daily</button>
                        <button onclick="updateChart('monthly')">Monthly</button>
                        <button onclick="updateChart('annual')">Annual</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <ul class="stat-list">
                    <li id="daily">
                        @foreach ($totalOrderDataByPeriod['daily'] as $day)
                            @foreach ($totalOrderDataByPeriod['yesterday'] as $yesterday)
                                <h2 class="no-margins">
                                    {{ $day }} Hóa đơn
                                </h2>
                                <small>Tổng hóa đơn trong ngày</small>
                                <div class="stat-percent">
                                    @if ($day > $yesterday)
                                        {{ ($day / $yesterday) * 100 }}%
                                        <i class="fa fa-level-up text-navy"></i>
                                    @else
                                        -{{ ($day / $yesterday) * 100 }}%
                                        <i class="fa fa-level-down text-navy" style="color: red"></i>
                                    @endif
                                </div>
                            @endforeach
                        @endforeach
                    </li>
                    <li id="monthly">
                        @foreach ($totalOrderDataByPeriod['monthly'] as $month)
                            @foreach ($totalOrderDataByPeriod['lastmonth'] as $lastmonth)
                                <h2 class="no-margins">
                                    {{ $month->total_orders }} Hóa đơn
                                </h2>
                                <small>Tổng hóa đơn trong tháng</small>
                                <div class="stat-percent">
                                    @if ($lastmonth == 0)
                                        100%
                                        <i class="fa fa-level-up text-navy"></i>
                                    @elseif ($month->total_orders > $lastmonth)
                                        {{ ($month->total_orders / $lastmonth) * 100 }}%
                                        <i class="fa fa-level-up text-navy"></i>
                                    @else
                                        -{{ ($month->total_orders / $lastmonth) * 100 }}%
                                        <i class="fa fa-level-down text-navy" style="color: red"></i>
                                    @endif
                                </div>
                            @endforeach
                        @endforeach
                    </li>
                    <li id="yearly">
                        @foreach ($totalOrderDataByPeriod['yearly'] as $year)
                            @foreach ($totalOrderDataByPeriod['lastyear'] as $lastyear)
                                <h2 class="no-margins">
                                    {{ $year->total_orders }} Hóa đơn
                                </h2>
                                <small>Tổng hóa đơn trong năm</small>
                                <div class="stat-percent">
                                    @if ($lastyear == 0)
                                        100%
                                        <i class="fa fa-level-up text-navy"></i>
                                    @elseif ($year->total_orders > $lastyear)
                                        {{ ($year->total_orders / $lastyear) * 100 }}%
                                        <i class="fa fa-level-up text-navy"></i>
                                    @else
                                        -{{ ($year->total_orders / $lastyear) * 100 }}%
                                        <i class="fa fa-level-down text-navy" style="color: red"></i>
                                    @endif
                                </div>
                            @endforeach
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
        <h1 style="margin-top: 50px;">Top Sản phẩm bán chạy nhất</h1>
        <div id="Top5Product" class="row d-flex justify-content-center align-items-center">

            <div class="col-lg-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>P.No</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Tồn kho</th>
                            <th>Số lượng bán</th>
                        </tr>
                    </thead>
                    <tbody style="padding-top: 10px;">
                        @foreach ($topProducts as $product)
                            <tr style="text-align: center; vertical-align: middle;">
                                <td><a href="#">{{ $loop->iteration }}</a></td>
                                @php
                                    $primaryImage = $product->images->where('is_primary', true)->first();
                                    $imageUrl = $primaryImage
                                        ? asset('storage/' . $primaryImage->image_url)
                                        : asset('resources/images/default-product.jpg');
                                @endphp
                                <td>
                                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                                        style="object-fit: cover; width: 50px; height: 50px; overflow: hidden; border-radius: 5px;"
                                        class="product-thumbnail">
                                </td>
                                <td><a href="#">{{ $product->name }}</a></td>
                                <td><a href="#">{{ $product->price }}</a></td>
                                <td><a href="#">{{ $product->stock }}</a></td>
                                <td><a href="#">{{ $product->total_quantity }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <h1 style="margin-top: 50px;">Top Khách hàng mua nhiều nhất</h1>
        <div id="Top5Customer" class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>C.No</th>
                            <th>Tên khách hàng</th>
                            <th>Số lượng sản phẩm đã mua</th>
                            <th>Tổng giá trị</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topCustomers as $customer)
                            <tr style="text-align: center; vertical-align: middle;">
                                <td><a href="#">{{ $loop->iteration }}</a></td>
                                <td><a href="#">{{ $customer->name }}</a></td>
                                <td><a href="#">{{ $customer->total_quantity }}</a></td>
                                <td><a href="#">{{ $customer->total_value }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- script generate chart --}}
    <script>
        // Get total order data by period
        let totalOrderDataByPeriod = {
            daily: @json($totalOrderDataByPeriod['daily']),
            monthly: @json($totalOrderDataByPeriod['monthly']),
            yearly: @json($totalOrderDataByPeriod['yearly']),
        };
        // Default data for daily revenue
        let dailyData = {
            labels: @json($weeklyRevenueData['labels']),
            data: @json($weeklyRevenueData['data'])
        };

        // Dữ liệu doanh thu hàng tháng
        let monthlyData = {
            labels: @json($monthlyRevenueData['labels']),
            data: @json($monthlyRevenueData['data'])
        };

        // Dữ liệu doanh thu hàng năm
        let annualData = {
            labels: @json($annualRevenueData['labels']),
            data: @json($annualRevenueData['data'])
        };

        // Create Chart.js instance
        const ctx = document.getElementById('revenueChart').getContext('2d');
        let revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dailyData.labels,
                datasets: [{
                        type: 'bar',
                        label: 'Revenue (Bar)',
                        data: dailyData.data,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        type: 'line',
                        label: 'Revenue (Line)',
                        data: dailyData.data,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        tension: 0.4 // Smooth the line
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false
                        } // Avoid skipping labels
                    },
                    y: {
                        ticks: {
                            beginAtZero: true,
                            callback: (value) => `${value}` // Add $ to y-axis labels
                        }
                    }
                }
            }
        });

        // Function to update the chart
        function updateChart(period) {
            let newData;
            if (period === 'daily') {
                newData = dailyData;
            } else if (period === 'monthly') {
                newData = monthlyData;
            } else if (period === 'annual') {
                newData = annualData;
            }


            // Update bar and line datasets
            revenueChart.data.labels = newData.labels;
            revenueChart.data.datasets[0].data = newData.data; // Bar data
            revenueChart.data.datasets[1].data = newData.data; // Line data
            revenueChart.update();
        }
    </script>
@endsection
