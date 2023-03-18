@extends('layout.master');
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal text-sm-center" action="{{ route('admins.store') }}" method="post">
                        @csrf
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-1 col-form-label">Họ và lót</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="last_name" placeholder="Họ và lót" required
                                       value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger text-left">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-1 col-form-label">Tên</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="first_name" placeholder="Tên" required
                                       value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger text-left">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-1 col-form-label">Giới tính</label>
                            <div class="col-7 form-inline">
                                <input type="radio" class="form-control" name="gender" value="0" checked>&nbsp; Nam &nbsp;
                                <input type="radio" class="form-control" name="gender" value="1">&nbsp; Nữ
                                @if ($errors->has('gender'))
                                    <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-1 col-form-label">Số điện thoại</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" required
                                       value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-1 col-form-label">Địa chỉ</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="address" placeholder="Địa chỉ" required
                                       value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-1 col-form-label">Email</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="email" placeholder="Email" required
                                       value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group mb-0 justify-content-center row">
                            <div class="col-9">
                                <button class="btn btn-info">Thêm quản lý mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection