@php
    $createCompany = null;
    if(session('createCompany')){
          $createCompany =  session('createCompany');
    }

@endphp
<div class="">
    @if(isset($isAdminUpdate))
        <form class="form_memberInfo" action="{{route('admin.edit.users.company', $isAdminUpdate->id)}}" method="post"
              id="formRegisterMember">
            @csrf
            @method('PUT')
            @else
                <form class="form_memberInfo" action="{{route('register.member.info')}}" method="post"
                      id="formRegisterMember" enctype="multipart/form-data">
                    @csrf
                    @endif
                    @isset($isAdminUpdate)
                        <input type="text" class="d-none" name="updateCheck" value="updateCheck">
                    @endisset
                    <input type="text" class="d-none" name="member_id" value="{{ $member->id }}">
                    <input type="text" class="d-none" name="member" value="{{ ($member->name) }}">
                    <div class="d-none" id="text-category">{{ __('home.Select the applicable category') }}</div>
                    <div class="day_register title-input">{{ __('home.Day register') }}: <span
                                id="formattedDate"></span></div>
                    @if($member->name == \App\Enums\RegisterMember::LOGISTIC)
                        <div class="form-group">
                            <label for="number_clearance" class="label_form">{{ __('home.Number clearance')}} <span
                                        class="text-danger">*</span></label>
                            <div class="d-flex">
                                <input type="number" class="form-control col-6" id="number_clearance"
                                       name="number_clearance"
                                       value="{{ $createCompany ? $createCompany['number_clearance'] : old('number_clearance', $exitsMember ? $exitsMember->number_clearance: '') }}"
                                       placeholder="{{ __('home.Customs clearance number (enter numbers only)')}}"
                                       required>
                                <div class="col-6">
                                    <a href="https://unipass.customs.go.kr/csp/persIndex.do"
                                       class="border-radius-8 w-100 btn bg-member-primary solid btn-register">{{ __('home.Get a customs clearance number') }}</a>
                                </div>
                            </div>

                        </div>
                    @endif

                    <label for="email" class="label_form">{{ __('home.company information') }} <span
                                class="text-danger">*</span></label>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="name_en" name="name_en"
                                   value="{{ $createCompany ? $createCompany['name_en'] : old('name_en', $exitsMember ? $exitsMember->name_en : '') }}"
                                   placeholder="{{ __('home.English only') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="name_kr" name="name_kr"
                                   value="{{ $createCompany ? $createCompany['name_kr'] : old('name_kr', $exitsMember ? $exitsMember->name_kr :'') }}"
                                   placeholder="{{ __('home.Name Korea')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="homepage"
                                   value="{{ $createCompany ? $createCompany['homepage'] : old('homepage', $exitsMember ? $exitsMember->homepage : '') }}"
                                   name="homepage" placeholder="{{ __('home.Home') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            @if($member->name == \App\Enums\RegisterMember::TRUST)
                                <input type="number" class="form-control" id="number_business"
                                       value="{{ $createCompany ? $createCompany['number_business'] : old('number_business', $exitsMember ? $exitsMember->number_business :'') }}"
                                       name="number_business" placeholder="Business registration card"
                                       required>
                            @else
                                <input type="number" class="form-control" id="number_business"
                                       value="{{ $createCompany ? $createCompany['number_business'] : old('number_business', $exitsMember ? $exitsMember->number_business :'') }}"
                                       name="number_business"
                                       placeholder="{{ __('home.Business registration number') }}"
                                       required>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" id="phone"
                                   value="{{ $createCompany ? $createCompany['phone'] : old('phone', $exitsMember ? $exitsMember->phone : '') }}"
                                   name="phone" placeholder="{{ __('home.Phone Number') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" id="fax"
                                   value="{{ $createCompany ? $createCompany['fax'] : old('fax', $exitsMember ? $exitsMember->fax :'') }}"
                                   name="fax" placeholder="{{ __('home.Fax') }}">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="email" class="form-control" id="email"
                                   value="{{ $createCompany ? $createCompany['email'] : old('email', $exitsMember ? $exitsMember->email: '') }}"
                                   name="email" placeholder="{{ __('home.email') }}">
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
                        <input type="file" class="form-control" id="giay_phep_kinh_doanh" accept="image/*"
                               style="visibility:hidden;"
                               name="giay_phep_kinh_doanh" {{ $exitsMember ? '' : 'required' }}>
                        @if($exitsMember && $exitsMember->giay_phep_kinh_doanh)
                            <img src="{{ asset('storage/'.$exitsMember->giay_phep_kinh_doanh) }}" alt="" width="60px"
                                 height="60px" id="giay_phep_kinh_doanh_preview">
                        @endif
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
                                   value="{{ $createCompany ? $createCompany['address_en'] : old('address_en', $exitsMember ? $exitsMember->address_en : '') }}">
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
                                       value="{{ $createCompany ? $createCompany['address_kr'] : old('address_kr', $exitsMember ? $exitsMember->address_kr : '') }}">
                            </div>
                        </div>
                    </div>

                    @if($member->name == \App\Enums\RegisterMember::LOGISTIC)
                        <div class="label_form">{{ __('home.Business industry') }} <span class="text-danger">*</span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="type_business" class="label_item-member">{{ __('home.Business') }}</label>
                                <select id="type_business" name="type_business" class="form-control">
                                    <option @if($exitsMember)
                                                @if($exitsMember->type_business == 'distributive')
                                                    selected
                                            @endif
                                            @endif value="distributive">{{ __('home.distributive') }}</option>
                                    <option @if($exitsMember)
                                                @if($exitsMember->type_business == 'manufacture')
                                                    selected
                                            @endif
                                            @endif value="manufacture">{{ __('home.manufacture') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="code_business"
                                       class="label_item-member">{{ __('home.Business industry') }}</label>
                                <select id="code_business" name="code_business" class="form-control">
                                    <option @if($exitsMember)
                                                @if($exitsMember->code_business == 'wholesale')
                                                    selected
                                            @endif
                                            @endif class="distributive"
                                            value="wholesale">
                                        {{ __('home.wholesale') }}
                                    </option>
                                    <option @if($exitsMember)
                                                @if($exitsMember->code_business == 'retail')
                                                    selected
                                            @endif
                                            @endif class="distributive"
                                            value="retail">
                                        {{ __('home.retail') }}
                                    </option>
                                    <option @if($exitsMember)
                                                @if($exitsMember->code_business == 'ecommerce')
                                                    selected
                                            @endif
                                            @endif class="distributive"
                                            value="ecommerce">
                                        {{ __('home.ecommerce') }}
                                    </option>
                                    <option @if($exitsMember)
                                                @if($exitsMember->code_business == 'home shopping')
                                                    selected
                                            @endif
                                            @endif class="distributive"
                                            value="home shopping">
                                        {{ __('home.home shopping') }}
                                    </option>
                                    <option @if($exitsMember)
                                                @if($exitsMember->code_business == 'commerce')
                                                    selected
                                            @endif
                                            @endif class="distributive"
                                            value="commerce">
                                        {{ __('home.commerce') }}
                                    </option>
                                    <option @if($exitsMember)
                                                @if($exitsMember->code_business == 'manufacture')
                                                    selected
                                            @endif
                                            @endif class="manufacture d-none"
                                            value="manufacture">
                                        {{ __('home.manufacture') }}
                                    </option>
                                    <option @if($exitsMember)
                                                @if($exitsMember->code_business == 'assemble')
                                                    selected
                                            @endif
                                            @endif class="manufacture d-none"
                                            value="assemble">
                                        {{ __('home.assemble') }}
                                    </option>
                                    <option @if($exitsMember)
                                                @if($exitsMember->code_business == 'machining')
                                                    selected
                                            @endif
                                            @endif class="manufacture d-none"
                                            value="machining">
                                        {{ __('home.machining') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endif

                    @include('frontend.pages.registerMember.category.show-category')
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
                    @php
                        $isUpdate = false;
                        $route = Route::currentRouteName();
                        if ($route == 'member.info'){
                            $isUpdate = true;
                        }
                    @endphp
                    @if($isUpdate)
                        <input type="text" name="updateInfo" value="abcdef" class="d-none">
                    @endif
                    <button class="d-none" id="btnSubmitFormRegister" type="submit">Done</button>
                    <div class="text-center">
                        <button type="button" id="buttonRegister"
                                class="w-50 btn bg-member-primary solid mr-3 btn-register">{{ __('home.next') }}</button>
                    </div>
                </form>
</div>
<script>
    window.addEventListener('load', function () {
        document.querySelector('input[type="file"]').addEventListener('change', function () {
            if (this.files && this.files[0]) {
                var img = document.querySelector('img');
                img.onload = () => {
                    URL.revokeObjectURL(img.src);  // no longer needed, free memory
                }

                img.src = URL.createObjectURL(this.files[0]); // set src to blob url
            }
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
            var imgFile = `
                           <div class="giay_phep d-flex align-items-center justify-content-center">
                            <img style="width: 130px;" id="myImg" src="#">
                          </div>
                       `;
            // $('#giay_phep_kinh_doanhLabel').find('svg').remove();
            $('.upload-item-input').remove();
            $('.giay_phep').remove();
            $('#giay_phep_kinh_doanhLabel').append(imgFile);
        });
    })
</script>