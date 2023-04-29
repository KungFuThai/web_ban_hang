<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Log In | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    {{--    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="authentication-bg pb-0" data-layout-config="{&quot;darkMode&quot;:false}">
    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <!-- title-->
                    <h4 class="mt-0">Đăng nhập</h4>
                    <p class="text-muted mb-4">Nhập email và mật khẩu của bạn để đăng nhập</p>

                    <!-- form -->
                    <form action="{{ route('logging_in') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" id="email" required name="email"
                                placeholder="Nhập email của bạn" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" required id="password" name="password"
                                    placeholder="Nhập mật khẩu của bạn" value="{{ old('password') }}">
                                <div class="input-group-append" data-password="false">
                                    <div class="input-group-text">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit">
                                <i class="mdi mdi-login"></i>
                                Đăng Nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">Có làm thì mới có ăn!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> Chăm chỉ là chìa khoá của thành công. <i
                        class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    2022
                    @if (date('Y') != 2022)
                        - {{ date('Y') }}
                    @endif
                    © {{ config('app.name') }}
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script>
        @if (session()->has('error'))
            $.toast({
                heading: 'Error',
                text: '{{ session()->get('error') }}',
                position: 'bottom-right',
                icon: 'error',
                stack: false
            })
        @elseif (session()->has('success'))
            $.toast({
                heading: 'Success',
                text: '{{ session()->get('success') }}',
                position: 'bottom-right',
                icon: 'success',
                stack: false
            })
        @endif
    </script>
</body>

</html>
