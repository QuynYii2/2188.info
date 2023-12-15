<style>
    #tableMemberOther th, #tableMemberOther td {
        vertical-align: middle !important;
    }

    #tableMemberOther th {
        width: 150px;
    }

    #tableMemberOther td {
        width: 500px;
    }
</style>
@php
    $createCompany = null;
    if(session('createCompany')){
          $createCompany =  session('createCompany');
    }

@endphp
<div class="">
        @if(isset($isAdminUpdate))
            <form class="form_memberInfo" action="{{route('admin.edit.users.company', $isAdminUpdate->id)}}" method="post" id="formRegisterMember">
                @csrf
                @method('PUT')
        @else
            <form class="form_memberInfo" action="{{route('register.member.info')}}" method="post" id="formRegisterMember">
                @csrf
        @endif
            @isset($isAdminUpdate)
                <input type="text" class="d-none" name="updateCheck" value="updateCheck">
            @endisset
            <input type="text" class="d-none" name="member_id" value="{{ $member->id }}">
            <input type="text" class="d-none" name="member" value="{{ ($member->name) }}">
            <div class="d-none" id="text-category">{{ __('home.Select the applicable category') }}</div>
        <div class="day_register title-input">{{ __('home.Day register') }}: <span id="formattedDate"></span></div>
        <div class="form-group">
            <label for="number_clearance" class="label_form">{{ __('home.Number clearance')}} <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="number_clearance" name="number_clearance"
                   value="{{ $createCompany ? $createCompany['number_clearance'] : old('number_clearance', $exitsMember ? $exitsMember->number_clearance: '') }}"
                   placeholder="{{ __('home.Customs clearance number (enter numbers only)')}}" required>
        </div>
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
                <input type="number" class="form-control" id="number_business"
                       value="{{ $createCompany ? $createCompany['number_business'] : old('number_business', $exitsMember ? $exitsMember->number_business :'') }}"
                       name="number_business" placeholder="{{ __('home.Business registration number') }}" required>
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
            <label id="giay_phep_kinh_doanhLabel" for="giay_phep_kinh_doanh"
                   class="upload-item-input d-flex justify-content-between">
                <div class="upload-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61" viewBox="0 0 60 61" fill="none">
                        <path d="M30 13V48M12.5 30.5H47.5" stroke="#929292" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </label>
            <input type="file" class="form-control" id="giay_phep_kinh_doanh" accept="image/*"
                   style="visibility:hidden;"
                   name="giay_phep_kinh_doanh" {{ $exitsMember ? '' : 'required' }}">
            @if($exitsMember)
                <img src="{{ asset('storage/'.$exitsMember->giay_phep_kinh_doanh) }}" alt="" width="60px"
                     height="60px">
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
                <div class="form-group col-md-4 address-below" data-toggle="modal" data-target="#modal-address">
                    <input type="text" readonly class="form-control" id="countries-select-1"
                           placeholder="{{ __('home.Select country') }}"
                           name="countries-select-1">
                </div>
                <div class="form-group col-md-4 address-below" data-toggle="modal" data-target="#modal-address">
                    <input type="text" readonly class="form-control" id="cities-select-1"
                           placeholder="{{ __('home.Choose the city') }}"
                           name="cities-select-1">
                </div>
                <div class="form-group col-md-4 address-below" data-toggle="modal" data-target="#modal-address">
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
        <div class="label_form">{{ __('home.Business industry') }} <span class="text-danger">*</span></div>
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
                <label for="code_business" class="label_item-member">{{ __('home.Business industry') }}</label>
                <select id="code_business" name="code_business" class="form-control">
                    <option @if($exitsMember)
                                @if($exitsMember->code_business == 'wholesale')
                                    selected
                            @endif
                            @endif class="distributive" value="wholesale">{{ __('home.wholesale') }}</option>
                    <option @if($exitsMember)
                                @if($exitsMember->code_business == 'retail')
                                    selected
                            @endif
                            @endif class="distributive" value="retail">{{ __('home.retail') }}</option>
                    <option @if($exitsMember)
                                @if($exitsMember->code_business == 'ecommerce')
                                    selected
                            @endif
                            @endif class="distributive" value="ecommerce">{{ __('home.ecommerce') }}</option>
                    <option @if($exitsMember)
                                @if($exitsMember->code_business == 'home shopping')
                                    selected
                            @endif
                            @endif class="distributive" value="home shopping">{{ __('home.home shopping') }}</option>
                    <option @if($exitsMember)
                                @if($exitsMember->code_business == 'commerce')
                                    selected
                            @endif
                            @endif class="distributive" value="commerce">{{ __('home.commerce') }}</option>

                    <option @if($exitsMember)
                                @if($exitsMember->code_business == 'manufacture')
                                    selected
                            @endif
                            @endif class="manufacture d-none" value="manufacture">{{ __('home.manufacture') }}</option>
                    <option @if($exitsMember)
                                @if($exitsMember->code_business == 'assemble')
                                    selected
                            @endif
                            @endif class="manufacture d-none" value="assemble">{{ __('home.assemble') }}</option>
                    <option @if($exitsMember)
                                @if($exitsMember->code_business == 'machining')
                                    selected
                            @endif
                            @endif class="manufacture d-none" value="machining">{{ __('home.machining') }}</option>
                </select>
            </div>
        </div>
        <div class="label_form">{{ __('home.PLU') }} <span class="text-danger">*</span></div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="code_1" class="label_item-member">{{ __('home.1st classification') }} <span
                                class="text-danger">*</span></label>
                    <div class="multiselect" style="position: relative">
                        <div class="selectBox" id="code_1_item" onclick="showCheckboxes()">
                            <select>
                                <option id="inputCheckboxCategory">{{ __('home.Select the applicable category') }}</option>
                            </select>
                            <div class="overSelect"></div>
                        </div>
                        @if($exitsMember)
                            @php
                                $listCategory = $exitsMember->category_id;
                                $arrayCategory = explode(',', $listCategory);
                            @endphp
                            <div id="code_1" class="mt-1 checkboxes">
                                @foreach($categories_no_parent as $category)
                                    @foreach($arrayCategory as $item)
                                        @php
                                            $isChecked = false;
                                            if ($category->id == $item){
                                                $isChecked = true;
                                                break;
                                            }
                                        @endphp
                                    @endforeach
                                    <label class="ml-2 d-flex align-items-center" for="code_1-{{$category->id}}">
                                        <input type="checkbox" id="code_1-{{$category->id}}"
                                               name="code_1[]"
                                               value="{{ ($category->id) }}"
                                               {{ $isChecked ? 'checked' : '' }}
                                               class="inputCheckboxCategory mr-2 p-3"/>
                                        <span class="labelCheckboxCategory">
                                                            @if(locationHelper() == 'kr')
                                                <div class="item-text">{{ $category->name_ko }}</div>
                                            @elseif(locationHelper() == 'cn')
                                                <div class="item-text">{{$category->name_zh}}</div>
                                            @elseif(locationHelper() == 'jp')
                                                <div class="item-text">{{$category->name_ja}}</div>
                                            @elseif(locationHelper() == 'vi')
                                                <div class="item-text">{{$category->name_vi}}</div>
                                            @else
                                                <div class="item-text">{{$category->name_en}}</div>
                                            @endif</span>
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <div id="code_1" class="mt-1  checkboxes">
                                @foreach($categories_no_parent as $category)
                                    <label class="ml-2 d-flex align-items-center" for="type_business-{{$category->id}}">
                                        <input type="checkbox" id="type_business-{{$category->id}}"
                                               {{--                                           name="code_1[]"--}}
                                               value="{{ ($category->id) }}"
                                               class="inputCheckboxCategory mr-2 p-3"/>
                                        <span class="labelCheckboxCategory">
                                        @if(locationHelper() == 'kr')
                                                <div class="item-text">{{ $category->name_ko }}</div>
                                            @elseif(locationHelper() == 'cn')
                                                <div class="item-text">{{$category->name_zh}}</div>
                                            @elseif(locationHelper() == 'jp')
                                                <div class="item-text">{{$category->name_ja}}</div>
                                            @elseif(locationHelper() == 'vi')
                                                <div class="item-text">{{$category->name_vi}}</div>
                                            @else
                                                <div class="item-text">{{$category->name_en}}</div>
                                            @endif
                                    </span>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="code_2" class="label_item-member">
                        {{ __('home.2nd classification') }}<span class="text-danger">*</span>
                    </label>
                    <div class="multiselect" style="position: relative">
                        <div class="selectBox" id="code_2_item" onclick="showCheckboxes2()">
                            <select>
                                <option id="inputCheckboxCategory1">{{ __('home.Select the applicable category') }}</option>
                            </select>
                            <div class="overSelect"></div>
                        </div>
                        @if($exitsMember)
                            @php
                                $listCategory = $exitsMember->category_id;
                                $arrayCategory = explode(',', $listCategory);
                            @endphp
                            <input value="{{$listCategory}}" id="inputArrayCategory" class="d-none">
                            <div id="code_2" class="mt-1 checkboxes">

                            </div>
                        @else
                            <div id="code_2" class="mt-1  checkboxes">

                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="code_3" class="label_item-member">
                        {{ __('home.3rd classification') }} <span class="text-danger">*</span>
                    </label>
                    <div class="multiselect" style="position: relative">
                        <div class="selectBox" id="code_3_item" onclick="showCheckboxes1()">
                            <select>
                                <option id="inputCheckboxCategory2">{{ __('home.Select the applicable category') }}</option>
                            </select>
                            <div class="overSelect"></div>
                        </div>
                        @if($exitsMember)
                            @php
                                $listCategory = $exitsMember->category_id;
                                $arrayCategory = explode(',', $listCategory);
                            @endphp
                            <div id="code_3" class="mt-1 checkboxes">

                            </div>
                        @else
                            <div id="code_3" class="mt-1  checkboxes">

                            </div>
                        @endif
                    </div>
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
        <input type="text" name="code_1" class="d-none" id="input_code1">
        <input type="text" name="code_2" class="d-none" id="input_code2">
        <input type="text" name="code_3" class="d-none" id="input_code3">
        <button class="d-none" id="btnSubmitFormRegister" type="submit">Done</button>
        <div class="text-center">
            <button type="button" id="buttonRegister"
                    class="w-50 btn bg-member-primary solid mr-3 btn-register">{{ __('home.next') }}</button>
        </div>
    </form>
