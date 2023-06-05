@php use Illuminate\Support\Facades\Auth; @endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    {{--    <link rel="stylesheet" href="{{ mix('css/custom.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">--}}

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


    {{--    <!-- Libraries Stylesheet -->--}}
    {{--    <link href="{{ asset('lib/animate/animate.min.css" rel="stylesheet') }}">--}}
    {{--    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">--}}


    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/elegant-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/mainV1.css')}}">

</head>
<div class="d-none">
    @if(Auth::check())
        <div class="">
            <input id="input-check" type="number" value="2">
        </div>
    @else
        <input id="input-check" type="number" value="1">
    @endif
</div>
<body>

<!-- Header -->
@include('frontend.layouts.partials.header', ['infoUser' => $infoUser ?? ''])

<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('login.submit') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-3">
                    <div class="">
                        <div class="form-group">
                            <label for="login_field">Email</label>
                            <input id="login_field" type="text" class="form-control" name="login_field"
                                   placeholder="{{ __('home.input username') }}" value="{{ old('login_field') }}"
                                   required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password"
                                   placeholder="{{ __('home.input password') }}" required>
                        </div>

                        <div class="float-right">
                            <a class="tabs-product-detail" href="{{route('register.show')}}">{{ __('home.sign up') }}</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

@yield('content')

<!-- Footer -->
@include('frontend.layouts.partials.footer')

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
            <span class="symbol-btn-back-to-top">
                <i class="zmdi zmdi-chevron-up"></i>
            </span>
</div>
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>

{{--    <script src="{{ mix('js/app.js') }}" defer></script>--}}


<script>
    $(document).ready(function () {
        if ($('#input-check').val() == '1') {
            $('#body-content').click(function (e) {
                $('#modalLogin').modal('show')
            });
        }
    });
</script>

<script src="{{ asset('js/vendor/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.dd.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/vendor/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/mainV1.js') }}"></script>

</body>
</html>
