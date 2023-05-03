@extends('layout.master');
@section('content')
    <a href="{{ route('orders.index') }}" class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
        <i class="mdi mdi-arrow-left"></i>
        Quay lại
    </a>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Đơn hàng {{ $order->id }}</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->order_details as $each)
                                    <tr>
                                        <td>
                                            <div class="img-container">
                                                <img width="50"
                                                    src="{{ asset('storage') . '/' . $each->product->image }}">
                                                {{ $each->product->name }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{ $each->quantity }}
                                        </td>
                                        <td class="text-center">
                                            <small>₫</small>
                                            {{ $each->unit_price }}
                                        </td>
                                        <td class="text-center">
                                            <small>₫</small>
                                            {{ $each->quantity * $each->unit_price }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <span class="font-weight-bold mr-2">
                                            Tổng tiền hoá đơn:
                                        </span>
                                        <small>₫</small>
                                        <span>{{ $order->total_price }}</span>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span class="font-weight-bold mr-2">Thời gian đặt:</span>
                                        {{ $order->time_created_at }}
                                    </td>
                                    <td>
                                        <span class="font-weight-bold mr-2">Trạng thái:</span>
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
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Thông tin người nhận</h4>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <p class="mb-2">
                                <span class="font-weight-bold mr-2">
                                    Tên:
                                </span>
                                {{ $order->name_receiver }}
                            </p>
                            <p class="mb-2">
                                <span class="font-weight-bold mr-2">
                                    Số điện thoại:
                                </span>
                                <a href="tel:{{ $order->phone_receiver }}">
                                    {{ $order->phone_receiver }}
                                </a>
                            </p>
                            <p class="mb-2">
                                <span class="font-weight-bold mr-2">
                                    Địa chỉ:
                                </span>
                                {{ $order->address_receiver }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Thông tin người đặt</h4>

                    <h5>{{ $order->customer->full_name }}</h5>

                    <address class="mb-0 font-14 address-lg">
                        <p class="mb-2">
                            <span class="font-weight-bold mr-2">
                                Email:
                            </span>
                            <a href="tel:{{ $order->customer->email }}">
                                {{ $order->customer->email }}
                            </a>
                        </p>
                        <p class="mb-2">
                            <span class="font-weight-bold mr-2">
                                Số điện thoại:
                            </span>
                            <a href="tel:{{ $order->customer->phone }}">
                                {{ $order->customer->phone }}
                            </a>
                        </p>
                        <p class="mb-2">
                            <span class="font-weight-bold mr-2">
                                Địa chỉ:
                            </span>
                            {{ $order->customer->address }}
                        </p>
                    </address>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-inline justify-content-center">
                        @if ($order->status === 1 || $order->status === 3)
                            <form method="post" action="{{ route('orders.update', $order) }}" class="mb-0">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="2">
                                <button class="btn-delete btn btn-success">
                                    Duyệt
                                </button>
                            </form>
                        @endif
                        &nbsp;
                        @if ($order->status === 1 || $order->status === 2)
                            <form method="post" action="{{ route('orders.update', $order) }}" class="mb-0">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="3">
                                <button class="btn-delete btn btn-danger">
                                    Huỷ
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
