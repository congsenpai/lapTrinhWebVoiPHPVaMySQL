@extends('client.layouts.app')

@section('content')
    <section class="breadcrumb-section set-bg"
        data-setbg="{{ Vite::asset('resources/assets/images/top_banner_shopping_cart.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Lịch sử đơn hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Trang chủ</a>
                            <a href="{{ route('order.check') }}">Lịch sử đơn hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="tabs" class="project-tab">
        <div class="container shadow-sm bg-body rounded">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <br>
                    <div class="tab-content">
                        <div id="order-content" class="tab-pane active show mt-5">
                            @include('client.order.partitials.order_table', ['orders' => $orders])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href');
                $.ajax({
                    url: page,
                    type: 'GET',
                    success: function(response) {
                        $('#order-content').html(response);
                    },
                    error: function() {
                        alert('Không thể tải dữ liệu. Vui lòng thử lại.');
                    }
                });
            });
        </script>
    @endpush
@endsection
