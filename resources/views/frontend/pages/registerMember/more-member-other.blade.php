<table class="table element-bordered align-middle" align="center">
    <form action="{{route('register.member.info')}}" method="post" id="formRegisterMember">
        @csrf
        <input type="text" class="d-none" name="member_id" value="{{ $member->id }}">
        <input type="text" class="d-none" name="member" value="{{ ($member->name) }}">
        <tbody>
        <tr>
            <th scope="row">
                <label for="datetime_register">{{ __('home.Day register') }}</label>
            </th>
            <td colspan="2">
                <input type="text" class="form-control" id="datetime_register"
                       name="datetime_register" disabled>
            </td>
            <th scope="row">
                <label for="number_clearance">{{ __('home.Number clearance')}}</label>
            </th>
            <td>
                <input type="number" class="form-control" id="number_clearance"
                       value="{{ $exitsMember ? $exitsMember->number_clearance : old('number_clearance') }}"
                       name="number_clearance"
                       placeholder="{{ __('home.Customs clearance number (enter numbers only)')}}">
            </td>
        </tr>
        <tr>
            <th rowspan="4">
                <label>{{ __('home.Company Name') }}</label>
            </th>
            <td>
                <label for="name_en">{{ __('home.English only') }}</label>
            </td>
            <td>
                <input type="text" class="form-control" id="name_en"
                       value="{{ $exitsMember ? $exitsMember->name_kr : old('name_kr') }}"
                       name="name_en" required>
            </td>
            <td>
                <label for="phone">{{ __('home.Phone Number') }}</label>
            </td>
            <td>
                <input type="number" class="form-control" id="phone"
                       value="{{ $exitsMember ? $exitsMember->phone : old('phone') }}"
                       name="phone" placeholder="{{ __('home.Phone Number') }}" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="name_kr">{{ __('home.Name Korea')}}</label>
            </td>
            <td>
                <input type="text" class="form-control" id="name_kr"
                       value="{{ $exitsMember ? $exitsMember->name_kr : old('name_kr') }}"
                       name="name_kr" required>
            </td>
            <td>
                <label for="fax">{{ __('home.Fax') }}</label>
            </td>
            <td>
                <input type="number" class="form-control" id="fax"
                       value="{{ $exitsMember ? $exitsMember->fax : old('fax') }}"
                       name="fax" placeholder="{{ __('home.Fax') }}">
            </td>
        </tr>
        <tr>
            <td>
                <label for="homepage">{{ __('home.Home') }}</label>
            </td>
            <td>
                <input type="text" class="form-control" id="homepage"
                       value="{{ $exitsMember ? $exitsMember->homepage : old('homepage') }}"
                       name="homepage" placeholder="{{ __('home.Home') }}" required>
            </td>
            <td>
                <label for="email">{{ __('home.email') }}</label>
            </td>
            <td>
                <input type="email" class="form-control" id="email"
                       value="{{ $exitsMember ? $exitsMember->email : old('email') }}"
                       name="email" placeholder="{{ __('home.email') }}">
            </td>
        </tr>
        <tr>
            <td>
                <label for="number_business">{{ __('home.Business registration number') }}</label>
            </td>
            <td>
                <input type="number" class="form-control" id="number_business"
                       value="{{ $exitsMember ? $exitsMember->number_business : old('number_business') }}"
                       name="number_business" placeholder="{{ __('home.Business registration number') }}" required>
            </td>
            <td>
                <label for="giay_phep_kinh_doanh"> {{ __('home.giay_phep_kinh_doanh') }} </label>
            </td>
            <td>
                <div>
                    <label id="giay_phep_kinh_doanhLabel" for="giay_phep_kinh_doanh"
                           class="btn btn-outline-secondary">{{ __('home.Select file') }}</label>
                    <input type="file" class="form-control" id="giay_phep_kinh_doanh" accept="image/*"
                           style="visibility:hidden;"
                           name="giay_phep_kinh_doanh" {{ $exitsMember ? '' : 'required' }}">
                </div>
                @if($exitsMember)
                    <img src="{{ asset('storage/'.$exitsMember->giay_phep_kinh_doanh) }}" alt="" width="60px"
                         height="60px">
                @endif
            </td>
        </tr>
        <tr>
            <th rowspan="2">
                <label>{{ __('home.Address Business') }}</label>
            </th>
            <td>
                <label for="detail-address"> {{ __('home.Language English') }} </label>
            </td>
            <td colspan="3">
                <div class="row">
                    <div class="form-group col-md-3 address-above" data-toggle="modal" data-target="#modal-address">
                        <label for="countries-select">{{ __('home.Select country') }}:</label>
                        <input type="text" readonly class="form-control" id="countries-select" name="countries-select">
                    </div>
                    <div class="form-group col-md-3 address-above" data-toggle="modal" data-target="#modal-address">
                        <label for="cities-select">{{ __('home.Choose the city') }}:</label>
                        <input type="text" readonly class="form-control" id="cities-select" name="cities-select"
                        >
                    </div>
                    <div class="form-group col-md-3 address-above" data-toggle="modal" data-target="#modal-address">
                        <label for="provinces-select">{{ __('home.Select district/district') }}:</label>
                        <input type="text" readonly class="form-control" id="provinces-select" name="provinces-select"
                        >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="detail-address">{{ __('home.Address detail') }}:</label>
                        <input type="text" name="detail-address" id="detail-address" class="form-control"
                               value="{{ $exitsMember ? $exitsMember->address_en : old('address_en') }}">
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <label for="detail-address-1"> {{ __('home.Language Local') }} </label>
            </td>
            <td colspan="3">
                <div class="row">
                    <div class="form-group col-md-3 address-below" data-toggle="modal" data-target="#modal-address">
                        <label for="countries-select-1">{{ __('home.Select country') }}:</label>
                        <input type="text" readonly class="form-control" id="countries-select-1"
                               name="countries-select-1">
                    </div>
                    <div class="form-group col-md-3 address-below" data-toggle="modal" data-target="#modal-address">
                        <label for="cities-select-1">{{ __('home.Choose the city') }}:</label>
                        <input type="text" readonly class="form-control" id="cities-select-1" name="cities-select-1">
                    </div>
                    <div class="form-group col-md-3 address-below" data-toggle="modal" data-target="#modal-address">
                        <label for="provinces-select-1">{{ __('home.Select district/district') }}:</label>
                        <input type="text" readonly class="form-control" id="provinces-select-1"
                               name="provinces-select-1">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="address_kr"> {{ __('home.Address detail') }}:</label>
                        <input type="text" name="detail-address-1" id="detail-address-1" class="form-control"
                               value="{{ $exitsMember ? $exitsMember->address_kr : old('address_kr') }}">
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <th>
                <label>{{ __('home.Business industry') }}</label>
            </th>
            <td>
                <label for="type_business">{{ __('home.Business') }}</label>
            </td>
            <td>
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
            </td>
            <td>
                <label for="code_business">{{ __('home.Business industry') }}</label>
            </td>
            <td>
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
            </td>
        </tr>
        <tr>
            <th rowspan="2">
                <label>{{ __('home.PLU') }}</label>
            </th>
            <td>
                <label for="code_1">{{ __('home.1st classification') }}</label>
            </td>
            <td>
                <div class="multiselect" style="position: relative">
                    <div class="selectBox" id="code_1_item" onclick="showCheckboxes()">
                        <select>
                            <option>{{ __('home.Select the applicable category') }}</option>
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
            </td>
            <td>
                <label for="code_3">{{ __('home.3rd classification') }}</label>
            </td>
            <td>
                <div class="multiselect" style="position: relative">
                    <div class="selectBox" id="code_3_item" onclick="showCheckboxes1()">
                        <select>
                            <option>{{ __('home.Select the applicable category') }}</option>
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
            </td>
        </tr>
        <tr>
            <td>
                <label for="code_2">{{ __('home.2nd classification') }}</label>
            </td>
            <td>
                <div class="multiselect" style="position: relative">
                    <div class="selectBox" id="code_2_item" onclick="showCheckboxes2()">
                        <select>
                            <option>{{ __('home.Select the applicable category') }}</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    @if($exitsMember)
                        @php
                            $listCategory = $exitsMember->category_id;
                            $arrayCategory = explode(',', $listCategory);
                        @endphp
                        <input value="{{$arrayCategory}}" id="inputArrayCategory" class="d-none">
                        <div id="code_2" class="mt-1 checkboxes">

                        </div>
                    @else
                        <div id="code_2" class="mt-1  checkboxes">

                        </div>
                    @endif
                </div>
            </td>
            <td colspan="2">
            </td>
        </tr>
        <tr class="">
            <td colspan="6" class="text-center">
                <button type="button" id="buttonRegister"
                        class="btn bg-member-green solid mr-3 btn-register">{{ __('home.next') }}</button>
            </td>
        </tr>
        </tbody>
        <input type="text" name="code_1" class="d-none" id="input_code1">
        <input type="text" name="code_2" class="d-none" id="input_code2">
        <input type="text" name="code_3" class="d-none" id="input_code3">
        <button class="d-none" id="btnSubmitFormRegister" type="submit">Done</button>
    </form>
</table>
<script>
    $(document).ready(function () {
        $('#buttonRegister').on('click', function () {
            handleAfterSelectRegion();
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


        let arrayItem = [];
        $('.inputCheckboxCategory').on('click', function () {
            let items = document.getElementsByClassName('inputCheckboxCategory');
            for (let i = 0; i < items.length; i++) {
                if (items[i].checked) {
                    if (arrayItem.length == 0) {
                        arrayItem.push(items[i].value);
                    } else {
                        let check = arrayItem.includes(items[i].value);
                        if (!check) {
                            arrayItem.push(items[i].value);
                        }
                    }
                } else {
                    removeArray(arrayItem, items[i].value);
                }
            }
            renderCategory2(arrayItem);
            arrayItem.sort();
            let value = arrayItem.toString();
            $('#input_code1').val(value);
        })


        async function renderCategory2(value) {
            let url = '{{ route('get.category.one.parent') }}';

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

