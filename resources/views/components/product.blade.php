<div class="col-md-4">
    <div class="card card-product card-plain no-shadow" data-colored-shadow="false">
        <div class="card-image" style = "width: 262px !important; height: 274px !important;">
            <a href="{{ route('customer.show', $product->slug) }}">
                <img src="{{ asset('storage') . '/' . $product->image }}" style = "width: 262px !important; height: 274px !important; display: flex; align-items: center; justify-content: center;">
            </a>
        </div>
        <div class="card-content">
            <a href="{{ route('customer.show', $product->slug) }}">
                <h4 class="card-title">{{ $product->name }}</h4>
            </a>
            <div class="footer">
                <div class="price-container">
                    <span class="price">₫{{ $product->price }}</span>
                </div>
            </div>
        </div>
    </div> <!-- end card -->
</div>
