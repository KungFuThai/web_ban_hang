@extends('homepage.layout.master')
@section('content')
    <div class="row">
        <a class="navbar-brand" href="{{ route('customer.index') }}">
            <i class="fa fa-long-arrow-left"></i>
            Tiếp tục mua sắm
        </a>
        <div class="col-md-12">
            <h2>
                <i class="material-icons">shopping_cart</i>
                Giỏ hàng
            </h2>
        </div>
        <div class="col-md-10 col-md-offset-1">
            @if (checkProductInCart())
                <div class="table-responsive">
                    <table class="table table-shopping">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th>Sản phẩm</th>
                                <th class="text-right">Giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-right">Tổng sản phẩm</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach (session('cart') as $productId => $each)
                                <span style="display:none;">{{ $total += $each['price'] * $each['quantity'] }}</span>
                                <tr>
                                    <td>
                                        <div class="img-container">
                                            <img src="{{ asset('storage') . '/' . $each['image'] }}">
                                        </div>
                                    </td>
                                    <td class="td-name">
                                        {{ $each['name'] }}
                                    </td>
                                    <td class="td-number">
                                        <small>₫</small>
                                        <span class="span-price">{{ $each['price'] }}</span>
                                    </td>
                                    <td class="td-actions">
                                        <button class="btn-update-quantity btn btn-info btn-round btn-sm"
                                            data-id='{{ $productId }}' data-type='0'>
                                            <i class="material-icons">remove</i>
                                        </button>
                                        <span class="span-quantity">
                                            {{ $each['quantity'] }}
                                        </span>
                                        <button class="btn-update-quantity btn btn-info btn-round btn-sm"
                                            data-id='{{ $productId }}' data-type='1'>
                                            <i class="material-icons">add</i>
                                        </button>
                                    </td>
                                    <td class="td-number">
                                        <small>₫</small>
                                        <span class="span-sum">
                                            {{ $each['price'] * $each['quantity'] }}
                                        </span>
                                    </td>
                                    <td class="td-actions">
                                        <button type="button" class="btn btn-danger btn-round remove-from-cart"
                                            data-id='{{ $productId }}'>
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="td-total">
                                    Tổng tiền hoá đơn:
                                </td>
                                <td colspan="3" class="td-price">
                                    <small>₫</small>
                                    <span id="span-total">{{ $total }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="col-md-offset-4 col-md-8">
                    <a href="{{ route('customer.index') }}" class="btn btn-danger">
                        Giỏ hàng của bạn trống trơn hà!
                        <br>
                        quay lại lấy vài món đồ để vào rồi vào đây hé!
                    </a>
                </div>
            @endif
        </div>
    </div>
    @if (checkProductInCart())
        <hr class="half-rule">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-2">
                <p class="description">
                    Hãy cung cấp thông tin người nhận số sản phẩm này diều này sẽ giúp chúng tôi có thể dễ dàng liên hệ
                    với
                    bạn khi sản phẩm được giao.
                    <br><br>
                </p>
                <form role="form" id="contact-form" method="post" action="{{ route('customer.cart.checkout') }}">
                    @csrf
                    <div class="form-group label-floating is-empty">
                        <label for="name_receiver">Tên người nhận</label>
                        <input type="text" name="name_receiver" class="form-control" placeholder="Tên người nhận..."
                            value="{{ $customer->full_name ?? '' }}">
                        <span class="material-input"></span>
                    </div>
                    <div class="form-group label-floating is-empty">
                        <label for="address_receiver">Địa chỉ người nhận</label>
                        <input type="text" name="address_receiver" class="form-control"
                            placeholder="Địa chỉ người nhận..." value="{{ $customer->address ?? '' }}">
                        <span class="material-input"></span>
                    </div>
                    <div class="form-group label-floating is-empty">
                        <label for="phone_receiver">Số điện thoại người nhận</label>
                        <input type="text" name="phone_receiver" class="form-control"
                            placeholder="Số điện thoại người nhận..." value="{{ $customer->phone ?? '' }}">
                        <span class="material-input"></span>
                    </div>
                    <div class="submit text-center">
                        <button type="submit" class="btn btn-info btn-round">
                            Đặt hàng
                            <i class="material-icons">keyboard_arrow_right</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
@push('js')
    <script type="text/javascript">
        $(".btn-update-quantity").click(function() {
            let btn = $(this);
            let id = btn.data('id');
            let type = parseInt(btn.data('type'));
            $.ajax({
                    url: '{{ route('customer.cart.update_quantity') }}',
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id,
                        type
                    },
                })
                .done(function() {
                    let parent_tr = btn.parents('tr');
                    let price = parent_tr.find('.span-price').text();
                    let quantity = parent_tr.find('.span-quantity').text();
                    if (type === 1) {
                        quantity++;
                    } else {
                        quantity--;
                    }
                    if (quantity === 0) {
                        parent_tr.remove();
                    } else {
                        parent_tr.find('.span-quantity').text(quantity);
                        let sum = price * quantity;
                        parent_tr.find('.span-sum').text(sum);
                    }
                    getTotal();
                });
        });

        $(".remove-from-cart").click(function(e) {
            let btn = $(this);
            let id = btn.data('id');
            $.ajax({
                    url: '{{ route('customer.cart.remove_from_cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id
                    },
                })
                .done(function() {
                    btn.parents('tr').remove();
                    getTotal();
                });
        });

        function getTotal() {
            let total = 0;
            $(".span-sum").each(function() {
                total += parseFloat($(this).text());
            });
            $("#span-total").text(total);
        }
    </script>
@endpush
