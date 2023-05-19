@extends('frontend.layouts.profile')

@section('title', 'My Notification')

@section('sub-content')
    <div class="row mt-5 bg-white rounded">

        <div class="col-xs-12 ">
            <div class="row rounded pt-1">
                <h5>{{ __('home.my notification') }}</h5>
            </div>
            <div class="border-bottom"></div>
            <nav>
                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" data-target="#nav-1"
                       role="tab" aria-controls="nav-1" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"/>
                        </svg>
                    </a>
                    <a class="nav-item nav-link" data-toggle="tab" data-target="#nav-2" role="tab"
                       aria-controls="nav-2" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M32 448c0 17.7 14.3 32 32 32h160V320H32v128zm256 32h160c17.7 0 32-14.3 32-32V320H288v160zm192-320h-42.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H32c-17.7 0-32 14.3-32 32v80c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16v-80c0-17.7-14.3-32-32-32zm-326.1 0c-22.1 0-40-17.9-40-40s17.9-40 40-40c19.9 0 34.6 3.3 86.1 80h-86.1zm206.1 0h-86.1c51.4-76.5 65.7-80 86.1-80 22.1 0 40 17.9 40 40s-17.9 40-40 40z"/>
                        </svg>
                    </a>
                    <a class="nav-item nav-link" data-toggle="tab" data-target="#nav-3"
                       role="tab" aria-controls="nav-3" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M128 160h320v192H128V160zm400 96c0 26.51 21.49 48 48 48v96c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48v-96c26.51 0 48-21.49 48-48s-21.49-48-48-48v-96c0-26.51 21.49-48 48-48h480c26.51 0 48 21.49 48 48v96c-26.51 0-48 21.49-48 48zm-48-104c0-13.255-10.745-24-24-24H120c-13.255 0-24 10.745-24 24v208c0 13.255 10.745 24 24 24h336c13.255 0 24-10.745 24-24V152z"/></svg>
                    </a>
                    <a class="nav-item nav-link" data-toggle="tab" data-target="#nav-4" role="tab"
                       aria-controls="nav-4" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M255.545 8c-66.269.119-126.438 26.233-170.86 68.685L48.971 40.971C33.851 25.851 8 36.559 8 57.941V192c0 13.255 10.745 24 24 24h134.059c21.382 0 32.09-25.851 16.971-40.971l-41.75-41.75c30.864-28.899 70.801-44.907 113.23-45.273 92.398-.798 170.283 73.977 169.484 169.442C423.236 348.009 349.816 424 256 424c-41.127 0-79.997-14.678-110.63-41.556-4.743-4.161-11.906-3.908-16.368.553L89.34 422.659c-4.872 4.872-4.631 12.815.482 17.433C133.798 479.813 192.074 504 256 504c136.966 0 247.999-111.033 248-247.998C504.001 119.193 392.354 7.755 255.545 8z"/></svg></a>
                </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade text-center active show" id="nav-1" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <img src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.you have no notification') }}</p>
                </div>
                <div class="tab-pane fade text-center" id="nav-2" role="tabpanel" aria-labelledby="nav-about-tab">
                    <img src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.you have no notification') }}</p>
                </div>
                <div class="tab-pane fade text-center" id="nav-3" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <img src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.you have no notification') }}</p>
                </div>
                <div class="tab-pane fade text-center" id="nav-4" role="tabpanel" aria-labelledby="nav-about-tab">
                    <img src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.you have no notification') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
