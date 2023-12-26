@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="container-fluid detail-user-page bg-white">
        <div class="title">
            Back
        </div>
        <div class="form-update">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="number_clearance"
                           class="label_item-member clearance-member">{{ __('home.Number clearance')}} <span
                                class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="number_clearance"
                           placeholder="{{ __('home.Number clearance')}}"
                           value=""
                           name="number_clearance">
                </div>
                <label for="name_en" class="label_item-member">{{ __('home.Full Name') }}
                    <span class="text-danger">*</span></label>
                <div class="form-group">
                    <input type="text" class="form-control mb-2" id="name_en" name="name_en"
                           value=""
                           placeholder="{{ __('home.English only') }}" required>
                    <input type="text" class="form-control mt-2" id="name" name="name"
                           value=""
                           placeholder="{{ __('home.Local language') }}" required>
                </div>
                <label for="code" class="label_item-member">{{ __('home.ID') }} <span
                            class="text-danger">*</span></label>
                <div class="form-group">
                    <input type="text" class="form-control" id="code" name="code"
                           value=""
                           required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password" class="label_item-member">{{ __('home.Password') }} <span
                                    class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="*********" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="passwordConfirm" class="label_item-member">{{ __('home.Password') }} <span
                                    class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="passwordConfirm"
                               name="passwordConfirm" placeholder="*********"
                               required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phoneNumber" class="label_item-member">{{ __('home.phone number') }} <span
                                    class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                               value=""
                               required>
                    </div>
                    <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="gridCheck1" required>
                            <label class="form-check-label label_item-member" for="gridCheck1">
                                {{ __('home.Allow receiving notifications via SMS message') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email" class="label_item-member">{{ __('home.email') }} <span
                                    class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                               value=""
                               required>
                    </div>
                    <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="gridCheck2" required>
                            <label class="form-check-label label_item-member" for="gridCheck2">
                                {{ __('home.Allow receiving notifications via Email') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sns_account" class="label_item-member">{{ __('home.SNS Account') }}
                        <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="sns_account" name="sns_account"
                           value=""
                           placeholder="{{ __('home.ID Kakao Talk') }}" required>
                </div>
                <div class="button-save">
                    <button class="btn btnSave" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
