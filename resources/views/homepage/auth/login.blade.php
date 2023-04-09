@extends('homepage.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <span class="card card-signup">
                <form class="form" method="post" action="{{ route('customer.logging_in') }}">
                    @csrf
                    <div class="header header-info text-center">
                        <h4 class="card-title">Đăng nhập</h4>
                    </div>
                    <div class="card-content">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-group is-empty">
                                <input type="text" class="form-control" placeholder="Email..." name="email"
                                       value="{{ old('email') }}">
                                <span class="material-input"></span>
                            </div>
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
                    </div>
                    <a href="{{ route('customer.forget_password') }}" class="col-sm-offset-7 col-sm-5">Quên mật khẩu?</a>
                    <div class="footer text-center">
                        <button class="btn btn-primary btn-info btn-wd btn-lg">Đăng nhập</button>
                    </div>
                    <span class="col-md-offset-1">
                        Chưa có tài khoản?
                        <a href="{{ route('customer.register') }}">Đăng ký</a>
                    </span>
                </form>
            </span>
        </div>
    </div>
@endsection