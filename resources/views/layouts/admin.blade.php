<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title_text')</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @stack('css')

    <link href="{{ asset('css/main.css?v=1') }}" rel="stylesheet">
    <script>
        let baseUrl = '<?php echo url('/'); ?>';
    </script>
</head>
<body class="admin cbp-spmenu-push">
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <h3>Menu</h3>
    <a href="{{url("admin/index")}}"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp; Pregled</a>
    <a href="{{url("admin/cycle/index")}}"><i class="fa fa-calendar-times"></i>&nbsp;&nbsp; Ciklusi</a>
    @foreach(Auth::user()->roles as $role)
        @php ($userRole = $role->name)
    @endforeach
    @if($userRole === "Super Admin")
        <a href="{{url("admin/user/index")}}"><i class="fas fa-users"></i>&nbsp;&nbsp; Korsinici</a>
    @endif
    <a href="{{url("admin/gallery/index")}}"><i class="far fa-image"></i>&nbsp;&nbsp; Galerija</a>
</nav>
<div class="admin-wrap">
    @include('admin.header')
    @yield('content')
</div>

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('js/classie.js') }}"></script>

<script>
    $(document).ready(function () {
        let menuLeft = document.getElementById('cbp-spmenu-s1');
        let showLeftPush = document.getElementById('showLeftPush');
        let body = document.body;

        $(function () {
            classie.toggle(showLeftPush, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
        });

        showLeftPush.onclick = function () {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            $(".admin-wrap").toggleClass("admin-wrap-toggle");

        };
    });


</script>
@stack('scripts')
</body>
</html>
