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