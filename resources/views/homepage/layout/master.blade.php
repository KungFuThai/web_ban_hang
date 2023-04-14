<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        @isset($q)
            Tìm kiếm:
        @endisset
        {{ $q ?? $title ?? config('app.name') }}
    </title>

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css')}}" rel="stylesheet">

    <link href="{{ asset('css/jquery.toast.min.css') }}" rel="stylesheet"/>
    @stack('css')
</head>

<body class="ecommerce-page">
@include('homepage.layout.navbar')
@include('homepage.layout.header')

<div class="main">
    <!-- section -->
    <div class="section">
        <div class="container">
            @yield('content')
        </div>
    </div><!-- section -->

</div> <!-- end-main-raised -->

<!-- section -->
@include('homepage.layout.footer')


<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>


<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/   -->
<script src="{{ asset('js/nouislider.min.js') }}" type="text/javascript"></script>

<!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/   -->
<script src="{{ asset('js/bootstrap-tagsinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/material-kit.js') }}" type="text/javascript"></script>
{{--toast js--}}
<script src="{{ asset('js/jquery.toast.min.js') }}" type="text/javascript"></script>


<script type="text/javascript">
    @if (session()->has('error'))
    $.toast({
        heading: 'Error',
        text: '{{ session()->get('error') }}',
        position: 'bottom-right',
        icon: 'error',
        stack: false
    })
    @elseif(session()->has('success'))
    $.toast({
        heading: 'Success',
        text: '{{ session()->get('success') }}',
        position: 'bottom-right',
        icon: 'success',
        stack: false
    })
    @endif
</script>
@stack('js')

</body>
</html>