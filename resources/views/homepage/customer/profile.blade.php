@extends('homepage.layout.master')
@section('content')
    <a class="navbar-brand" href="{{ route('customer.index') }}">
        <i class="fa fa-long-arrow-left"></i>
        Tiếp tục mua sắm
    </a>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center title">Hồ sơ của tôi</h2>
            <form action="{{ route('customer.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating is-empty">
                            <input type="text" class="form-control" name="last_name" placeholder="Họ và lót..."
                                   value="{{ $customer->last_name }}">
                            <span class="material-input"></span>
                            @if ($errors->has('last_name'))
                                <span class="text-danger text-left">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group label-floating is-empty">
                            <input type="text" class="form-control" name="first_name" placeholder="Tên..."
                                   value="{{ $customer->first_name }}">
                            <span class="material-input"></span>
                            @if ($errors->has('first_name'))
                                <span class="text-danger text-left">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="form-inline">
                            <label for="birth_date">Giới tính: </label>&nbsp;
                            <input type="radio" name="gender"
                                   value="0" {{ ($customer->gender === 0) ? "checked" : "" }}> Nam &nbsp;
                            <input type="radio" name="gender"
                                   value="1" {{ ($customer->gender === 1) ? "checked" : "" }}> Nữ
                        </div>
                        @if ($errors->has('gender'))
                            <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
                        @endif
                        <div class="form-group label-floating is-empty">
                            <label for="birth_date">Ngày sinh</label>
                            <input type="date" class="form-control" name="birth_date"
                                   value="{{ $customer->birth_date }}">
                            <span class="material-input"></span>
                            @if ($errors->has('birth_date'))
                                <span class="text-danger text-left">{{ $errors->first('birth_date') }}</span>
                            @endif
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ $customer->address }}">
                            <span class="material-input"></span>
                            @if ($errors->has('address'))
                                <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label>Email</label>
                            <span class="form-control">{{ $email }}</span>
                            <span class="material-input"></span>
                        </div>
                        <div class="form-group label-floating is-empty">
                            <label for="address">Số điện thoại</label>
                            <span class="form-control">{{ $phone }}</span>
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4 col-md-offset-8">
                            <h4>
                                <small>Avatar cũ</small>
                            </h4>
                            <div class="fileinput fileinput-new text-center">
                                @if(session('customer.avatar') === null)
                                    <img src="{{ asset('images/default-avatar.png') }}"
                                         class="fileinput-new thumbnail img-circle img-raised">
                                @else
                                    <img src="{{ asset('storage') . '/' . session('customer.avatar') }}"
                                         class="fileinput-new thumbnail img-circle img-raised">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-8">
                            <h4>
                                <small>Avatar mới</small>
                            </h4>
                            <div class="fileinput fileinput-new text-center">
                                <input type="file" class="form-control col-10" name="avatar"
                                       onchange="pic.src=window.URL.createObjectURL(this.files[0])">
                                <img class="fileinput-new thumbnail img-circle img-raised" id="pic"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 text-center">
                        <button class="btn btn-primary btn-raised">
                            Cập nhật
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection