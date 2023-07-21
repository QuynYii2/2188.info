<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
@include('sweetalert::alert')
<!-- Main Content -->
<div class="container-fluid bg-white card-header">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-sm-1 " style="padding: 0; background-color: #1d2327">
            @include('backend-v2.layouts.partials.side-bar')
        </div>

        <!-- Page Content -->
        <div class="col-sm-11" style="padding: 0">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
</html>