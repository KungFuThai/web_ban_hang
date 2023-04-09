@extends('homepage.layout.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <span class="card card-signup">
            <form class="form" method="post" action="{{ route('customer.process_forget_password') }}">
                @csrf
                <div class="header header-info text-center">
                    <h4 class="card-title">Quên mật khẩu</h4>
                </div>
                <span style="margin:auto; display:table;">Nhập email của bạn</span>
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
                </div>
                <div class="footer text-center">
                    <button class="btn btn-primary btn-simple btn-wd btn-lg">Gửi mail đổi mật khẩu</button>
                </div>
            </form>
            </span>
        </div>
    </div>
@endsection