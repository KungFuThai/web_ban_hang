@extends('homepage.layout.master')
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
                        <th>Tổng Tiền</th>
                    </tr>
                    </thead>
                    @php
                        $id = 1;
                    @endphp
                    @foreach($orders as $order)
                        <tbody>
                        <tr>
                            <td>
                                @if($loop)
                                    {{ $id++ }}
                                @endif
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
            </div>
        </div>
    </div>
@endsection