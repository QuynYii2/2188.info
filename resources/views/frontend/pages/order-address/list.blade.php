@extends('frontend.layouts.master')
@section('title', 'List Address')
@section('content')
    <div class="container-fluid address-page">
        <div class="header-page d-flex justify-content-between align-items-center">
            <div class="grid second-nav">
                <div class="column-xs-12 category-header" style="padding: 1rem">
                    <div class="breadcrumbs_filter">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('homepage') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    Product
                                </li>
                                <li class="breadcrumb-item">
                                    Detail product
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('checkout.show') }}">Payment</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('user.address.show') }}">Delivery address</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <a href="{{ route('user.address.process.create') }}" class="btn btnAddNewAddress d-flex align-items-center">
                <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                <span>Add new address</span>
            </a>
        </div>
        <div class="main-page">
            <div class="list-address">
                @foreach($addresses as $address)
                    <div class="address-item d-flex justify-content-between align-items-center bg-white">
                        <label for="inputAddress">
                            <div class="address-detail">
                                <div class="name address-value">
                                    <span class="title">Name: </span>
                                    <span class="value">{{$address->username}}</span>
                                </div>
                                <div class="phone address-value">
                                    <span class="title">Phone: </span>
                                    <span class="value">{{$address->phone}}</span>
                                </div>
                                <div class="address address-value">
                                    <span class="title">Address: </span>
                                    <span class="value">
                                        {{$address->address_detail}}, {{$address->location}}, {{$address->province}},{{$address->city}}
                                    </span>
                                </div>
                            </div>
                        </label>
                        <input type="radio" class="inputSelectAddress" id="inputAddress_{{$address->id}}" name="address"
                               {{ $address->default ? 'checked' : '' }} value="{{$address->id}}">
                    </div>
                @endforeach
            </div>

            <div class="button text-center">
                <button class="btn btnConfirmAddress">Confirm</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.btnConfirmAddress').on('click', function () {
                let selected = $('input[class="inputSelectAddress"]:checked');
                let value = selected.val();
                sessionStorage.setItem('address_id', value);
                window.location.href = '{{ route('checkout.show') }}';
            })
        })
    </script>
@endsection
