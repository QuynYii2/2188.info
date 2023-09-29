@extends('frontend.layouts.profile')

@section('title', 'Return Management')

@section('sub-content')
    <div id="address-book" class="row mt-2 bg-white rounded">
        <div class="row rounded pt-1 ml-5">
            <h5>{{ __('home.return management') }}</h5>
        </div>
        <div class="border-bottom"></div>
        <div class="col-md-12 ">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item link-tabs nav-link active" data-toggle="tab" data-target="#nav-1"
                       role="tab" aria-controls="nav-1" aria-selected="true">
                        {{ __('home.all') }}
                    </a>
                    <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-2" role="tab"
                       aria-controls="nav-2" aria-selected="false">
                        {{ __('home.in progress') }}
                    </a>
                    <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-3"
                       role="tab" aria-controls="nav-3" aria-selected="false">
                        {{ __('home.done') }}
                    </a>
                </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade text-center active show" id="nav-1" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.you have no order') }}</p>
                </div>
                <div class="tab-pane fade text-center" id="nav-2" role="tabpanel" aria-labelledby="nav-about-tab">
                    <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.you have no order') }}</p>
                </div>
                <div class="tab-pane fade text-center" id="nav-3" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.you have no order') }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
