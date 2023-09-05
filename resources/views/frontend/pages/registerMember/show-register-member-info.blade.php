@extends('frontend.layouts.master')

@section('title', 'Register Member')

<style>

    .image-upload {
        display: inline-block;
        position: relative;
        max-width: 205px;
    }

    .image-upload .image-edit {
        position: absolute;
        z-index: 1;
    }

    .image-upload .image-edit {
        right: -13px;
        top: 10px;
    }

    .image-upload .image-edit input {
        display: none;
    }

    .image-upload .image-edit input + label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #ffffff;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .image-upload .image-edit input + label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .image-upload .image-edit input + label:after {
        content: "\f040";
        font-family: "FontAwesome";
        color: #757575;
        position: absolute;
        top: 10px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .image-upload .preview {
        width: 192px;
        height: 192px;
        position: relative;
        border: 6px solid #f8f8f8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .image-upload .preview > div {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }


    .preview > div,
    .invalid-file {
        display: none;
    }

    .error {
        position: absolute;
        transform: translate(-50%, -50%);
        left: 50%;
        top: 50%;
        width: 100px;
        height: 120px;
        font-size: 1em;
        text-transform: capitalize;
        text-align: center;
        color: #fff;
        line-height: 1em;
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.2);
    }

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
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card border">
                <div class="form-title text-center pt-2">
                    <div class="title">{{ __('home.Sign up for information') }}</div>
                </div>
                <div class="container mt-5">
                    <form class="p-3" action="{{route('register.member.info')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="d-none" name="member_id" value="{{ $member->id }}">
                        <input type="text" class="d-none" name="member" value="{{ ($member->name) }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="datetime_register"> Ngày đăng ký </label>
                                <input type="text" class="form-control" id="datetime_register"
                                       name="datetime_register" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="number_clearance"> Số thông quan </label>
                                <input type="text" class="form-control" id="number_clearance"
                                       value="{{ $exitsMember ? $exitsMember->number_clearance : old('number_clearance') }}"
                                       name="number_clearance">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_en"> Tên công ty Tiếng Anh</label>
                                <input type="text" class="form-control" id="name_en"
                                       value="{{ $exitsMember ? $exitsMember->name_en : old('name_en') }}"
                                       name="name_en" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="name_kr"> Tên công ty Tiếng Hàn</label>
                                <input type="text" class="form-control" id="name_kr"
                                       value="{{ $exitsMember ? $exitsMember->name_kr : old('name_kr') }}"
                                       name="name_kr" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Điện thoại</label>
                                <input type="text" class="form-control" id="phone"
                                       value="{{ $exitsMember ? $exitsMember->phone : old('phone') }}"
                                       name="phone" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax"
                                       value="{{ $exitsMember ? $exitsMember->fax : old('fax') }}"
                                       name="fax">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="number_business">Số đăng ký kinh doanh</label>
                                <input type="text" class="form-control" id="number_business"
                                       value="{{ $exitsMember ? $exitsMember->number_business : old('number_business') }}"
                                       name="number_business" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="giay_phep_kinh_doanh">Giấy phép kinh doanh </label>
                                <input type="file" class="form-control" id="giay_phep_kinh_doanh"
                                       name="giay_phep_kinh_doanh" {{ $exitsMember ? '' : 'required' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="type_business">Ngành nghề kinh doanh</label>
                                <div class="multiselect" style="position: relative">
                                    <div class="selectBox" id="type_business_click" onclick="showCheckboxes1()">
                                        <select>
                                            <option>{{ __('home.Select the applicable category') }}</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    @if($exitsMember)
                                        @php
                                            $listCategory = $exitsMember->type_business;
                                            $arrayCategory = explode(',', $listCategory);
                                        @endphp
                                        <div id="type_business_checkboxes" class="mt-1  checkboxes">
                                            @foreach($categories as $category)
                                                @if(!$category->parent_id)
                                                    @foreach($arrayCategory as $item)
                                                        @php
                                                            $isChecked = false;
                                                            if ($category->id == $item){
                                                                $isChecked = true;
                                                                break;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    <label class="ml-2" for="type_business-{{$category->id}}">
                                                        <input type="checkbox" id="type_business-{{$category->id}}"
                                                               name="type_business-{{$category->id}}"
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
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div id="type_business_checkboxes" class="mt-1  checkboxes">
                                            @foreach($categories as $category)
                                                @if(!$category->parent_id)
                                                    <label class="ml-2" for="type_business-{{$category->id}}">
                                                        <input type="checkbox" id="type_business-{{$category->id}}"
                                                               name="type_business-{{$category->id}}"
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
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-3 register-member">
                                <label for="category">Ngành hàng kinh doanh</label>
                                <div class="multiselect" style="position: relative">
                                    <div class="selectBox" id="div-click" onclick="showCheckboxes()">
                                        <select>
                                            <option>{{ __('home.Select the applicable category') }}</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    @if($exitsMember)
                                        @php
                                            $listCategory = $exitsMember->code_business;
                                            $arrayCategory = explode(',', $listCategory);
                                        @endphp
                                        <div id="checkboxes" class="mt-1  checkboxes">
                                            @foreach($categories as $category)
                                                @if(!$category->parent_id)
                                                    @foreach($arrayCategory as $item)
                                                        @php
                                                            $isChecked = false;
                                                            if ($category->id == $item){
                                                                $isChecked = true;
                                                                break;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    <label class="ml-2" for="category-{{$category->id}}">
                                                        <input type="checkbox" id="category-{{$category->id}}"
                                                               name="category-{{$category->id}}"
                                                               value="{{ ($category->id) }}"
                                                               {{ $isChecked ? 'checked' : '' }}
                                                               class="inputCheckboxCategory1 mr-2 p-3"/>
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
                                                    @if(!$categories->isEmpty())
                                                        @php
                                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                                        @endphp
                                                        @foreach($categories as $child)
                                                            @foreach($arrayCategory as $item)
                                                                @php
                                                                    $isChecked1 = false;
                                                                    if ($child->id == $item){
                                                                        $isChecked1 = true;
                                                                        break;
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                            <label class="ml-4" for="category-{{$child->id}}">
                                                                <input type="checkbox" id="category-{{$child->id}}"
                                                                       name="category-{{$child->id}}"
                                                                       value="{{$child->id}}"
                                                                       {{ $isChecked1 ? 'checked' : '' }}
                                                                       class="inputCheckboxCategory1 mr-2 p-3"/>
                                                                <span class="labelCheckboxCategory">@if(locationHelper() == 'kr')
                                                                        <div class="item-text">{{ $child->name_ko }}</div>
                                                                    @elseif(locationHelper() == 'cn')
                                                                        <div class="item-text">{{$child->name_zh}}</div>
                                                                    @elseif(locationHelper() == 'jp')
                                                                        <div class="item-text">{{$child->name_ja}}</div>
                                                                    @elseif(locationHelper() == 'vi')
                                                                        <div class="item-text">{{$child->name_vi}}</div>
                                                                    @else
                                                                        <div class="item-text">{{$child->name_en}}</div>
                                                                    @endif</span>
                                                            </label>
                                                            @php
                                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                                            @endphp
                                                            @foreach($listChild2 as $child2)
                                                                @foreach($arrayCategory as $item)
                                                                    @php
                                                                        $isChecked2 = false;
                                                                        if ($child2->id == $item){
                                                                            $isChecked2 = true;
                                                                            break;
                                                                        }
                                                                    @endphp
                                                                @endforeach
                                                                <label class="ml-5" for="category-{{$child2->id}}">
                                                                    <input type="checkbox" id="category-{{$child2->id}}"
                                                                           name="category-{{$child2->id}}"
                                                                           value="{{$child2->id}}"
                                                                           {{ $isChecked2 ? 'checked' : '' }}
                                                                           class="inputCheckboxCategory1 mr-2 p-3"/>
                                                                    <span class="labelCheckboxCategory">@if(locationHelper() == 'kr')
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
                                    @else
                                        <div id="checkboxes" class="mt-1  checkboxes">
                                            @foreach($categories as $category)
                                                @if(!$category->parent_id)
                                                    <label class="ml-2" for="category-{{$category->id}}">
                                                        <input type="checkbox" id="category-{{$category->id}}"
                                                               name="category-{{$category->id}}"
                                                               value="{{ ($category->id) }}"
                                                               class="inputCheckboxCategory1 mr-2 p-3"/>
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
                                                    @if(!$categories->isEmpty())
                                                        @php
                                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                                        @endphp
                                                        @foreach($categories as $child)
                                                            <label class="ml-4" for="category-{{$child->id}}">
                                                                <input type="checkbox" id="category-{{$child->id}}"
                                                                       name="category-{{$child->id}}"
                                                                       value="{{$child->id}}"
                                                                       class="inputCheckboxCategory1 mr-2 p-3"/>
                                                                <span class="labelCheckboxCategory">
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
                                                                <label class="ml-5" for="category-{{$child2->id}}">
                                                                    <input type="checkbox" id="category-{{$child2->id}}"
                                                                           name="category-{{$child2->id}}"
                                                                           value="{{$child2->id}}"
                                                                           class="inputCheckboxCategory1 mr-2 p-3"/>
                                                                    <span class="labelCheckboxCategory">@if(locationHelper() == 'kr')
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
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="status_business">Trạng thái công ty</label>
                                <input type="text" class="form-control" id="status_business"
                                       value="{{ $exitsMember ? $exitsMember->name : old('status_business') }}"
                                       name="status_business" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="certify_business">Giấy chứng nhận ngành nghề</label>
                                <input type="file" class="form-control" id="certify_business"
                                       name="certify_business" {{ $exitsMember ? '' : 'required' }}">
                            </div>
                        </div>
                        <h6 class="">Địa chỉ kinh doanh Tiếng Anh:</h6>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="countries-select">{{ __('home.Select country') }}</label>
                                <select class="form-control" id="countries-select" name="countries-select"
                                        onchange="getListState(this.value)" required>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cities-select">{{ __('home.Choose the city') }}</label>
                                <select class="form-control" id="cities-select" name="cities-select"
                                        onchange="getListCity(this.value)">
                                    <option value="">-- {{ __('home.Choose the city') }} --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="provinces-select">{{ __('home.Select district/district') }}</label>
                                <select class="form-control" id="provinces-select" name="provinces-select"
                                        onchange="getListWard(this.value)">
                                    <option value="">-- {{ __('home.Select district/district') }} --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address_en">Địa chỉ chi tiết</label>
                                <input type="text" name="address_en" id="address_en" class="form-control" required
                                       value="{{ $exitsMember ? $exitsMember->address_en : old('address_en') }}">
                            </div>
                        </div>
                        <h6 class="">Địa chỉ kinh doanh Tiếng Hàn:</h6>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="countries-select-1">{{ __('home.Select country') }}</label>
                                <select class="form-control" id="countries-select-1" name="countries-select-1"
                                        onchange="getListState1(this.value)" required>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cities-select-1">{{ __('home.Choose the city') }}</label>
                                <select class="form-control" id="cities-select-1" name="cities-select-1"
                                        onchange="getListCity1(this.value)">
                                    <option value="">-- {{ __('home.Choose the city') }} --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="provinces-select-1">{{ __('home.Select district/district') }}</label>
                                <select class="form-control" id="provinces-select-1" name="provinces-select-1"
                                        onchange="getListWard1(this.value)">
                                    <option value="">-- {{ __('home.Select district/district') }} --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address_kr"> Địa chỉ chi tiết</label>
                                <input type="text" name="address_kr" id="address_kr" class="form-control" required
                                       value="{{ $exitsMember ? $exitsMember->address_kr : old('address_kr') }}">
                            </div>
                        </div>
                        <h6 class="">Mã hàng:</h6>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="code_1">Phân loại lần 1</label>
                                <input type="text" class="form-control" id="code_1"
                                       value="{{ $exitsMember ? $exitsMember->code_1 : old('code_1') }}"
                                       name="code_1" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="code_2">Phân loại lần 3</label>
                                <input type="text" class="form-control" id="code_2"
                                       value="{{ $exitsMember ? $exitsMember->code_2 : old('code_2') }}"
                                       name="code_2" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="code_3">Phân loại lần 3</label>
                                <input type="text" class="form-control" id="code_3"
                                       value="{{ $exitsMember ? $exitsMember->code_3 : old('code_3') }}"
                                       name="code_3" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="code_4">Phân loại lần 4</label>
                                <input type="text" class="form-control" id="code_4"
                                       value="{{ $exitsMember ? $exitsMember->code_4 : old('code_4') }}"
                                       name="code_4" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('home.sign up') }}</button>
                    </form>
                    <h2 id="result"></h2>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            let nowTime = new Date().toLocaleString();
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
                    autoSelectedOption(ID_WARD)
                });
        }

        function getListWard(id) {
            let url = '{{ route('location.ward.get', ['id' => ':id', 'code' => ':code']) }}';
            url = url.replace(':id', id);
            url = url.replace(':code', country_code);
            fetch(url)
                .then(async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_WARD)
                });
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
                    clearDataOption();
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
                    autoSelectedOption(ID_WARD_1)
                });
        }

        function getListWard1(id) {
            let url = '{{ route('location.ward.get', ['id' => ':id', 'code' => ':code']) }}';
            url = url.replace(':id', id);
            url = url.replace(':code', country_code);
            fetch(url)
                .then(async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_WARD_1)
                });
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
            document.getElementById(ID_WARD).innerHTML = '';
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

    {{--    <script>--}}
    {{--        $(function () {--}}
    {{--            "use strict";--}}

    {{--            // Hide URL/FileReader API requirement message in capable browsers:--}}
    {{--            if (--}}
    {{--                window.createObjectURL ||--}}
    {{--                window.URL ||--}}
    {{--                window.webkitURL ||--}}
    {{--                window.FileReader--}}
    {{--            ) {--}}
    {{--                $(".browser").hide();--}}
    {{--                $(".preview").children().show();--}}
    {{--            }--}}

    {{--            function isDataURL(s) {--}}
    {{--                return !!s.match(isDataURL.regex);--}}
    {{--            }--}}

    {{--            isDataURL.regex = /^\s*data:([a-z]+\/[a-z]+(;[a-z\-]+\=[a-z\-]+)?)?(;base64)?,[a-z0-9\!\$\&\'\,\(\)\*\+\,\;\=\-\.\_\~\:\@\/\?\%\s]*\s*$/i;--}}

    {{--            function readURL(input) {--}}
    {{--                if (input.files && input.files[0]) {--}}
    {{--                    var reader = new FileReader();--}}
    {{--                    var preview = $(input).data("preview");--}}
    {{--                    var _invalid = $(input).parent().parent().find(".invalid-file");--}}

    {{--                    reader.onload = function (e) {--}}
    {{--                        if (isDataURL(e.target.result)) {--}}
    {{--                            _invalid.hide();--}}
    {{--                            $("#" + preview).css(--}}
    {{--                                "background-image",--}}
    {{--                                "url(" + e.target.result + ")"--}}
    {{--                            );--}}
    {{--                            $("#" + preview).hide();--}}
    {{--                            $("#" + preview).fadeIn(650);--}}
    {{--                        } else {--}}
    {{--                            $("#" + preview).hide();--}}

    {{--                            _invalid.html(--}}
    {{--                                '<div class="alert alert-danger"><strong>Error!</strong> Invalid image file.</div>'--}}
    {{--                            );--}}
    {{--                            _invalid.show();--}}
    {{--                        }--}}
    {{--                    };--}}

    {{--                    reader.readAsDataURL(input.files[0]);--}}
    {{--                }--}}
    {{--            }--}}

    {{--            $(".imageUpload").bind("change", function (e) {--}}
    {{--                e.preventDefault();--}}

    {{--                readURL(this);--}}
    {{--            });--}}
    {{--        });--}}

    {{--    </script>--}}
    {{--    <script>--}}
    {{--        window.onbeforeunload = function (e) {--}}
    {{--            var y = window.event.clientY;--}}
    {{--            if (y < 0) {--}}
    {{--                return 'Window closed';--}}
    {{--            }--}}
    {{--            else {--}}
    {{--                return 'Window refreshed';--}}
    {{--            }--}}
    {{--        };--}}
    {{--    </script>--}}
@endsection



