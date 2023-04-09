@extends('homepage.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <span class="card card-signup">
            <form class="form" method="post" action="{{ route('customer.registering') }}">
                @csrf
                <div class="header header-info text-center">
                    <h4 class="card-title">Đăng ký</h4>
                </div>
                <div class="card-content">
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                        <div class="form-group is-empty">
                            <input type="text" class="form-control" placeholder="Họ và lót..." name="last_name"
                                   value="{{ old('last_name') }}">
                            <span class="material-input"></span>
                        </div>
                    </div>
                    @if ($errors->has('last_name'))
                        <span class="text-danger text-left">{{ $errors->first('last_name') }}</span>
                    @endif
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                        <div class="form-group is-empty">
                            <input type="text" class="form-control" placeholder="Tên..." name="first_name"
                                   value="{{ old('first_name') }}">
                            <span class="material-input"></span>
                        </div>
                    </div>
                    @if ($errors->has('first_name'))
                        <span class="text-danger text-left">{{ $errors->first('first_name') }}</span>
                    @endif
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">phone</i>
                            </span>
                        <div class="form-group is-empty">
                            <input type="text" class="form-control" placeholder="Số điện thoại..." name="phone"
                                   value="{{ old('phone') }}">
                            <span class="material-input"></span>
                        </div>
                    </div>
                    @if ($errors->has('phone'))
                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                    @endif
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                        <div class="form-group is-empty">
                            <input type="text" class="form-control" placeholder="Email..." name="email"
                                   value="{{ old('email') }}">
                            <span class="material-input"></span></div>
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock_outline</i>
                            </span>
                        <div class="form-group is-empty">
                            <input type="password" placeholder="Mật khẩu..." class="form-control" name="password"
                                   value="{{ old('password') }}">
                            <span class="material-input"></span>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                        <div class="form-group is-empty">
                            <input type="password" placeholder="Nhập lại mật khẩu..." class="form-control"
                                   name="password_confirmation" value="{{ old('password_confirmation') }}">
                            <span class="material-input"></span>
                        </div>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <a href="{{ route('customer.forget_password') }}" class="col-sm-offset-7 col-sm-5">Quên mật khẩu?</a>
                <div class="footer text-center">
                    <button class="btn btn-primary btn-info btn-wd btn-lg">Bắt đầu mua sắm</button>
                </div>
                <span class="col-md-offset-1">
                        Đã có tài khoản?
                        <a href="{{ route('customer.login') }}">
                            Đăng nhập
                        </a>
                    </span>
            </form>
            </span>
        </div>
    </div>
@endsection