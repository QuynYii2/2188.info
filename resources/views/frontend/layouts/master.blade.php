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
{{--    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>--}}
{{--    <!-- Fonts -->--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">--}}
{{--    <link rel="dns-prefetch preconnect" href="https://cdn11.bigcommerce.com/s-3uw22zu194" crossorigin><link rel="dns-prefetch preconnect" href="https://fonts.googleapis.com/" crossorigin><link rel="dns-prefetch preconnect" href="https://fonts.gstatic.com/" crossorigin>--}}
{{--    <link rel='canonical' href='https://superkart-demo-02.mybigcommerce.com/' /><meta name='platform' content='bigcommerce.stencil' />--}}
{{--    <link href="https://cdn11.bigcommerce.com/r-0d0e7ebe415bc7b0d922632811abb75311658663/img/bc_favicon.ico" rel="shortcut icon">--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/vendor/font-awesome.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/vendor/themify-icons.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/vendor/elegant-icons.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/vendor/owl.carousel.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/vendor/nice-select.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/vendor/jquery-ui.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/vendor/slicknav.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/mainV1.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/index.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/style_font.css')}}">--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />--}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,700&family=Inter:wght@400;500;600;700&family=Nunito+Sans:wght@400;500&family=Poppins:wght@300&family=Roboto+Slab:wght@400;500&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,400;1,700&family=Inter:wght@400;500;600;700&family=Nunito+Sans:wght@400;500&family=Poppins:wght@300&family=Roboto+Slab:wght@400;500&family=Roboto:wght@500&family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">

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
@include('sweetalert::alert')

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
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>--}}
{{--<script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>--}}

{{--    <script src="{{ mix('js/app.js') }}" defer></script>--}}


<script>
    $(document).ready(function () {
        if ($('#input-check').val() == '1') {
            $('#body-content').click(function (e) {
                signIn();
                signInM();
            });
        }
    });
</script>

{{--<script src="{{ asset('js/vendor/jquery-ui.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.countdown.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.nice-select.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.zoom.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.dd.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.slicknav.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/owl.carousel.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/mainV1.js') }}"></script>--}}


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('js/style.js') }}"></script>
</body>
</html>
