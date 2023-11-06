@php use App\Http\Controllers\Frontend\HomeController;use Illuminate\Support\Facades\Auth;
 $currentRouteName = Route::getCurrentRoute()->getName();
 $arrNameNeedHid = ['stand.register.member.index', 'partner.register.member.index', 'parent.register.member.locale', 'chat.message.received', 'chat.message.sent', 'chat.message.show','staff.member.info'];
$isRoute = in_array($currentRouteName, $arrNameNeedHid);
@endphp
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script>
        async function getLocation() {
            if (navigator.geolocation) {
                await navigator.geolocation.getCurrentPosition(showPosition);
                let locale = localStorage.getItem('countryCode');
                let country = localStorage.getItem('location');
                document.cookie = "countryCode=" + locale;
                document.cookie = "country=" + country;
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

                        localStorage.setItem('location', countryName);
                        localStorage.setItem('countryCode', countryCode);
                    } else {

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.20.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
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
{{--@include('frontend.layouts.partials.header', ['infoUser' => $infoUser ?? '', 'isRoute' => $isRoute ])--}}
@include('sweetalert::alert')

{{--<div class="{{ $isRoute ? ' mt-5' : 'marginTop-body' }}" id="mt-body {{ $isRoute ? ' booth' : '' }} ">--}}
<div>
    @yield('content')
</div>

<!-- Footer -->
{{--@include('frontend.layouts.partials.footer', ['isRoute' => $isRoute])--}}
{{----}}
<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>
</body>
<script src="{{ asset('js/frontend.js') }}"></script>
<script>
    function hidden() {
        const arrayHidden = ['header-bottom'];
        for (let i = 0; i < arrayHidden.length; i++) {
            $('.header-bottom').addClass('d-none');
        }
    }

    hidden();

    async function getLanguage() {
        const userLocale = navigator.languages && navigator.languages.length ? navigator.languages[0] : navigator.language;
        // const userLocale = navigator.language || navigator.userLanguage;
        return userLocale;
    }

    async function redirectByLanguage() {
        let locale = await getLanguage();

        switch (locale) {
            case 'vi':
                locale = 'vi';
                break;
            case 'ko':
                locale = 'kr';
                break;
            case 'zh-CN':
                locale = 'cn';
                break;
            case 'ja':
                locale = 'jp';
                break;
            default:
                locale = 'en';
                break;
        }

        checkDomain(locale);
    }

    function checkDomain(locale) {
        let mainHost = location.hostname;

        if (locale != 'en') {
            if (!mainHost.includes(locale)) {
                redirectUrl(locale);
            }
        }
    }

    redirectByLanguage();

    async function changeLanguageProject() {
        let lang = localStorage.getItem('language');
        let locale = await getLanguage();
        if (!lang || lang != locale) {
            lang = locale;
            localStorage.setItem('language', locale);
        }
        //app.change.locale
        console.log(lang);

        switch (lang) {
            case 'vi':
                lang = 'vi';
                break;
            case 'ko':
                lang = 'kr';
                break;
            case 'zh-CN':
                lang = 'cn';
                break;
            case 'ja':
                lang = 'jp';
                break;
            default:
                lang = 'en';
                break;
        }

        console.log(lang)

        let url = `{{route('app.change.locale')}}`;

        await changeUrl(url, lang);
        // await redirectUrl(lang);
    }

    async function redirectUrl(locale) {
        if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {

        } else {
            checkLocale(locale);
        }
    }

    function checkLocale(locale) {
        switch (locale) {
            case 'vi':
                locale = 'vi';
                window.location.href = 'https://vn.2188.info/';
                break;
            case 'ko':
                locale = 'kr';
                window.location.href = 'https://kr.2188.info/';
                break;
            case 'zh-CN':
                locale = 'cn';
                window.location.href = 'https://cn.2188.info/';
                break;
            case 'ja':
                locale = 'jp';
                window.location.href = 'https://jp.2188.info/';
                break;
            default:
                locale = 'en';
                window.location.href = 'https://2188.info/';
                break;
        }
    }

    async function changeUrl(url, lang) {
        await $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: `{{csrf_token()}}`,
                locale: lang
            },
        })
            .done(function (response) {
                let item = `{{app()->getLocale()}}`;
                console.log(item)
            })
            .fail(function (_, textStatus) {
                console.log(textStatus)
            });
    }

    // changeLanguageProject();
</script>
</html>
