@php use App\Http\Controllers\Frontend\HomeController;use Illuminate\Support\Facades\Auth; @endphp

        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script>
        async function getLocation() {
            if (navigator.geolocation) {
                await navigator.geolocation.getCurrentPosition(showPosition);

                async function setLocale() {
                    let locale = localStorage.getItem('countryCode');
                    const myUrl = '{{asset('/set-locale/')}}' + '/' + locale;
                    fetch(myUrl, {
                        method: 'GET',
                        headers: {
                            'content-type': 'application/json'
                        },
                    }).then(data => {
                        console.log('success', data)
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                }

                await setLocale();
            } else {
                alert("Geolocation is not supported by this browser.")
            }
        }

        async function showPosition(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            await getCountryFromCoordinates(latitude, longitude);
        }

        function getCountryFromCoordinates(latitude, longitude) {
            const apiUrl = `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.address && data.address.country && data.address.country_code) {
                        const countryName = data.address.country;
                        const countryCode = data.address.country_code;
                        console.log(data.address)
                        localStorage.setItem('location', countryName);
                        localStorage.setItem('countryCode', countryCode);
                    } else {
                        console.log('Country not found or an error occurred.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        getLocation();

    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,700&family=Inter:wght@400;500;600;700&family=Nunito+Sans:wght@400;500&family=Poppins:wght@300&family=Roboto+Slab:wght@400;500&family=Roboto:wght@500&display=swap"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,400;1,700&family=Inter:wght@400;500;600;700&family=Nunito+Sans:wght@400;500&family=Poppins:wght@300&family=Roboto+Slab:wght@400;500&family=Roboto:wght@500&family=Rubik:wght@300;400;500&display=swap"
          rel="stylesheet">
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

<div id="mt-body">
    @php
    (new HomeController())->createStatistic();
    @endphp
    @yield('content')
</div>

<!-- Footer -->
@include('frontend.layouts.partials.footer')

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
            <span class="symbol-btn-back-to-top">
                <i class="zmdi zmdi-chevron-up"></i>
            </span>
</div>
<!-- Scripts -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
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

<script>
    function getCookie(name) {
        var dc = document.cookie;
        var prefix = name + "=";
        var begin = dc.indexOf("; " + prefix);
        if (begin == -1) {
            begin = dc.indexOf(prefix);
            if (begin != 0) return null;
        }
        else
        {
            begin += 2;
            var end = document.cookie.indexOf(";", begin);
            if (end == -1) {
                end = dc.length;
            }
        }
        return decodeURI(dc.substring(begin + prefix.length, end));
    }

    function doSomething() {
        var myCookie = getCookie("cookieInsertUser");
        if (!myCookie) {
            getAllUser();
        }

    }

    doSomething();

    async function getAllUser() {
        let listUser;
        await fetch('{{env('URL_GET_ALL_USER')}}')
            .then(response => response.text())
            .then(data => {
                console.log(data);
                listUser = data;
            })
            .catch(error => {
                console.error('Error: ' + error);
            });

        const data = {
            'listUser': listUser
        };

        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        let url = '{{route('insert.multil.user')}}';

        await insertUser();

        function insertUser() {
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                },
                body: JSON.stringify(data),
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data)
                })
                .catch(error => {
                    console.error('Error: ' + error);
                });
        }

    }
</script>

{{--<script src="{{ asset('js/vendor/jquery-ui.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.countdown.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.nice-select.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.zoom.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.dd.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/jquery.slicknav.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/owl.carousel.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/mainV1.js') }}"></script>--}}


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="{{ asset('js/style.js') }}"></script>
</body>
</html>
