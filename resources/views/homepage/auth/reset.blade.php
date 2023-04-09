@extends('homepage.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <span class="card card-signup">
            <form class="form" method="post" action="{{ route('customer.process_reset_password', $token) }}">
                @csrf
                <div class="header header-info text-center">
                    <h4 class="card-title">Quên mật khẩu</h4>
                </div>
                <span style="margin:auto; display:table;">Nhập mật khẩu mới</span>
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="card-content">
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock_outline</i>
                            </span>
                            <div class="form-group is-empty">
                                <input type="password" placeholder="Mật khẩu mới..." class="form-control" name="password"
                                       value="{{ old('password') }}">
                                <span class="material-input"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock_outline</i>
                            </span>
                            <div class="form-group is-empty">
                                <input type="password" placeholder="Nhập lại mật khẩu mới..." class="form-control" name="password_confirmation"
                                       value="{{ old('password_confirmation') }}">
                                <span class="material-input"></span>
                            </div>
                        </div>
                        @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="footer text-center">
                    <button class="btn btn-primary btn-simple btn-wd btn-lg">Đổi mật khẩu</button>
                </div>
            </form>
            </span>
        </div>
    </div>
@endsection