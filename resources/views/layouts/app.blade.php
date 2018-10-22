<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="ICT galerija"/>
    <meta property="og:description" content="Podeli svoj omiljeni studentski trenutak"/>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title_text')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css?v=2') }}" rel="stylesheet">
    <script>
        let baseUrl = '<?php echo url('/'); ?>';
    </script>
</head>
<body>
<div id="app">
    @include('header')
    @yield('content')
</div>

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/fabric.min.js') }}"></script>
@stack('scripts')
</body>
</html>
