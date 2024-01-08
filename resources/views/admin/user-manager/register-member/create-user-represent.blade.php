@extends('backend.layouts.master')
@section('title')
    Create User
@endsection
@section('content')
    <h3 class="text-center mt-3">
        Create User
    </h3>
    <div class="container-fluid">
        <form class="p-3 form_info-member-person" action="{{route('admin.member.create.represent')}}" method="post">
            @csrf
            <div class="form-group">
                <label class="label_form" for="datetime_register">Datetime Register <span
                            class="text-danger">*</span></label>
                <input type="text" class="form-control" id="datetime_register" disabled
                       value="{{ \Carbon\Carbon::now()->addHours(7)->format('Y-m-d H:i:s') }}">
            </div>
            <div class="form-group">
                <label for="name_en" class="label_form">{{ __('home.Name English') }} <span
                            class="text-danger">*</span></label>
                <input type="text" class="form-control mb-2" id="name_en" name="name_en"
                       placeholder="{{ __('home.Name English') }}"
                       value=""
                       required>
            </div>
            <div class="forn-group">
                <label for="name" class="label_form">{{ __('home.Name Default') }} <span
                            class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name"
                       placeholder="{{ __('home.Name Default') }}"
                       value=""
                       required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="code" class="label_form">{{ __('home.ID') }} <span
                                class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="code" name="code"
                           placeholder="{{ __('home.ID') }}"
                           value=""
                           required>
                </div>
                <div class="form-group col-md-4">
                    <label for="password" class="label_form">{{ __('home.Password') }} <span
                                class="text-danger">*</span></label>
                    <input type="password" minlength="6" maxlength="50" class="form-control" id="password"
                           name="password"
                           placeholder="{{ __('home.Password') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="passwordConfirm" class="label_form">{{ __('home.Re-Password') }} <span
                                class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="passwordConfirm"
                           name="passwordConfirm" minlength="6" maxlength="50"
                           placeholder="{{ __('home.Re-Password') }}"
                           required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phoneNumber" class="label_form">{{ __('home.Phone Number') }} <span
                                class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                           placeholder="{{ __('home.Phone Number') }}"
                           value=""
                           required>
                </div>
                <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="checkBoxPhone">
                        <label class="form-check-label" for="checkBoxPhone">
                            {{ __('home.Apply notification SMS') }}
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="label_form">{{ __('home.email') }} <span
                                class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="{{ __('home.email') }}"
                           value=""
                           required>
                </div>
                <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="checkBoxEmail">
                        <label class="form-check-label" for="checkBoxEmail">
                            {{ __('home.Confirm apply notification Email') }}
                        </label>
                    </div>
                </div>
            </div>
            <label for="sns_account" class="label_form">{{ __('home.SNS Account') }} <span
                        class="text-danger">*</span></label>
            <div class="form-group">
                <input type="text" class="form-control" id="sns_account" name="sns_account"
                       placeholder="{{ __('home.SNS Account') }}"
                       value=""
                       required>
            </div>
            <input type="text" class="form-control d-none" name="person" value="{{ $code }}">
            <div class="action text-center">
                <button class="btn btnCreateDefault" type="submit">Create</button>
            </div>
        </form>
    </div>
@endsection
