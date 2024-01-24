@php
    $create = null;
    if(session('create')){
          $create =  session('create');
    }

@endphp
<div class="">
    @if(isset($isAdminUpdate))
        <form autocomplete="off" class="form_memberInfo"
              action="{{route('admin.edit.users.company', $isAdminUpdate->id)}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @else
                <form autocomplete="off" class="form_memberInfo" action="{{route('register.member.buyer')}}"
                      method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @endif
                    <input autocomplete="off" type="text" class="d-none" name="member_id" value="{{ $member->id }}">
                    <input autocomplete="off" type="text" class="d-none" name="member" value="{{ ($member->name) }}">
                    <div class="d-none" id="text-category">{{ __('home.Select the applicable category') }}</div>
                    <div class="day_register title-input">{{ __('home.Day register') }}: <span
                                id="formattedDate"></span></div>
                    <div class="form-group">
                        <label for="number_clearance" class="label_form">{{ __('home.Number clearance')}} <span
                                    class="text-danger">*</span></label>
                        <div class="d-flex">
                            <input autocomplete="off" type="number" class="form-control col-6" id="number_clearance"
                                   name="number_clearance"
                                   value="{{ $create ? $create['number_clearance'] : old('number_clearance', $exitsMember ? $exitsMember->number_clearance : '') }}"
                                   placeholder="{{ __('home.Customs clearance number (enter numbers only)')}}"
                                   required>
                            <div class="col-6">
                                <a href="https://unipass.customs.go.kr/csp/persIndex.do"
                                   class="border-radius-8 w-100 btn bg-member-primary solid btn-register">
                                    <span class="small">{{ __('home.Get a customs clearance number') }}</span>
                                </a>
                            </div>
                        </div>

                    </div>
                    <label for="name_en" class="label_item-member">{{ __('auth.Name') }}<span
                                class="text-danger">*</span></label>
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control mb-2" id="name_en" name="name_en"
                               value="{{ $create ? $create['name_en'] : old('name_en', $exitsMember ? $exitsMember->name_en : '') }}"
                               placeholder="{{ __('auth.English') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="d-none label_item-member">{{ __('home.Name Default') }}
                            <span class="text-danger">*</span></label>
                        <input autocomplete="off" type="text" class="form-control mt-2" id="name" name="name"
                               value="{{ $create ? $create['name'] : old('name', $exitsMember ? $exitsMember->name : '') }}"
                               placeholder="{{ __('auth.Korea') }}" required>
                    </div>
                    <label for="code" class="label_item-member">{{ __('home.ID') }} <span
                                class="text-danger">*</span></label>
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control" id="code" name="code"
                               value="{{ $create ? $create['code'] : old('code', $exitsMember ? $exitsMember->code : '') }}"
                               required>
                    </div>
                    @if(!$exitsMember)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password" class="label_item-member">{{ __('home.Password') }} <span
                                            class="text-danger">*</span></label>
                                <input autocomplete="off" type="password" class="form-control" id="password"
                                       name="password"
                                       placeholder="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="passwordConfirm" class="label_item-member">{{ __('auth.Confirm password') }}
                                    <span
                                            class="text-danger">*</span></label>
                                <input autocomplete="off" type="password" class="form-control" id="passwordConfirm"
                                       name="passwordConfirm" placeholder=""
                                       required>
                            </div>
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneNumber" class="label_item-member">{{ __('auth.Cell phone number') }} <span
                                        class="text-danger">*</span></label>
                            <input autocomplete="off" type="text" class="form-control" id="phoneNumber"
                                   name="phoneNumber"
                                   value="{{ $create ? $create['phone'] : old('phone', $exitsMember ? $exitsMember->phone : '') }}"
                                   required>
                        </div>
                        <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                            <div class="form-check mt-4">
                                <input autocomplete="off" class="form-check-input" type="checkbox" id="gridCheck1"
                                       required>
                                <label class="form-check-label label_item-member" for="gridCheck1">
                                    {{ __('home.Allow receiving notifications via SMS message') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="label_item-member">{{ __('home.email') }} <span
                                        class="text-danger">*</span></label>
                            <input autocomplete="off" type="email" class="form-control" id="email" name="email"
                                   value="{{ $create ? $create['email'] : old('email', $exitsMember ? $exitsMember->email : '') }}"
                                   required>
                        </div>
                        <div class="form-group col-md-6 justify-content-between align-items-center d-flex">
                            <div class="form-check mt-4">
                                <input autocomplete="off" class="form-check-input" type="checkbox" id="gridCheck2"
                                       required>
                                <label class="form-check-label label_item-member" for="gridCheck2">
                                    {{ __('home.Allow receiving notifications via Email') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sns_account" class="label_item-member">{{ __('home.SNS Account') }}
                            <span class="text-danger">*</span></label>
                        <input autocomplete="off" type="text" class="form-control" id="sns_account" name="sns_account"
                               value="{{ $create ? $create['sns_account'] : old('sns_account', $exitsMember ? $exitsMember->sns_account : '') }}"
                               placeholder="" required>
                    </div>
                    <div class="label_form">{{ __('auth.Address Business') }} <span class="text-danger">*</span></div>
                    <label for="select_address" class="label_item-member">{{ __('auth.Address English') }}</label>
                    <div class="form-row">
{{--                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">--}}
{{--                            <input autocomplete="off" type="text" class="form-control" id="countries-select"--}}
{{--                                   placeholder="{{ __('home.Select country') }}"--}}
{{--                                   name="countries-select">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">--}}
{{--                            <input autocomplete="off" type="text" class="form-control" id="cities-select"--}}
{{--                                   placeholder="{{ __('home.Choose the city') }}"--}}
{{--                                   name="cities-select">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">--}}
{{--                            <input autocomplete="off" type="text" class="form-control" id="provinces-select"--}}
{{--                                   placeholder="{{ __('home.Select district/district') }}"--}}
{{--                                   name="provinces-select">--}}
{{--                        </div>--}}
                        <div class="form-group col-md-12" data-toggle="modal" data-target="#modal-address">
                            <input autocomplete="off" type="text" readonly name="select_address" id="select_address"
                                   class="form-control" placeholder="{{ __('home.Select country') }}">
                        </div>
                        <div class="form-group col-md-12">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"
                                         id="detail_address_en">{{ __('home.Address detail') }}</div>
                                </div>
                                <input autocomplete="off" type="text" name="detail-address" id="detail-address"
                                       class="form-control" placeholder="{{ __('home.Address detail') }}"
                                       value="{{ $create ? $create['address_en'] : old('address_en', $exitsMember ? $exitsMember->address_en : '') }}">
                            </div>
                        </div>
                        <input autocomplete="off" type="hidden" id="address_code" name="address_code">
                    </div>
                    <label for="detail-address-1" class="label_item-member">{{ __('auth.Address Korea') }}</label>
                    <div class="form-group">
                        <div class="form-row">
{{--                            <div class="form-group col-md-4 address-below">--}}
{{--                                <input autocomplete="off" type="text" readonly class="form-control"--}}
{{--                                       id="countries-select-1"--}}
{{--                                       placeholder="{{ __('home.Select country') }}"--}}
{{--                                       name="countries-select-1">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-4 address-below">--}}
{{--                                <input autocomplete="off" type="text" readonly class="form-control" id="cities-select-1"--}}
{{--                                       placeholder="{{ __('home.Choose the city') }}"--}}
{{--                                       name="cities-select-1">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-4 address-below">--}}
{{--                                <input autocomplete="off" type="text" readonly class="form-control"--}}
{{--                                       id="provinces-select-1"--}}
{{--                                       placeholder="{{ __('home.Select district/district') }}"--}}
{{--                                       name="provinces-select-1">--}}
{{--                            </div>--}}
                            <div class="form-group col-md-12">
                                <input autocomplete="off" type="text" readonly name="select_address_kr" id="select_address_kr"
                                       class="form-control" placeholder="{{ __('home.Select country') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"
                                             id="detail_address_kr">{{ __('home.Address detail') }}</div>
                                    </div>
                                    <input autocomplete="off" type="text" name="detail-address-1" id="detail-address-1"
                                           class="form-control" placeholder="{{ __('home.Address detail') }}"
                                           value="{{ $create ? $create['address_kr'] : old('address_kr', $exitsMember ? $exitsMember->address_kr : '') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input autocomplete="off" class="form-check-input" type="checkbox" id="gridCheck" required>
                            <label class="form-check-label text-checkout" for="gridCheck">
                                I have read, understand and accept Global's Agree to Terms,
                                <a class="text-policy" href="#">Agree to the Information Collection Policy</a> and
                                <a class="text-policy" href="#">Agree to the Terms of Information Use</a>
                            </label>
                        </div>
                    </div>

                    <input autocomplete="off" id="localeInput" name="locale" class="d-none">
                    <button type="submit" id="btnSubmitFormRegister"
                            class="d-none btn btn-primary">{{ __('home.sign up') }}</button>
                    <div class="text-center">
                        <button type="button" id="buttonRegister"
                                class="w-50 btn bg-member-primary solid mr-3 btn-register">{{ __('home.next') }}</button>
                    </div>
                </form>
</div>
<script>
    $(document).ready(function () {
        $('#buttonRegister').on('click', function () {
            $('#btnSubmitFormRegister').trigger('click');
        })
    })

    // hàm cập nhật ngày tháng năm
    function updateFormattedDate() {
        var currentDate = new Date();
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1;
        var year = currentDate.getFullYear();
        var formattedDate = day + '/' + month + '/' + year;
        document.getElementById('formattedDate').textContent = formattedDate;
    }

    updateFormattedDate();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var passwordInput = document.getElementById('password');
        passwordInput.setAttribute('autocomplete', 'new-password');
    });
</script>
