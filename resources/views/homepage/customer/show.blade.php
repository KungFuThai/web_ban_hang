@extends('homepage.layout.master')
@section('content')
    <div class="row">
        <h2>
            <a class="navbar-brand" href="{{ route('customer.index') }}">
                <i class="fa fa-long-arrow-left"></i>
                Tiếp tục mua sắm
            </a>
        </h2>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="tab-content">
                <div class="tab-pane active" id="product-page2">
                    <img src="{{ asset('storage') . '/' . $product->image }}" width="300px" height="450px">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <h2 class="title"> {{ $product->name }} </h2>
            <h3 class="main-price">₫{{ $product->price }}</h3>
            <div id="acordeon">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-border panel-default active">
                        <h4 class="panel-title">
                            Mô tả sản phẩm
                        </h4>
                        <hr>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div><!--  end acordeon -->
            <div class="row text-right">
                <a class="btn btn-info btn-round" href="{{ route('customer.card.add_to_cart', $product) }}">
                    Thêm vào giỏ hàng <i class="material-icons">shopping_cart</i>
                </a>
            </div>
        </div>
    </div>

    <div class="features text-center">
        <div class="row">
            <div class="col-md-6">
                <div class="info">
                    <div class="icon icon-info">
                        <i class="material-icons">local_shipping</i>
                    </div>
                    <h4 class="info-title">Siêu cấp vận chuyển</h4>
                    <p>1 giờ trong khu vực và tối đa 2 ngày ngoài khu vực.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info">
                    <div class="icon icon-success">
                        <i class="material-icons">verified_user</i>
                    </div>
                    <h4 class="info-title">Chính sách đổi trả</h4>
                    <p>Hoàn tiền 100% nếu sản phẩm hư hỏng hoặc lỗi tới từ nhà sản xuất.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="related-products">
        <h3 class="title text-center">Bạn cũng có thể quan tâm:</h3>

        <div class="row">
            @foreach($relateProducts as $relateProduct)
                <div class="col-sm-6 col-md-3">
                    <div class="card card-product card-plain no-shadow" data-colored-shadow="false">
                        <div class="card-image" style="width: 262px !important; height: 274px !important;">
                            <a href="{{ route('customer.show', $relateProduct->slug) }}">
                                <img src="{{ asset('storage') . '/' . $relateProduct->image }}"
                                     style="width: 262px !important; height: 274px !important;">
                            </a>
                            <div class="ripple-container"></div>
                        </div>
                        <div class="card-content">
                            <a href="{{ route('customer.show', $relateProduct->slug) }}">
                                <h4 class="card-title">{{ $relateProduct->name }}</h4>
                            </a>
                            <div class="footer">
                                <div class="price-container">
                                    <span class="price">₫{{ $relateProduct->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection