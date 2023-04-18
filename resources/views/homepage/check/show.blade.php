@extends('homepage.layout.master')
@section('content')
    <div class="row">
        <a class="navbar-brand" href="{{ url()->previous() }}">
            <i class="fa fa-long-arrow-left"></i>
            Quay lại
        </a>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center title">Hoá đơn của tôi</h2>
            <h4 class="text-right title">
                Tình trạng đơn: &nbsp;
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
            </h4>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Tổng sản phẩm</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetail as $each)
                        <tr>
                            <td>
                                <div class="img-container">
                                    <img width="50" src="{{ asset('storage') . '/' . $each->product->image }}">
                                    {{ $each->product->name }}
                                </div>
                            </td>
                            <td>
                                <small>₫</small>
                                {{ $each->unit_price }}
                            </td>
                            <td class="text-center">
                                {{ $each->quantity }}
                            </td>
                            <td class="text-center">
                                <small>₫</small>
                                {{ $each->quantity * $each->unit_price }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        @if($order->status === 1)
                            <td>
                                <form method="post" action="{{ route("customer.profile.cancel_order", $order->id) }}"
                                      class="mb-0">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="3">
                                    <button class="btn btn-danger">
                                        Huỷ
                                    </button>
                                </form>
                            </td>
                        @endif
                        <td class="td-total">
                            Tổng tiền hoá đơn:
                        </td>
                        <td colspan="3" class="td-price">
                            <small>₫</small>
                            <span id="span-total">{{ $order->total_price }}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection