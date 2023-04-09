@extends('layout.master');
@section('content')
    <a href="{{ route('producers.index') }}"
       class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
        <i class="mdi mdi-arrow-left"></i>
        Quay lại
    </a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal text-sm-center" action="{{ route('producers.store') }}" method="post">
                        @csrf
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-1 col-form-label">Nhà cung cấp</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="name" placeholder="Tên nhà cung cấp"
                                       value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-1 col-form-label">Số điện thoại</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="phone"
                                       placeholder="Số điện thoại nhà cung cấp" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-1 col-form-label">Địa chỉ</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="address"
                                       placeholder="Địa chỉ nhà cung cấp" value="{{ old('address') }}">
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
    </div>
@endsection
