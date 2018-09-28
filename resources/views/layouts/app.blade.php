<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title_text')</title>

    <!-- Styles -->
    <!--Dynamic StyleSheets added from a view would be pasted here-->
    @yield('styles')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v=2') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <script>
        let baseUrl = '<?php echo url('/'); ?>';
    </script>
</head>
<body>
<div>
    <a href="{{ url('/logout') }}"> logout </a>
    @yield('content')
</div>

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/fabric.min.js') }}"></script>
@stack('scripts')
</body>
</html>
