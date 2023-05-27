@extends('frontend.layouts.profile')

@section('title', 'Payment Information')

@section('sub-content')
    <div class="row mt-5 bg-white rounded">
        <div class="row rounded pt-1 ml-5">
            <h5>{{ __('home.payment information') }}</h5>
        </div>
        <div class="border-bottom"></div>
        <div class="col-md-12">
            <div class="tab-content py-3 px-3 px-sm-0">
                <div class="text-center">
                    <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.save payment information') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
