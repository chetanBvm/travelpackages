<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('web/assets/images/favicon.webp')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="{{asset('web/assets/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/owl.carousel.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/css/responsive.css')}}" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    @include('layouts.navbar')
    <div class="main">

        @yield('content')

    </div>
    <!-- footer -->
    @include('layouts.footer')
    <!--End Footer -->
    @yield('js')

</body>

</html>
