@extends('layout.master');
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ $title }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <form class="form-horizontal text-sm-center" action="{{ route('categories.update', $each) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-3 col-form-label">Tên loại</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="name" placeholder="Tên loại sản phẩm" value="{{ $each->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-3 col-form-label">Nhà cung cấp</label>
                        <div class="col-7">
                            <select class="form-control" name="producer_id" >
                                @foreach($producers as $producer)
                                    <option value="{{ $producer->id }}"
                                        @if ($each->producer_id === $producer->id) {
                                            selected
                                        @endif
                                        >
                                        {{ $producer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('producer_id'))
                                <span class="text-danger text-left">{{ $errors->first('producer_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-center row">
                        <div class="col-9">
                            <button class="btn btn-info">Thêm loại sản phẩm</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
