<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Link to Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}">
    <link rel="stylesheet" href="{{asset('css/style_backend.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
<!-- Header -->
<header style="position: fixed; top: 0; left: 0; right: 0; height: 55px; z-index: 1;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <!-- Add navigation links here -->
    </nav>
</header>

<!-- Main Content -->
<div class="container-fluid bg-white">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-sm-3 col-12 col-md-3 col-lg-2" style="padding: 0">
            @include('backend.layouts.partials.side-bar')
        </div>

        <!-- Page Content -->
        <div class="col-sm-9 col-12 col-md-9 col-lg-10" style="padding: 0">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</div>

{{--<!-- Footer -->--}}
{{--<footer>--}}
{{--    <div class="container">--}}
{{--        <p class="text-center">Footer content goes here</p>--}}
{{--    </div>--}}
{{--</footer>--}}

<!-- Link to Bootstrap JS and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.0/dist/jquery.min.js"></script>
</body>
</html>
