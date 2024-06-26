<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title  ?? ''}}@if(!empty($title)) | @endif{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    @stack('css')
</head>

<body class="overflow-hidden"
      data-layout-config="{&quot;leftSideBarTheme&quot;:&quot;dark&quot;,&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false}"
      data-leftbar-theme="dark">
<div class="wrapper mm-active overflow-auto">
    @include('layout.sidebar')
    <div class="content-page">
        <div class="content">
            @include('layout.header')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">{{ $title ?? '' }}</h4>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
        @include('layout.footer')
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
