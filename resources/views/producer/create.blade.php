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
                <form class="form-horizontal text-sm-center" action="{{ route('producers.store') }}" method="post">
                    @csrf
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-3 col-form-label">Nhà cung cấp</label>
                        <input type="text" class="form-control" name="name" placeholder="Tên nhà cung cấp" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-3 col-form-label">Số điện thoại</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="phone" placeholder="Số điện thoại nhà cung cấp" value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-3 col-form-label">Địa chỉ</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="address" placeholder="Địa chỉ nhà cung cấp" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-center row">
                        <div class="col-9">
                            <button class="btn btn-info">Thêm nhà cung cấp</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
