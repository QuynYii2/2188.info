@php
    $createCompany = null;
    if(session('createCompany')){
          $createCompany =  session('createCompany');
    }

@endphp
<div class="">
    @if(isset($isAdminUpdate))
        <form autocomplete="off" class="form_memberInfo"
              action="{{route('admin.edit.users.company', $isAdminUpdate->id)}}" method="post"
              id="formRegisterMember">
            @csrf
            @method('PUT')
            @else
                <form autocomplete="off" class="form_memberInfo" action="{{route('register.member.info')}}"
                      method="post"
                      id="formRegisterMember" enctype="multipart/form-data">
                    @csrf
                    @endif
                    @isset($isAdminUpdate)
                        <input autocomplete="off" type="text" class="d-none" name="updateCheck" value="updateCheck">
                    @endisset
                    <input autocomplete="off" type="text" class="d-none" name="member_id" value="{{ $member->id }}">
                    <input autocomplete="off" type="text" class="d-none" name="member" value="{{ ($member->name) }}">
                    <div class="d-none" id="text-category">{{ __('home.Select the applicable category') }}</div>
                    <div class="day_register title-input">{{ __('home.Day register') }}: <span
                                id="formattedDate"></span></div>

                    <label for="email" class="label_form">{{ __('home.company information') }} <span
                                class="text-danger">*</span></label>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input autocomplete="off" type="text" class="form-control" id="name_en" name="name_en"
                                   value="{{ $createCompany ? $createCompany['name_en'] : old('name_en', $exitsMember ? $exitsMember->name_en : '') }}"
                                   placeholder="{{ __('home.English only') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input autocomplete="off" type="text" class="form-control" id="name_kr" name="name_kr"
                                   value="{{ $createCompany ? $createCompany['name_kr'] : old('name_kr', $exitsMember ? $exitsMember->name_kr :'') }}"
                                   placeholder="{{ __('auth.Name Korea')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <input autocomplete="off" type="text" class="form-control" id="homepage"
                                   value="{{ $createCompany ? $createCompany['homepage'] : old('homepage', $exitsMember ? $exitsMember->homepage : '') }}"
                                   name="homepage" placeholder="{{ __('home.Home') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input autocomplete="off" type="number" class="form-control" id="number_business"
                                   value="{{ $createCompany ? $createCompany['number_business'] : old('number_business', $exitsMember ? $exitsMember->number_business :'') }}"
                                   name="number_business" placeholder="{{ __('auth.Business registration card') }}"
                                   required>
                        </div>
                        <div class="form-group col-md-6">
                            <input autocomplete="off" type="number" class="form-control" id="phone"
                                   value="{{ $createCompany ? $createCompany['phone'] : old('phone', $exitsMember ? $exitsMember->phone : '') }}"
                                   name="phone" placeholder="{{ __('home.Phone Number') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input autocomplete="off" type="number" class="form-control" id="fax"
                                   value="{{ $createCompany ? $createCompany['fax'] : old('fax', $exitsMember ? $exitsMember->fax :'') }}"
                                   name="fax" placeholder="{{ __('home.Fax') }}">
                        </div>
                        <div class="form-group col-md-8">
                            <div class="input-group">
                                <input autocomplete="off" type="email" class="form-control" id="email"
                                       value="{{ $createCompany ? $createCompany['email'] : old('email', $exitsMember ? $exitsMember->email: '') }}"
                                       name="email" placeholder="{{ __('home.email') }}">
                                <button type="button" id="btnChecking"
                                        class="btn btn-outline-warning">{{ __('auth.Check email') }}</button>
                            </div>
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkEmail">
                                <label class="form-check-label text-checkout" for="checkEmail">
                                    {{ __('auth.Email Acceptance') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label_item-member">
                            {{ __('home.Business license')}}
                            <span class="text-danger">*</span>
                        </div>
                        <label id="giay_phep_kinh_doanhLabel" for="giay_phep_kinh_doanh">
                            <div class="upload-item-input d-flex justify-content-between">
                                <div class="upload-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61" viewBox="0 0 60 61"
                                         fill="none">
                                        <path d="M30 13V48M12.5 30.5H47.5" stroke="#929292" stroke-width="6"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                        </label>
                        <input autocomplete="off" type="file" class="form-control" id="giay_phep_kinh_doanh"
                               accept="image/*"
                               style="visibility:hidden;"
                               name="giay_phep_kinh_doanh" {{ $exitsMember ? '' : 'required' }}>
                        <div class="imagePreview"></div>
                        @if($exitsMember && $exitsMember->giay_phep_kinh_doanh)
                            <img src="{{ asset('storage/'.$exitsMember->giay_phep_kinh_doanh) }}" alt="" width="60px"
                                 height="60px" id="giay_phep_kinh_doanh_preview">
                        @endif
                    </div>

                    <div class="label_form">{{ __('home.Address Business') }} <span class="text-danger">*</span></div>
                    <label for="select_address" class="label_item-member">{{ __('home.Address English') }}</label>
                    <div class="form-row">
                        {{--                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">--}}
                        {{--                            <input autocomplete="off" type="text" readonly class="form-control" id="countries-select"--}}
                        {{--                                   placeholder="{{ __('home.Select country') }}"--}}
                        {{--                                   name="countries-select">--}}
                        {{--                        </div>--}}
                        {{--                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">--}}
                        {{--                            <input autocomplete="off" type="text" readonly class="form-control" id="cities-select"--}}
                        {{--                                   placeholder="{{ __('home.Choose the city') }}"--}}
                        {{--                                   name="cities-select">--}}
                        {{--                        </div>--}}
                        {{--                        <div class="form-group col-md-4 address-above" data-toggle="modal" data-target="#modal-address">--}}
                        {{--                            <input autocomplete="off" type="text" readonly class="form-control" id="provinces-select"--}}
                        {{--                                   placeholder="{{ __('home.Select district/district') }}"--}}
                        {{--                                   name="provinces-select">--}}
                        {{--                        </div>--}}
                        <div class="form-group col-md-12" data-toggle="modal" data-target="#modal-address">
                            <input autocomplete="off" type="text" readonly name="select_address" id="select_address"
                                   class="form-control" placeholder="{{ __('home.Select country') }}">
                        </div>
                        <div class="form-group col-md-12">
                            {{--                            <div class="input-group mb-2">--}}
                            {{--                                <div class="input-group-prepend">--}}
                            {{--                                    <div class="input-group-text"--}}
                            {{--                                         id="detail_address_en">{{ __('home.Address detail') }}</div>--}}
                            {{--                                </div>--}}
                            {{--                                <input autocomplete="off" type="text" name="detail-address" id="detail-address"--}}
                            {{--                                       class="form-control" placeholder="{{ __('home.Address detail') }}"--}}
                            {{--                                       value="{{ $createCompany ? $createCompany['address_en'] : old('address_en', $exitsMember ? $exitsMember->address_en : '') }}">--}}
                            {{--                            </div>--}}
                            <input autocomplete="off" type="text" name="detail-address" id="detail-address"
                                   class="form-control" placeholder="{{ __('auth.Please enter your detailed address here') }}"
                                   value="{{ $createCompany ? $createCompany['address_en'] : old('address_en', $exitsMember ? $exitsMember->address_en : '') }}">
                        </div>
                        <input autocomplete="off" type="hidden" id="address_code" name="address_code">
                    </div>
                    <label for="detail-address-1" class="label_item-member">{{ __('home.Address Korea') }}</label>
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
                                <input autocomplete="off" type="text" readonly name="select_address_kr"
                                       id="select_address_kr"
                                       class="form-control" placeholder="{{ __('home.Select country') }}">
                            </div>
                            <div class="form-group col-md-12">
                                {{--                                <div class="input-group mb-2">--}}
                                {{--                                    <div class="input-group-prepend">--}}
                                {{--                                        <div class="input-group-text"--}}
                                {{--                                             id="detail_address_kr">{{ __('home.Address detail') }}</div>--}}
                                {{--                                    </div>--}}
                                {{--                                    <input autocomplete="off" type="text" name="detail-address-1" id="detail-address-1"--}}
                                {{--                                           class="form-control" placeholder="{{ __('home.Address detail') }}"--}}
                                {{--                                           value="{{ $createCompany ? $createCompany['address_kr'] : old('address_kr', $exitsMember ? $exitsMember->address_kr : '') }}">--}}
                                {{--                                </div>--}}
                                <input autocomplete="off" type="text" name="detail-address-1" id="detail-address-1"
                                       class="form-control" placeholder="{{ __('auth.Please enter your detailed address here') }}"
                                       value="{{ $createCompany ? $createCompany['address_kr'] : old('address_kr', $exitsMember ? $exitsMember->address_kr : '') }}">
                            </div>
                        </div>
                    </div>

                    @include('frontend.pages.registerMember.category.show-category')
                    <div class="form-group">
                        <div class="form-check">
                            <input autocomplete="off" class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label text-checkout" for="gridCheck">
                                I have read, understand and accept Global's Agree to Terms,
                                <a class="text-policy" href="#">Agree to the Information Collection Policy</a> and
                                <a class="text-policy" href="#">Agree to the Terms of Information Use</a>
                            </label>
                        </div>
                    </div>
                    @php
                        $isUpdate = false;
                        $route = \Illuminate\Support\Facades\Route::currentRouteName();
                        if ($route == 'member.info'){
                            $isUpdate = true;
                        }
                    @endphp
                    @if($isUpdate)
                        <input autocomplete="off" type="text" name="updateInfo" value="abcdef" class="d-none">
                    @endif
                    <button class="d-none" id="btnSubmitFormRegister" type="submit">Done</button>
                    <div class="text-center">
                        <p class="text-center text-danger"
                           id="messageValid">{{ __('auth.Please check email to continue...') }}</p>
                        <button type="button" id="buttonRegister"
                                class="w-50 btn bg-member-primary solid mr-3 btn-register">{{ __('home.next') }}</button>
                    </div>
                </form>
</div>
<script>
    let imgInp = $('#giay_phep_kinh_doanh');

    $(function () {
        var imagesPreview = function (input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function (event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).addClass('w-25').appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        imgInp.on('change', function () {
            $('.imagePreview').empty();
            // imagesPreview(this, 'div.imagePreview');
        });
    });
</script>
<script>
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
    $(document).ready(function () {
        $('#buttonRegister').on('click', function () {
            $('#btnSubmitFormRegister').trigger('click');
        })


        let type_business = $('#type_business');
        let manufacture = $('.manufacture');
        let distributive = $('.distributive');

        type_business.on('change', function () {
            let value = $(this).val();
            if (value == 'distributive') {
                manufacture.addClass('d-none');
                distributive.removeClass('d-none');
            } else {
                distributive.addClass('d-none');
                manufacture.removeClass('d-none');
            }
        })

        let item = type_business.val();
        if (item == 'distributive') {
            manufacture.addClass('d-none');
            distributive.removeClass('d-none');
        } else {
            distributive.addClass('d-none');
            manufacture.removeClass('d-none');
        }

        $("#giay_phep_kinh_doanh").change(function () {
            var filename = this.files[0].name;
            $('#giay_phep_kinh_doanhLabel').text(filename);
        });
    })
</script>
<script>
    let index = 0;
    let buttonRegister = $('#buttonRegister');
    let messageValid = $('#messageValid');

    $(document).ready(function () {
        handleClickBtnAndShowValid(index);

        $('#btnChecking').click(function () {
            handleCheckEmail();
        })
    })

    async function handleCheckEmail() {
        let checkUrl = `{{ route('api.checking.email.all') }}`;
        let email = $('#email').val();
        if (!email) {
            alert('Please enter your email!');
            return;
        }
        await $.ajax({
            url: checkUrl,
            method: 'POST',
            data: {
                email: email
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response, textStatus, jqXHR) {
                if (jqXHR.status === 200) {
                    index = 1;
                    alert(response.message);
                    handleClickBtnAndShowValid(index);
                } else {
                    index = 0;
                    alert(response.message);
                    handleClickBtnAndShowValid(index);
                }
            },
            error: function (error) {
                console.log(error);
                index = 0;
                alert(error.responseJSON.message);
                handleClickBtnAndShowValid(index);
            }
        });
    }

    function handleClickBtnAndShowValid(index) {
        if (index === 0) {
            messageValid.removeClass('d-none');
            buttonRegister.prop('disabled', true);
        } else {
            messageValid.addClass('d-none');
            buttonRegister.prop('disabled', false);
        }
    }
</script>