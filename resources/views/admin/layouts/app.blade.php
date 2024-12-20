<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')- @yield('filename', 'default') </title>
    @yield('stylesfirst')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.svg') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/choices.js/choices.min.css')}}" />
    <!-- toastify -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/toastify/toastify.css')}}">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            @include ('admin.layouts.sidebar')
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>

                </a>
                @include('admin.layouts.navbar')
            </header>
            @yield('content')
            <!-- footer -->
            @include('admin.layouts.footer')
            <!--End Footer -->
        </div>
    </div>
    <script src="{{ asset('admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/extensions/sweetalert2.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{asset('admin/assets/vendors/choices.js/choices.min.js')}}"></script>
    @yield('js')
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
</body>

</html>
