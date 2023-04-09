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
        @include('homepage.layout.sidebar')
        <div class="col-md-9">
            <div class="row">
                @foreach ($products as $product)
                    <x-product :product="$product"/>
                @endforeach
            </div>
            <div class="pagination" style="display: flex; align-items: center; justify-content: center;">
                {{ $products->links() }}
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            const slider2 = document.getElementById('sliderRefine');

            const minPrice = parseInt($('#input-min-price').val())
            const maxPrice = parseInt($('#input-max-price').val())

            noUiSlider.create(slider2, {
                start: [minPrice, maxPrice],
                connect: true,
                range: {
                    'min': [{{ $arrPrice['min_price'] }} - 50000],
                    'max': [{{ $arrPrice['max_price'] }} + 50000]
                },
                step: 1000,
            });

            let val;
            slider2.noUiSlider.on('update', function (values, handle) {
                val = Math.round(values[handle]);
                if (handle) {
                    $('#span-max-price').text(val);
                    $('#input-max-price').val(val);
                } else {
                    $('#span-min-price').text(val);
                    $('#input-min-price').val(val);
                }
            });
        });
    </script>
@endpush