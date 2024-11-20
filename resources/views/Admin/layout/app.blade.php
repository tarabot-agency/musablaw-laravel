<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Eslam Elbanna">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Admin | @yield('title')</title>
    @yield('css')
    <style>
        #profileImage {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #493628;
            font-size: 20px;
            color: #fff;
            text-align: center;
            line-height: 40px;
            margin: 10px 0;
        }

        .alert {
            margin-top: 50px;
        }

        .contentt {
            min-height: 100vh;
        }

        footer {
            color: white;
            text-align: center;
            padding: 1rem 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body
    class="vertical-layout vertical-menu-modern boxicon-layout no-card-shadow 2-columns  navbar-sticky footer-static  "
    data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    @include('Admin.layout.navbar')
    @include('Admin.layout.sidemenu')
    <div class="contentt">
        @if (Session::has('message'))
            <div class="p-1 text-center container">
                <p class="alert mb-0 {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            </div>
        @endif
        @yield('content')
    </div>
    <audio id="notification-sound" src="{{ asset('message-alert-190042.mp3') }}" preload="auto"> </audio>
    @include('Admin.layout.footer')
    @yield('script')
    @include('Admin.layout.scripts.admin_name_creation')
    @include('Admin.layout.scripts.theme_scripts')
</body>

</html>
