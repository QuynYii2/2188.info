<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row" style="background-color: #ff999a">
        <div class="col-md-12">
            <div id="success-register" data-success="{{ session('success') }}">{{ session('success') }}</div>

            <div class="locale">
                @if(session('locale') == 'vi' || session('locale') == null)
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'kr']) }}"><img
                                src="{{ asset('images/korea.png') }}" alt=""></a>
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'jp']) }}"><img
                                src="{{ asset('images/japan.webp') }}" alt=""></a>
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'cn']) }}"><img
                                src="{{ asset('images/china.webp') }}" alt=""></a>
                @endif
                @if(session('locale') == 'kr')
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'vi']) }}"><img
                                src="{{ asset('images/vietnam.webp') }}" alt=""></a>
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'jp']) }}"><img
                                src="{{ asset('images/japan.webp') }}" alt=""></a>
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'cn']) }}"><img
                                src="{{ asset('images/china.webp') }}" alt=""></a>
                @endif
                @if(session('locale') == 'jp')
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'vi']) }}"><img
                                src="{{ asset('images/vietnam.webp') }}" alt=""></a>
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'kr']) }}"><img
                                src="{{ asset('images/korea.png') }}" alt=""></a>
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'cn']) }}"><img
                                src="{{ asset('images/china.webp') }}" alt=""></a>
                @endif
                @if(session('locale') == 'cn')
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'vi']) }}"><img
                                src="{{ asset('images/vietnam.webp') }}" alt=""></a>
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'kr']) }}"><img
                                src="{{ asset('images/korea.png') }}" alt=""></a>
                    <a class="text-body mr-3" href="{{ route('language', ['locale' => 'jp']) }}"><img
                                src="{{ asset('images/japan.webp') }}" alt=""></a>
                @endif

            </div>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-3 pl-5" id="nav-left" style="background-color: #ffcccc">
            <div class="row">
                <a href="/" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Shopping</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Mall</span>
                </a>
            </div>
        </div>
        <div class="col-9 py-2 pr-5" id="nav-right" style="background-color: #feff99;">
            <div class="row align-items-center ">
                <div class="col-1"></div>
                <div class="col-5">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="{{ __('home.placeholder search') }}">
                            <div class="input-group-append bg-white">
                            <span type="button" class="input-group-text bg-transparent text-primary ">
                                {{ __('home.search') }}
                            </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-1"></div>

                <div class="col-5 pr-5">
                    <div class="row align-items-center -align-right">
                        <div class="col-1"></div>
                        @if (session('error'))
                            {{ session('error') }}
                        @endif

                        @if (session('login'))
                            <div class="col-6">

                                <div class="row" style="display: flex; align-items: center;">
                                    <div class="col-4">
                                        <a href="#!">
                                            <img class="avatar"
                                                 src="https://www.gravatar.com/avatar/4f7f74d163a190dee16e31dffc8da4e5?d=mm&amp;s=64"
                                                 alt=""/>
                                        </a>
                                    </div>
                                    <div class="col-8">
                                        <div class="dropdown d-flex align-items-center">
                                            <h4 data-toggle="dropdown" aria-expanded="false">
                                                @if($infoUser)
                                                    {{ $infoUser->name }}
                                                @endif
                                            </h4>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit">Đăng xuất</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        @else
                            <div class="col-3">

                                <div class="btn-group mb-2 full-width">
                                    <a href="/login" class="full-width">
                                        <button type="button" class="btn btn-warning mr-2 full-width"
                                                aria-expanded="false">{{ __('home.sign in') }}</button>
                                    </a>
                                </div>
                                <div class="btn-group full-width">
                                    <a href="" class="full-width">
                                        <button type="button" class="btn btn-danger mr-2 full-width"
                                                aria-expanded="false">
                                            button 1
                                        </button>
                                    </a>
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="btn-group mb-2 full-width">
                                    <a href="/register" class="full-width">
                                        <button type="button" class="btn btn-success mr-2 full-width"
                                                aria-expanded="false">{{ __('home.sign up') }}</button>
                                    </a>
                                </div>
                                <div class="btn-group full-width">
                                    <a href="" class="full-width">
                                        <button type="button" class="btn btn-info mr-2 full-width"
                                                aria-expanded="false">
                                            button 2
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="col-4 pr-5">
                            <img src="{{ asset('images/hotline.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<script>
    window.addEventListener('load', function () {
        var col9Height = document.querySelector('#nav-right').clientHeight;
        var col3Height = document.querySelector('#nav-left').clientHeight;
        document.querySelector('#nav-left').style.padding = (col9Height / 2 - col3Height / 2) + 'px';
    });
</script>