</div>
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
            // $('#formRegisterMember').trigger('submit');
            let isChecked = checkCategory('inputCheckboxCategory');
            let isChecked1 = checkCategory('inputCheckboxCategory1');
            let isChecked2 = checkCategory('inputCheckboxCategory2');

            if (isChecked && isChecked1 && isChecked2) {
                $('#btnSubmitFormRegister').trigger('click');
            } else {
                alert('Bạn chưa chọn category');
            }
        })

        function checkCategory(className) {
            let items = document.getElementsByClassName(className);
            let isChecked = Array.from(items).some(item => item.checked);
            return isChecked;
        }

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
            filename = this.files[0].name;
            $('#giay_phep_kinh_doanhLabel').text(filename);
        });

        function removeArray(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax = arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        function getListName(array, items) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].checked) {
                    if (array.length == 0) {
                        array.push(items[i].nextElementSibling.innerText);
                    } else {
                        let name = array.includes(items[i].nextElementSibling.innerText);
                        if (!name) {
                            array.push(items[i].nextElementSibling.innerText);
                        }
                    }
                } else {
                    removeArray(array, items[i].nextElementSibling.innerText)
                }
            }
            return array;
        }

        function checkArray(array, listItems) {
            for (let i = 0; i < listItems.length; i++) {
                if (listItems[i].checked) {
                    if (array.length == 0) {
                        array.push(listItems[i].value);
                    } else {
                        let check = array.includes(listItems[i].value);
                        if (!check) {
                            array.push(listItems[i].value);
                        }
                    }
                } else {
                    removeArray(array, listItems[i].value);
                }
            }
            return array;
        }


        let arrayItem = [];
        let arrayNameCategory = [];
        $('.inputCheckboxCategory').on('click', function () {
            getInput();
        })

        async function getInput() {
            let items = document.getElementsByClassName('inputCheckboxCategory');

            arrayItem = checkArray(arrayItem, items);
            arrayNameCategory = getListName(arrayNameCategory, items)

            let listName = arrayNameCategory.toString();

            if (listName) {
                $('#inputCheckboxCategory').text(listName);
                await renderCategory2(arrayItem);
            } else {
                $('#inputCheckboxCategory').text(`{{ __('home.Select the applicable category') }}`);
            }

            arrayItem.sort();
            let value = arrayItem.toString();
            $('#input_code1').val(value);
        }

        @if($exitsMember)
        getInput();

        @endif
        async function renderCategory2(value) {
            let url = '{{ route('get.category.one.parent') }}';
            console.log( $('#inputArrayCategory').val())
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    listCategoryID: value,
                    arrayCategory: $('#inputArrayCategory').val(),
                    _token: '{{ csrf_token() }}',
                }
            })
                .done(function (response) {
                    $('#code_2').empty().append(response);
                })
                .fail(function (_, textStatus) {

                });
        }
    })
</script>