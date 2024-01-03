@php
    $create = null;
    if(session('create')){
          $create =  session('create');
    }

@endphp
<div class="">
    @if(isset($isAdminUpdate))
        <form class="form_memberInfo" action="{{route('admin.edit.users.company', $isAdminUpdate->id)}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @else
                <form class="form_memberInfo" action="{{route('register.member.buyer')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @endif
                    <input type="text" class="d-none" name="member_id" value="{{ $member->id }}">
                    <input type="text" class="d-none" name="member" value="{{ ($member->name) }}">
                    <div class="d-none" id="text-category">{{ __('home.Select the applicable category') }}</div>
                    <div class="day_register title-input">{{ __('home.Day register') }}: <span
                                id="formattedDate"></span></div>
                    <div class="form-group">
                        <label for="number_clearance"
                               class="label_item-member clearance-member">{{ __('home.Number clearance')}} <span
                                    class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="number_clearance"
                               placeholder="{{ __('home.Number clearance')}}"
                               value="{{ $create ? $create['number_clearance'] : old('number_clearance', $exitsMember ? $exitsMember->number_clearance : '') }}"
                               name="number_clearance">
                    </div>
                    <label for="name_en" class="label_item-member">{{ __('home.Full Name') }}
                        <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="name_en" name="name_en"
                               value="{{ $create ? $create['name_en'] : old('name_en', $exitsMember ? $exitsMember->name_en : '') }}"
                               placeholder="{{ __('home.English only') }}" required>
                        <input type="text" class="form-control mt-2" id="name" name="name"
                               value="{{ $create ? $create['name'] : old('name', $exitsMember ? $exitsMember->name : '') }}"
                               placeholder="{{ __('home.Local language') }}" required>
                    </div>
                    <label for="code" class="label_item-member">{{ __('home.ID') }} <span
                                class="text-danger">*</span></label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="code" name="code"
                               value="{{ $create ? $create['code'] : old('code', $exitsMember ? $exitsMember->code : '') }}"
                               required>
                    </div>
                    @if(!$exitsMember)
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
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneNumber" class="label_item-member">{{ __('home.phone number') }} <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                   value="{{ $create ? $create['phone'] : old('phone', $exitsMember ? $exitsMember->phone : '') }}"
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
                                   value="{{ $create ? $create['email'] : old('email', $exitsMember ? $exitsMember->email : '') }}"
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
                               value="{{ $create ? $create['sns_account'] : old('sns_account', $exitsMember ? $exitsMember->sns_account : '') }}"
                               placeholder="{{ __('home.ID Kakao Talk') }}" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="code_1" class="label_item-member">{{ __('home.Career') }}
                                <span class="text-danger">*</span></label>
                            @php
                                $code_1 = null;
                            @endphp
                            @if($exitsMember)
                                @php
                                    $code_1 = $exitsMember->code_1;
                                @endphp
                            @endif
                            <select id="code_1" class="form-select form-control" name="code_1">
                                @foreach($categories as $category)
                                    <option {{ $code_1 == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">
                                        @if(locationHelper() == 'kr')
                                            {{ $category->name_ko }}
                                        @elseif(locationHelper() == 'cn')
                                            {{$category->name_zh}}
                                        @elseif(locationHelper() == 'jp')
                                            {{$category->name_ja}}
                                        @elseif(locationHelper() == 'vi')
                                            {{$category->name_vi}}
                                        @else
                                            {{$category->name_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="code_2" class="label_item-member">{{ __('home.Business') }}
                                <span class="text-danger">*</span></label>
                            @php
                                $code_2 = null;
                            @endphp
                            @if($exitsMember)
                                @php
                                    $code_2 = $exitsMember->code_2;
                                @endphp
                            @endif
                            <select id="code_2" class="form-select form-control" name="code_2">
                                @foreach($categories as $category)
                                    <option {{ $code_2 == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">
                                        @if(locationHelper() == 'kr')
                                            {{ $category->name_ko }}
                                        @elseif(locationHelper() == 'cn')
                                            {{$category->name_zh}}
                                        @elseif(locationHelper() == 'jp')
                                            {{$category->name_ja}}
                                        @elseif(locationHelper() == 'vi')
                                            {{$category->name_vi}}
                                        @else
                                            {{$category->name_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="label_form">{{ __('home.Address Business') }} <span class="text-danger">*</span></div>
                    <label for="detail-address" class="label_item-member">{{ __('home.Address English') }}</label>
                    <div class="form-row">
                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">
                            <input type="text" readonly class="form-control" id="countries-select"
                                   placeholder="{{ __('home.Select country') }}"
                                   name="countries-select">
                        </div>
                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">
                            <input type="text" readonly class="form-control" id="cities-select"
                                   placeholder="{{ __('home.Choose the city') }}"
                                   name="cities-select">
                        </div>
                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">
                            <input type="text" readonly class="form-control" id="provinces-select"
                                   placeholder="{{ __('home.Select district/district') }}"
                                   name="provinces-select">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="detail-address" id="detail-address"
                                   class="form-control" placeholder="{{ __('home.Address detail') }}"
                                   value="{{ $create ? $create['address_en'] : old('address_en', $exitsMember ? $exitsMember->address_en : '') }}">
                        </div>
                        <input type="hidden" id="address_code" name="address_code">
                    </div>
                    <label for="detail-address-1" class="label_item-member">{{ __('home.Address Korea') }}</label>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-4 address-below" data-toggle="modal"
                                 data-target="#modal-address">
                                <input type="text" readonly class="form-control" id="countries-select-1"
                                       placeholder="{{ __('home.Select country') }}"
                                       name="countries-select-1">
                            </div>
                            <div class="form-group col-md-4 address-below" data-toggle="modal"
                                 data-target="#modal-address">
                                <input type="text" readonly class="form-control" id="cities-select-1"
                                       placeholder="{{ __('home.Choose the city') }}"
                                       name="cities-select-1">
                            </div>
                            <div class="form-group col-md-4 address-below" data-toggle="modal"
                                 data-target="#modal-address">
                                <input type="text" readonly class="form-control" id="provinces-select-1"
                                       placeholder="{{ __('home.Select district/district') }}"
                                       name="provinces-select-1">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="detail-address-1" id="detail-address-1"
                                       class="form-control" placeholder="{{ __('home.Address detail') }}"
                                       value="{{ $create ? $create['address_kr'] : old('address_kr', $exitsMember ? $exitsMember->address_kr : '') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" required>
                            <label class="form-check-label text-checkout" for="gridCheck">
                                I have read, understand and accept Global's Agree to Terms,
                                <a class="text-policy" href="#">Agree to the Information Collection Policy</a> and
                                <a class="text-policy" href="#">Agree to the Terms of Information Use</a>
                            </label>
                        </div>
                    </div>

                    <input id="localeInput" name="locale" class="d-none">
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