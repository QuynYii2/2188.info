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
<div class="">
    <!-- Header -->
    <div class="header_back ">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <!-- Add navigation links here -->
        </nav>
    </div>
    <!-- Main Content -->
    <div class="">
        <div class="d-flex">
            <!-- Sidebar -->
            <div class="flex-grow-2" style="flex-grow: 2">
                @include('backend.layouts.partials.side-bar')
            </div>

            <!-- Page Content -->
            <div
                    style="flex-grow: 8">
                <div class="content">
                    @yield('content')
                </div>
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
