@php use Illuminate\Support\Facades\Auth;
 $user = \App\Models\User::find(Auth::user()->id)
@endphp

@extends('frontend.layouts.profile')

@section('title', 'Information')

@section('sub-content')
    <style>
        .size-img {
            width: 20px;
            height: 20px;
        }

        .avatar-upload img {
            max-width: none;
        }

        @media (max-width: 991px) {
            .border-right {
                border-right: none !important;
            }

            #form-info {
                padding-bottom: 3rem;
            }
        }

        @media (min-width: 992px) {
            .border-bottom {
                border-bottom: none !important;
            }
        }

        .cus-mr-modal {
        }

        @media (max-width: 575px) {
            .list-group .list-group-item {
                padding: 0.75rem 0;
            }

            .cus-mr-modal {
                width: 100vw;
                margin: 0 !important;
            }
        }

        @media (max-width: 481px) {
            .avatar-upload .preview, .image-upload .preview {
                width: 60px;
                height: 60px;
                position: relative;
                border: 6px solid #c9c9c9;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
            }

            .avatar-upload .avatar-edit input + label, .image-upload .image-edit input + label {
                display: inline-block;
                width: 15px;
                height: 15px;
                margin-bottom: 0;
                border-radius: 100%;
                background: #e0dfdf;
                border: 1px solid;
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.12);
                cursor: pointer;
                font-weight: normal;
                transition: all 0.2s ease-in-out;
            }

            .size-img {
                width: 10px;
                height: 10px;
                display: flex;
            }
        }

    </style>

    <div class="container row rounded mt-5 bg-white m-auto">
        {{--        <div class="row rounded pt-1">--}}
        {{--            <h5>{{ __('home.account information') }}</h5>--}}
        {{--        </div>--}}
        <div class="border-bottom"></div>
        <div class="row mb-5">
            <div id="form-info" class="col-md-12 col-lg-6 border-bottom border-right">
                <form>
                    <div class="row align-items-center">
                        <div class="col-auto col-md-4">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type="file" id="avatarUpload" class="imageUpload" name="avatar"
                                           accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                                    <label for="avatarUpload" class="bg-white text-center">
                                        <svg class="size-img" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512">
                                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                        </svg>
                                    </label>
                                </div>
                                <img class=" img preview mb-3" id="avatarPreview" src="{{$user->image}}">
                            </div>
                        </div>
                        {{--                        --}}
                        {{--                        <div class="dropdown mobile-button">--}}
                        {{--                            <div class="d-inline-block ml-3 dropbtn ">--}}
                        {{--                                <h6>{{ __('home.account of') }}</h6>--}}
                        {{--                                <h4>{{$user->name}}</h4>--}}
                        {{--                            </div>--}}

                        {{--                            <div class="dropdown-content" style="width: 90vw; left: -95px">--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/info">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">--}}
                        {{--                                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>--}}
                        {{--                                    </svg>{{ __('home.account information') }}</a>--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/my-notification">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">--}}
                        {{--                                        <path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/>--}}
                        {{--                                    </svg>{{ __('home.my notification') }}</a>--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/order-management">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">--}}
                        {{--                                        <path d="M377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-153 31V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zM64 72c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8V72zm0 80v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8zm144 263.88V440c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-24.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V232c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v24.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07z"/>--}}
                        {{--                                    </svg>{{ __('home.order management') }}</a>--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/return-management">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
                        {{--                                        <path d="M32 96l320 0V32c0-12.9 7.8-24.6 19.8-29.6s25.7-2.2 34.9 6.9l96 96c6 6 9.4 14.1 9.4 22.6s-3.4 16.6-9.4 22.6l-96 96c-9.2 9.2-22.9 11.9-34.9 6.9s-19.8-16.6-19.8-29.6V160L32 160c-17.7 0-32-14.3-32-32s14.3-32 32-32zM480 352c17.7 0 32 14.3 32 32s-14.3 32-32 32H160v64c0 12.9-7.8 24.6-19.8 29.6s-25.7 2.2-34.9-6.9l-96-96c-6-6-9.4-14.1-9.4-22.6s3.4-16.6 9.4-22.6l96-96c9.2-9.2 22.9-11.9 34.9-6.9s19.8 16.6 19.8 29.6l0 64H480z"/>--}}
                        {{--                                    </svg>{{ __('home.return management') }}</a>--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/address-book">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">--}}
                        {{--                                        <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>--}}
                        {{--                                    </svg>{{ __('home.address book') }}</a>--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/payment-information">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">--}}
                        {{--                                        <path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z"/>--}}
                        {{--                                    </svg>{{ __('home.payment information') }}</a>--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/product-evaluation">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
                        {{--                                        <path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4l0 0 0 0 0 0 0 0 .3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/>--}}
                        {{--                                    </svg>{{ __('home.product evaluation') }}</a>--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/product-viewed">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">--}}
                        {{--                                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>--}}
                        {{--                                    </svg>{{ __('home.product viewed') }}</a>--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/favorite-product">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
                        {{--                                        <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>--}}
                        {{--                                    </svg>{{ __('home.favorite product') }}</a>--}}
                        {{--                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/my-review">--}}
                        {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">--}}
                        {{--                                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>--}}
                        {{--                                    </svg>{{ __('home.my review') }}</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="d-inline-block ml-3 dropbtn mobile-button">
                            <label for="">Avatar</label>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="staticEmail"
                                       class="col-md-3 col-12 col-form-label">{{ __('home.full name') }}</label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="staticEmail" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword"
                                       class="col-md-3 col-12 col-form-label">{{ __('home.nickname') }}</label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="inputPassword"
                                           value="{{$user->username}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="day"
                               class="col-md-3 col-12 col-form-label col-lg-4 col-xl-3">{{ __('home.date of birth') }}</label>

                        <div class="col-md-3 col-12 pb-1 col-lg-4 col-xl-3">
                            <select class="form-control" id="day">
                            </select>
                        </div>
                        <div class="col-md-3 col-12 pb-1 col-lg-4 col-xl-3">
                            <select class="form-control" id="month">
                            </select>
                        </div>
                        <div class="col-md-3 col-12 pb-1 col-lg-12 col-xl-3">
                            <select class="form-control" id="year">
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.gender') }}</label>
                        <div class="col-sm-9 m-auto">
                            <div class="row">
                                <div class=" col-sm-4 col-4">
                                    <input class="" type="radio" name="exampleRadios"
                                           id="exampleRadios1"
                                           value="1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ __('home.male') }}
                                    </label>
                                </div>
                                <div class=" col-sm-4 col-4">
                                    <input class="" type="radio" name="exampleRadios"
                                           id="exampleRadios2"
                                           value="2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        {{ __('home.female') }}
                                    </label>
                                </div>
                                <div class=" col-sm-4 col-4">
                                    <input class="" type="radio" name="exampleRadios"
                                           id="exampleRadios3"
                                           value="3">
                                    <label class="form-check-label" for="exampleRadios3">
                                        {{ __('home.other') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.nationality') }}</label>

                        <div class="col-md-9 col-12">
                            <select class="form-control" id="country">
                            </select>
                        </div>
                    </div>
                    <div class="row pl-2 pt-3">
                        <label for="day" class="col-sm-3 col-form-label col-12"></label>

                        <div class="col-md-9 col-12">
                            <button class="btn btn-outline-primary -align-center"
                                    type="submit">{{ __('home.save changes') }}</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12 col-lg-6 col-12">
                <div class="pt-2">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>{{ __('home.phone number and email') }}</span>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                @if($user->phone == null)
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                                        </svg>
                                        {{ __('home.phone number') }}
                                    </h6>
                                    <h6 class="mb-0" style="margin-left: 32px">{{ __('home.add phone') }}</h6>
                                @else
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                                        </svg>
                                        {{ __('home.phone number') }}
                                    </h6>
                                    <h6 class="mb-0" style="margin-left: 32px">{{$user->phone}}</h6>
                                @endif
                            </div>
                            <button class="btn-outline-primary btn desktop-button" data-toggle="modal"
                                    data-target="#modal-edit-phone">
                                {{ __('home.update') }}
                            </button>
                            <svg class="mobile-button" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 512 512" data-toggle="modal" data-target="#modal-edit-phone">
                                <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                            </svg>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                @if($user->email == null)
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                        </svg>
                                        {{ __('home.email') }}
                                    </h6>
                                    <h6 class="mb-0" style="margin-left: 32px">{{ __('home.add email') }}</h6>
                                @else
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                        </svg>
                                        {{ __('home.email') }}
                                    </h6>
                                    <h6 class="mb-0" style="margin-left: 32px">{{$user->email}}</h6>
                                @endif
                            </div>
                            <button class="btn-outline-primary btn desktop-button" data-toggle="modal"
                                    data-target="#modal-edit-email">
                                {{ __('home.update') }}
                            </button>
                            <svg class="mobile-button" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 512 512" data-toggle="modal" data-target="#modal-edit-phone">
                                <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                            </svg>
                        </li>
                    </ul>
                </div>
                <div class="pb-3">
                    <br>
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>{{ __('home.security') }}</span>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
                                </svg>
                                {{ __('home.change password') }}
                            </h6>
                            <button class="btn-outline-primary btn desktop-button" data-toggle="modal"
                                    data-target="#modal-edit-password">
                                {{ __('home.update') }}
                            </button>
                            <svg class="mobile-button" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 512 512" data-toggle="modal" data-target="#modal-edit-phone">
                                <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                            </svg>
                        </li>
                    </ul>
                </div>
                <br>

                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>{{ __('home.link social network') }}</span>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                                </svg>
                                Facebook
                            </h6>
                            <button class="btn-outline-primary btn">{{ __('home.link') }}</button>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                    <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                                </svg>
                                Google
                            </h6>
                            <button class="btn-outline-primary btn">{{ __('home.link') }}</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-phone" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered cus-mr-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật số điện thoại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Số điện thoại</label>
                            <div>
                                <input type="tel" class="form-control" name="edit-phone"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-email" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered cus-mr-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Email</label>
                            <div>
                                <input type="tel" class="form-control" name="edit-email"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-password" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered cus-mr-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('user.changePassword')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputPassword" class="col-form-label">Mật khẩu hiện tại</label>
                            <div>
                                <input type="password" class="form-control" name="current-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-form-label">Mật khẩu mới</label>
                            <div>
                                <input type="password" class="form-control" name="new-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-form-label">Nhập lại mật khẩu mới</label>
                            <div>
                                <input type="password" class="form-control" name="renew-password"
                                       onchange="checkPasswordMatch()">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        var yearSelect = document.getElementById('year');
        var currentYear = new Date().getFullYear();
        var daySelect = document.getElementById('day');
        var monthSelect = document.getElementById('month');

        for (var i = currentYear; i >= currentYear - 100; i--) {
            var option = document.createElement('option');
            option.value = i;
            option.text = i;
            yearSelect.add(option);
        }
        for (var i = 1; i <= 12; i++) {
            var option = document.createElement('option');
            option.value = i;
            option.text = i;
            monthSelect.add(option);
        }

        var year = parseInt(yearSelect.value);
        var month = parseInt(monthSelect.value);
        var daysInMonth = new Date(year, month, 0).getDate();

        for (var i = 1; i <= daysInMonth; i++) {
            var option = document.createElement('option');
            option.value = i;
            option.text = i;
            daySelect.add(option);
        }

        function updateDaysInMonth() {
            var year = parseInt(yearSelect.value);
            var month = parseInt(monthSelect.value);
            var daysInMonth = new Date(year, month, 0).getDate();
            daySelect.innerHTML = '';
            for (var i = 1; i <= daysInMonth; i++) {
                var option = document.createElement('option');
                option.value = i;
                option.text = i;
                daySelect.add(option);
            }
        }

        var countrySelect = document.getElementById('country');
        fetch('https://restcountries.com/v2/all')
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement('option');
                    option.value = data[i].alpha2Code;
                    option.text = data[i].name;
                    countrySelect.add(option);
                }
            })
            .catch(function (error) {
                console.log(error);
            });


        monthSelect.addEventListener('change', updateDaysInMonth);
        yearSelect.addEventListener('change', updateDaysInMonth);


        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('avatarPreview');
                output.src = reader.result;
                output.style.backgroundSize = "cover";
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                // Các tùy chọn và cấu hình khác của Bootstrap Datepicker
            });
        });


        function checkPasswordMatch() {
            var newPassword = document.getElementsByName("new-password")[0].value;
            var renewPassword = document.getElementsByName("renew-password")[0].value;

            if (newPassword !== renewPassword) {
                alert("Mật khẩu mới và nhập lại mật khẩu không khớp nhau.");
            }
        }
    </script>
@endsection
