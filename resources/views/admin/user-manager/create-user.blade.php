@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
<link rel="stylesheet" href="{{asset('css/register_member.css')}}">
<link href="{{asset('css/voucher.css')}}" rel="stylesheet">
<style>
    #type_business_checkboxes {
        display: none;
        border: 1px #dadada solid;
    }

    #type_business_checkboxes label {
        display: block;
    }

    #type_business_checkboxes label:hover {
        background-color: #cccccc;
    }

</style>
@section('content')
    <h3 class="text-center">Create User</h3>
    <div class="container">
        <form method="post" action="{{route('admin.create.users')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="datetime_register"> {{ __('home.Day register') }}: </label>
                    <input type="text" class="form-control" id="datetime_register"
                           name="datetime_register" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="number_clearance"> {{ __('home.Number clearance') }}: </label>
                    <input type="text" class="form-control" id="number_clearance"
                           name="number_clearance">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name_en">{{ __('home.Name English') }}:</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">{{ __('home.Name Korea') }}:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="code">{{ __('home.ID') }} :</label>
                    <input type="text" class="form-control" id="code" name="code" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="password">{{ __('home.Password') }}:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="passwordConfirm">{{ __('home.Password') }}{{ __('home.Confirm') }}:</label>
                    <input type="password" class="form-control" id="passwordConfirm"
                           name="passwordConfirm"
                           required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="phoneNumber">{{ __('home.phone number') }}:</label>
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                           required>
                </div>
                <div class="form-group col-md-4">
                    <label for="email">{{ __('home.email') }}:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="sns_account">{{ __('home.SNS Account') }}:</label>
                    <input type="text" class="form-control" id="sns_account" name="sns_account" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="type_business">{{ __('home.Career') }} :</label>
                    <div class="multiselect" style="position: relative">
                        <div class="selectBox" style="position: relative" id="type_business_click"
                             onclick="showCheckboxes1()">
                            <select>
                                <option>{{ __('home.Select the applicable category') }}</option>
                            </select>
                            <div class="overSelect"></div>
                        </div>
                        <div id="type_business_checkboxes" class="mt-1 checkboxes">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    <label class="ml-2 d-flex align-items-center" for="type_business-{{$category->id}}">
                                        <input type="checkbox" id="type_business-{{$category->id}}"
                                               name="type_business[]"
                                               value="{{ ($category->id) }}"
                                               class="inputCheckboxCategory mr-2 p-3"/>
                                        <span class="labelCheckboxCategory ">
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
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-6 register-member">
                    <label for="category">{{ __('home.Business') }} :</label>
                    <div class="multiselect" style="position: relative">
                        <div class="selectBox" style="position: relative" id="div-click" onclick="showCheckboxes()">
                            <select>
                                <option>{{ __('home.Select the applicable category') }}</option>
                            </select>
                            <div class="overSelect"></div>
                        </div>
                        <div id="checkboxes" class="mt-1  checkboxes">
                            @foreach($categories as $category)
                                @if(!$category->parent_id)
                                    <label class="ml-2 d-flex align-items-center" for="category-{{$category->id}}">
                                        <input type="checkbox" id="category-{{$category->id}}"
                                               name="category[]"
                                               value="{{ ($category->id) }}"
                                               class="inputCheckboxCategory1 mr-2 p-3"/>
                                        <span class="labelCheckboxCategory ">
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
                                    @if(!$categories->isEmpty())
                                        @php
                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                        @endphp
                                        @foreach($categories as $child)
                                            <label class="ml-4 d-flex align-items-center "
                                                   for="category-{{$child->id}}">
                                                <input type="checkbox" id="category-{{$child->id}}"
                                                       name="category[]"
                                                       value="{{$child->id}}"
                                                       class="inputCheckboxCategory1 mr-2 p-3"/>
                                                <span class="labelCheckboxCategory ">
                                                                    @if(locationHelper() == 'kr')
                                                        <div class="item-text">{{ $child->name_ko }}</div>
                                                    @elseif(locationHelper() == 'cn')
                                                        <div class="item-text">{{$child->name_zh}}</div>
                                                    @elseif(locationHelper() == 'jp')
                                                        <div class="item-text">{{$child->name_ja}}</div>
                                                    @elseif(locationHelper() == 'vi')
                                                        <div class="item-text">{{$child->name_vi}}</div>
                                                    @else
                                                        <div class="item-text">{{$child->name_en}}</div>
                                                    @endif
                                                                </span>
                                            </label>
                                            @php
                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                            @endphp
                                            @foreach($listChild2 as $child2)
                                                <label class="ml-5 d-flex align-items-center"
                                                       for="category-{{$child2->id}}">
                                                    <input type="checkbox" id="category-{{$child2->id}}"
                                                           name="category[]"
                                                           value="{{$child2->id}}"
                                                           class="inputCheckboxCategory1 mr-2 p-3"/>
                                                    <span class="labelCheckboxCategory ">@if(locationHelper() == 'kr')
                                                            <div class="item-text">{{ $child2->name_ko }}</div>
                                                        @elseif(locationHelper() == 'cn')
                                                            <div class="item-text">{{$child2->name_zh}}</div>
                                                        @elseif(locationHelper() == 'jp')
                                                            <div class="item-text">{{$child2->name_ja}}</div>
                                                        @elseif(locationHelper() == 'vi')
                                                            <div class="item-text">{{$child2->name_vi}}</div>
                                                        @else
                                                            <div class="item-text">{{$child2->name_en}}</div>
                                                        @endif</span>
                                                </label>
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="region">Region</label>
                    <select id="region" class="form-control" name="region">
                        <option value="kr">Korea</option>
                        <option value="cn">China</option>
                        <option value="jp">Japan</option>
                        <option value="vi">VietNam</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="gender">Gender</label>
                    <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">
                </div>
                <div class="form-group col-md-3">
                    <label for="date_of_birth">Birthday</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                           placeholder="Birthday">
                </div>
                <div class="form-group col-md-3">
                    <label for="type_account">TypeAccount</label>
                    <select id="type_account" class="form-control" name="type_account">
                        <option value="personal">Personal</option>
                        <option value="business">Business</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="image">Avatar</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <div class="form-group col-md-3">
                    <label for="status">Status</label>
                    <select id="status" class="form-control" name="status">
                        <option value="{{\App\Enums\UserStatus::ACTIVE}}">{{\App\Enums\UserStatus::ACTIVE}}</option>
                        <option value="{{\App\Enums\UserStatus::INACTIVE}}">{{\App\Enums\UserStatus::INACTIVE}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="member">Member</label>
                    <select id="member" class="form-control" name="member">
                        @if($members->isNotEmpty())
                            @foreach($members as $member)
                                @if($member->name == \App\Enums\RegisterMember::BUYER)
                                    <option value="{{$member->id}}">{{$member->name}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="role">Role</label>
                    <select id="role" class="form-control" name="role">
                        <option value="BUYER">BUYER</option>
                        {{--                        <option disabled value="SELLER">SELLER</option>--}}
                        {{--                        <option disabled value="SELLER">ADMIN</option>--}}
                    </select>
                </div>
            </div>
            <h6 class="">{{ __('home.Address English') }}:</h6>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="countries-select">{{ __('home.Select country') }}:</label>
                    <select class="form-control" id="countries-select" name="countries-select"
                            onchange="getListState(this.value)">
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="cities-select">{{ __('home.Choose the city') }}:</label>
                    <select class="form-control" id="cities-select" name="cities-select"
                            onchange="getListCity(this.value)">
                        <option value="">-- {{ __('home.Choose the city') }} --</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="provinces-select">{{ __('home.Select district/district') }}:</label>
                    <select class="form-control" id="provinces-select" name="provinces-select"
                            onchange="getListWard(this.value)">
                        <option value="">-- {{ __('home.Select district/district') }} --</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="address_en">{{ __('home.Address detail') }}:</label>
                    <input type="text" name="address_en" id="address_en" class="form-control" required>
                </div>
            </div>
            <h6 class="">{{ __('home.Address Korea') }}:</h6>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="countries-select-1">{{ __('home.Select country') }}:</label>
                    <select class="form-control" id="countries-select-1" name="countries-select-1"
                            onchange="getListState1(this.value)">
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="cities-select-1">{{ __('home.Choose the city') }}:</label>
                    <select class="form-control" id="cities-select-1" name="cities-select-1"
                            onchange="getListCity1(this.value)">
                        <option value="">-- {{ __('home.Choose the city') }} --</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="provinces-select-1">{{ __('home.Select district/district') }}:</label>
                    <select class="form-control" id="provinces-select-1" name="provinces-select-1"
                            onchange="getListWard1(this.value)">
                        <option value="">-- {{ __('home.Select district/district') }} --</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="address_kr"> {{ __('home.Address detail') }}:</label>
                    <input type="text" name="address_kr" id="address_kr" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('.inputCheckboxCategory').on('click', function () {
                let count = document.querySelectorAll('.inputCheckboxCategory:checked').length
                if (count > 3) {
                    $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', true);
                } else {
                    $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', false);
                }
            })

            $('.inputCheckboxCategory1').on('click', function () {
                let count = document.querySelectorAll('.inputCheckboxCategory1:checked').length
                if (count > 3) {
                    $('.inputCheckboxCategory1:checkbox:not(:checked)').prop('disabled', true);
                } else {
                    $('.inputCheckboxCategory1:checkbox:not(:checked)').prop('disabled', false);
                }
            })
        })

        function getDate() {
            let nowTime = new Date().toLocaleDateString('en-GB');
            $('#datetime_register').val(nowTime);
        }

        getDate();
    </script>
    <script>
        var expanded = false;

        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                window.addEventListener('click', function (e) {
                    var div = document.getElementById('div-click');
                    if (checkboxes.contains(e.target) || div.contains(e.target)) {
                        $('#div-click').on('click', function () {
                            if (!expanded) {
                                checkboxes.style.display = "block";
                                expanded = true;
                            } else {
                                checkboxes.style.display = "none";
                                expanded = false;
                            }
                        });
                    } else {
                        checkboxes.style.display = "none";
                        expanded = false;
                    }
                })
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        }

        var expanded1 = false;

        function showCheckboxes1() {
            var checkboxes1 = document.getElementById("type_business_checkboxes");
            if (!expanded) {
                window.addEventListener('click', function (e) {
                    let div = document.getElementById('type_business_click');
                    if (checkboxes1.contains(e.target) || div.contains(e.target)) {
                        $('#type_business_click').on('click', function () {
                            if (!expanded) {
                                checkboxes1.style.display = "block";
                                expanded = true;
                            } else {
                                checkboxes1.style.display = "none";
                                expanded = false;
                            }
                        });
                    } else {
                        checkboxes1.style.display = "none";
                        expanded = false;
                    }
                })
                checkboxes1.style.display = "block";
                expanded = true;
            } else {
                checkboxes1.style.display = "none";
                expanded = false;
            }
        }

        const ID_COUNTRY = 'countries-select'
        const ID_STATE = 'cities-select'
        const ID_CITY = 'provinces-select'
        const ID_WARD = 'wards-select'

        const ID_COUNTRY_1 = 'countries-select-1'
        const ID_STATE_1 = 'cities-select-1'
        const ID_CITY_1 = 'provinces-select-1'
        const ID_WARD_1 = 'wards-select-1'

        let country_code = ''
        let city_code = ''
        getListNation();
        getListNation1();

        function getListNation() {
            let url = '{{ route('location.nation.get') }}'
            fetch(url)
                .then(async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_COUNTRY)
                    autoSelectedOption(ID_STATE)
                });
        }

        function getListState(id) {
            let url = '{{ route('location.state.get', ['id' => ':id']) }}';
            url = url.replace(':id', id);
            country_code = id;
            fetch(url)
                .then(async function (res) {
                    clearDataOption();
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_STATE)
                    autoSelectedOption(ID_CITY)
                });
        }

        function getListCity(id) {
            let url = '{{ route('location.city.get', ['id' => ':id', 'code' => ':code']) }}';
            url = url.replace(':id', id);
            url = url.replace(':code', country_code);
            fetch(url)
                .then(async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_CITY)
                    // autoSelectedOption(ID_WARD)
                });
        }

        function getListWard(id) {
            {{--let url = '{{ route('location.ward.get', ['id' => ':id', 'code' => ':code']) }}';--}}
            {{--url = url.replace(':id', id);--}}
            {{--url = url.replace(':code', country_code);--}}
            {{--fetch(url)--}}
            {{--    .then(async function (res) {--}}
            {{--        const data = await res.json();--}}
            {{--        makeHTMLFromJson(data, ID_WARD)--}}
            {{--    });--}}
        }

        function getListNation1() {
            let url = '{{ route('location.nation.get') }}'
            fetch(url)
                .then(async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_COUNTRY_1)
                    autoSelectedOption(ID_STATE_1)
                });
        }

        function getListState1(id) {
            let url = '{{ route('location.state.get', ['id' => ':id']) }}';
            url = url.replace(':id', id);
            country_code = id;
            fetch(url)
                .then(async function (res) {
                    clearDataOption1();
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_STATE_1)
                    autoSelectedOption(ID_CITY_1)
                });
        }

        function getListCity1(id) {
            let url = '{{ route('location.city.get', ['id' => ':id', 'code' => ':code']) }}';
            url = url.replace(':id', id);
            url = url.replace(':code', country_code);
            fetch(url)
                .then(async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_CITY_1)
                    // autoSelectedOption(ID_WARD_1)
                });
        }

        function getListWard1(id) {
            {{--let url = '{{ route('location.ward.get', ['id' => ':id', 'code' => ':code']) }}';--}}
            {{--url = url.replace(':id', id);--}}
            {{--url = url.replace(':code', country_code);--}}
            {{--fetch(url)--}}
            {{--    .then(async function (res) {--}}
            {{--        const data = await res.json();--}}
            {{--        makeHTMLFromJson(data, ID_WARD_1)--}}
            {{--    });--}}
        }

        function makeHTMLFromJson(data, id_where) {
            const selectElement = document.getElementById(id_where);
            selectElement.innerHTML = '';


            data.forEach(option => {
                const optionElement = document.createElement('option');

                optionElement.value = getValueForOption(option);

                optionElement.textContent = option.name;

                selectElement.appendChild(optionElement);
            })
        }

        function clearDataOption() {
            document.getElementById(ID_STATE).innerHTML = '';
            document.getElementById(ID_CITY).innerHTML = '';
            // document.getElementById(ID_WARD).innerHTML = '';
        }

        function clearDataOption1() {
            document.getElementById(ID_STATE_1).innerHTML = '';
            document.getElementById(ID_CITY_1).innerHTML = '';
            // document.getElementById(ID_WARD_1).innerHTML = '';
        }

        function autoSelectedOption(id_where) {
            const optionSelect = document.getElementById(id_where);
            if (optionSelect.options.length > 0) {
                optionSelect.options[0].selected = true;
            }
        }

        function getValueForOption(option) {
            if (option.iso2) {
                return option.iso2;
            }
            if (option.city_code) {
                return option.city_code
            }
            if (option.state_code) {
                return option.state_code
            }
            return option.id;
        }

    </script>
@endsection
