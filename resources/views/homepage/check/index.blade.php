@extends('homepage.layout.master')
@push('css')
    <style>
        .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
            background-color: #00bcd4 !important;
            border-color: #00bcd4 !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <a class="navbar-brand" href="{{ route('customer.index') }}">
            <i class="fa fa-long-arrow-left"></i>
            Tiếp tục mua sắm
        </a>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center title">Hoá đơn của tôi</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Thông tin người nhận</th>
                        <th>Trạng thái</th>
                        <th>Thời gian đặt</th>
                        <th>Tổng Tiền</th>
                    </tr>
                    </thead>
                    @foreach($orders as $order)
                        <tbody>
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $order->name_receiver }}
                                <br>
                                {{ $order->phone_receiver }}
                                <br>
                                {{ $order->address_receiver }}
                            </td>
                            <td>
                                @switch($order->status)
                                    @case(1)
                                    Chờ duyệt
                                    @break

                                    @case(2)
                                    Đã duyệt
                                    @break

                                    @case(3)
                                    Đã huỷ
                                    @break
                                @endswitch
                            </td>
                            <td>
                                {{ $order->time_created_at }}
                            </td>
                            <td>
                                <small>₫</small>
                                {{ $order->total_price }}
                            </td>
                            <td>
                                <a href="{{ route('customer.profile.check_detail', $order->id) }}">
                                    Chi tiết...
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
                <div class="pagination" style="display: flex; align-items: center; justify-content: center;">
                    {{ $orders->links() }}
                </div>
            </div>
{{--        <div class="col-xs-12">--}}
{{--            <div class="invoice-wrapper">--}}
{{--                <div class="invoice-top">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <div style="float: left">--}}
{{--                                <h2>haha</h2>--}}
{{--                                <h6>haha</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <div style="float: right">--}}
{{--                                <h2>{{ config('app.name') }}</h2>--}}
{{--                                <h6>DNC</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="invoice-bottom">--}}
{{--                    <div class="row">--}}
{{--                        <div class="clearfix"></div>--}}

{{--                        <div class="col-md-offset-2 col-md-8 col-sm-9">--}}
{{--                            <div class="invoice-bottom-right">--}}
{{--                                <table class="table">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Sản phẩm</th>--}}
{{--                                        <th>Giá</th>--}}
{{--                                        <th>Số lượng</th>--}}
{{--                                        <th>Tổng sản phẩm</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>1</td>--}}
{{--                                        <td>Initial research</td>--}}
{{--                                        <td>₹10,000</td>--}}
{{--                                        <td>₹10,000</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr style="height: 40px;"></tr>--}}
{{--                                    </tbody>--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th></th>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Total</th>--}}
{{--                                        <th>₹95,000</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="clearfix"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
    </div>
@endsection