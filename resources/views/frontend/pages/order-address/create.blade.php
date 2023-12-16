@extends('frontend.layouts.master')
@section('title', 'Create New Address')
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
                                <li class="breadcrumb-item">
                                    <a href="{{ route('user.address.show') }}">Delivery address</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('user.address.process.create') }}">Add new address</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-page">
            <form action="{{ route('user.address.create') }}" method="post" class="form-create-address">
                @csrf
                <div class="form-group">
                    <label class="s12w4" for="username">Full Name</label>
                    <input type="text" class="form-control input-placeholder-s12w4" id="username" name="username" placeholder="Nguyen Van A" required>
                </div>
                <div class="form-group">
                    <label class="s12w4" for="company">Company</label>
                    <input type="text" class="form-control input-placeholder-s12w4" id="company" name="company" placeholder="Main Conpany" required>
                </div>
                <div class="form-group">
                    <label class="s12w4" for="phone">Phone Number</label>
                    <input id="phone" type="tel" class="form-control input-placeholder-s12w4" name="phone" required
                           placeholder="0989889889"
                           pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b">
                </div>
                <div class="d-none">
                    <input type="text" class="address_option" name="address_option" value="Home">
                </div>
                <p class="s12w4 address">Address</p>
                <div class="form-group">
                    <select id="city" name="city" class="form-control">
                        <option class="option-s16w4">Province/City</option>
                    </select>
                </div>
                <div class="form-group">
                    <select id="district" name="province" class="form-control">
                        <option class="option-s16w4">District</option>
                    </select>
                </div>
                <div class="form-group">
                    <select id="ward" name="location" class="form-control">
                        <option class="option-s16w4">Wards/Commune</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control input-placeholder-s12w4" id="address_detail" name="address_detail" placeholder="Specific address" rows="3"></textarea>
                </div>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <p class="default s16w6">Set as default address</p>
                    <input id="select_address_default" type="checkbox" name="default"
                           class="mr-2 custom-checkbox toggleProduct"
                           value="1">
                    <label class="select_address_default" for="select_address_default"></label>
                </div>
                <div class="button text-center">
                    <button type="submit" class="btn btnSaveAddress">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/frontend/pages/profile/address-book.js')}}"></script>
@endsection