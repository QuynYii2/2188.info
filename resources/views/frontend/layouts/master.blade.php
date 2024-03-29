@php use Illuminate\Support\Facades\Auth;
 $currentRouteName = \Illuminate\Support\Facades\Route::getCurrentRoute()->getName();
 $arrNameNeedHid = ['stand.register.member.index','home.login','show.register.member.ship','show.register.member.logistic.congratulation','register.show','show.register.member','show.register.member.info','show.register.member.person.source', 'partner.register.member.index', 'parent.register.member.locale', 'chat.message.received', 'chat.message.sent', 'chat.message.show','staff.member.info'];
 $isRoute = in_array($currentRouteName, $arrNameNeedHid);
 $isLogisticAndTrust = null;
 $isAdmin = (new \App\Http\Controllers\Frontend\HomeController())->checkAdmin();
 if (!$isAdmin){
      if (Auth::check()){
         $current_user = Auth::user();
         $current_company_person = \App\Models\MemberRegisterPersonSource::where('email', $current_user->email)->first();
         if (!$current_company_person){
                $user_parent = \App\Models\StaffUsers::where('user_id', Auth::id())->first();
                $user = \App\Models\User::find($user_parent->parent_user_id);
                $current_company_person = \App\Models\MemberRegisterPersonSource::where('email', $user->email)->first();
         }
         $current_company = \App\Models\MemberRegisterInfo::find($current_company_person->member_id);
         $member_logistic = \App\Models\Member::where('name', \App\Enums\RegisterMember::LOGISTIC)->first();
         $member_trust = \App\Models\Member::where('name', \App\Enums\RegisterMember::TRUST)->first();
         if ($current_company->member_id == $member_logistic->id || $current_company->member_id == $member_trust->id){
             $isLogisticAndTrust = true;
         }
     }
 } else {
     $isLogisticAndTrust = true;
 }
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

        function checkLocalhost() {
            let mainHost = location.hostname;
            if (mainHost === 'localhost' || mainHost === '127.0.0.1') {
                return;
            }
            return redirectPage();
        }

        function redirectPage() {
            window.location.href = 'https://www.wid21.com/kr/';
        }

        @if($isLogisticAndTrust)
        // checkLocalhost();
        @endif
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Shopping Mall">
    <meta name="keywords" content="Shopping Mall, B2B website, E-Commerce">
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&family=Roboto:wght@100&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
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
<style>
    .page-login {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        padding: 20px;
    }

    @media (max-width: 768px) {
        .page-login {
            width: 80%;
            margin: 0 auto;
        }
    }

    .login-title {
        font-size: 24px;
        font-weight: 600;
    }

    .login-element {
        font-size: 12px;
        font-weight: 400;
    }

    .text-password-forget {
        font-size: 16px;
        font-weight: 600;
    }

    #btnLogin {
        width: 240px;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
    }

    .btn-outline-main {
        padding: 12px 18px !important;;
        border: 1px solid #F47621 !important;
        margin: 8px;
    }

    .btn-outline-main:hover {
        background-color: #F47621;
        color: #fff;
    }

    .input_btn {
        background-color: #fff !important;
    }
</style>
<!-- Header -->
@include('frontend.layouts.partials.header', ['infoUser' => $infoUser ?? '', 'isRoute' => $isRoute ])
@include('sweetalert::alert')

<div class="{{ $isRoute ? '' : 'marginTop-body' }} body" id="mt-body {{ $isRoute ? ' booth' : '' }} ">
    <div>
        @yield('content')
    </div>

    <!-- Footer -->
    @include('frontend.layouts.partials.footer', ['isRoute' => $isRoute])
    {{----}}
    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
    </div>
</div>
</body>
<script src="{{ asset('js/frontend.js') }}"></script>
<script>
    /* thành xóa d-none */
    function hidden() {
        const arrayHidden = ['header-bottom'];
        for (let i = 0; i < arrayHidden.length; i++) {
            $('.' + arrayHidden[i]).addClass('');
        }
    }

    hidden();

    async function getLanguage() {
        let mainHost = location.hostname;

        let lang = 'vi';
        let url = `{{route('app.change.locale')}}`;

        if (sessionStorage.getItem('languageRedirected') === 'true' || mainHost === 'localhost' || mainHost === '127.0.0.1') {
            return;
        }

        sessionStorage.setItem('languageRedirected', 'true');

        if (mainHost === '2188.info') {
            await changeUrl(url, lang);
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

    getLanguage();

</script>
</html>
