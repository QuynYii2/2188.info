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

</style>
@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card border">
                <div class="form-title text-center pt-2">
                    <div class="title">Đăng kí thông tin</div>
                </div>
                <div class="container mt-5">
                    <form class="p-3" action="{{route('register.member.info')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="d-none" name="member_id" value="{{ $member->id }}">
                        <input type="text" class="d-none" name="member" value="{{ ($member->name) }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="form-control" id="companyName"
                                       value="{{ $exitsMember ? $exitsMember->name : old('companyName') }}"
                                       name="companyName" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="codeBusiness">Code Business</label>
                                <input type="text" class="form-control" id="codeBusiness"
                                       value="{{ $exitsMember ? $exitsMember->code_business : old('codeBusiness') }}"
                                       name="codeBusiness"
                                       required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phoneNumber">PhoneNumber</label>
                                <input type="number" class="form-control" id="phoneNumber"
                                       value="{{ $exitsMember ? $exitsMember->phone : old('phoneNumber') }}"
                                       name="phoneNumber" required>
                            </div>
                            <div class="form-group col-md-6 register-member">
                                <label for="category">Category</label>
                                <div class="multiselect" style="position: relative">
                                    <div class="selectBox" id="div-click" onclick="showCheckboxes()">
                                        <select>
                                            <option>Chọn category áp dụng</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    @if($exitsMember)
                                        @php
                                            $listCategory = $exitsMember->category_id;
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
                                                               class="inputCheckboxCategory mr-2 p-3"/>
                                                        <span class="labelCheckboxCategory">{{ ($category->name) }}</span>
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
                                                                       class="inputCheckboxCategory mr-2 p-3"/>
                                                                <span class="labelCheckboxCategory">{{ ($child->name) }}</span>
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
                                                                           class="inputCheckboxCategory mr-2 p-3"/>
                                                                    <span class="labelCheckboxCategory">{{ ($child2->name) }}</span>
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
                                                               class="inputCheckboxCategory mr-2 p-3"/>
                                                        <span class="labelCheckboxCategory">{{ ($category->name) }}</span>
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
                                                                       class="inputCheckboxCategory mr-2 p-3"/>
                                                                <span class="labelCheckboxCategory">{{ ($child->name) }}</span>
                                                            </label>
                                                            @php
                                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                                            @endphp
                                                            @foreach($listChild2 as $child2)
                                                                <label class="ml-5" for="category-{{$child2->id}}">
                                                                    <input type="checkbox" id="category-{{$child2->id}}"
                                                                           name="category-{{$child2->id}}"
                                                                           value="{{$child2->id}}"
                                                                           class="inputCheckboxCategory mr-2 p-3"/>
                                                                    <span class="labelCheckboxCategory">{{ ($child2->name) }}</span>
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
                                <label for="countries-select">Chọn quốc gia:</label>
                                <select class="form-control" id="countries-select" name="countries-select"
                                        onchange="getListState(this.value)" required>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cities-select">Chọn thành phố:</label>
                                <select class="form-control" id="cities-select" name="cities-select"
                                        onchange="getListCity(this.value)">
                                    <option value="">-- Chọn thành phố --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="provinces-select">Chọn quận/huyện:</label>
                                <select class="form-control" id="provinces-select" name="provinces-select"
                                        onchange="getListWard(this.value)">
                                    <option value="">-- Chọn quận/huyện --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="wards-select">Chọn phường/xã:</label>
                                <select class="form-control" name="wards-select" id="wards-select">
                                    <option value="">-- Chọn phường/xã --</option>
                                </select>
                            </div>
                            @php
                                $isValid = false;
                                if ($member->name == \App\Enums\RegisterMember::BUYER){
                                    $isValid = true;
                                }
                            @endphp
                            @if($isValid == false)
                                @if($exitsMember && $exitsMember->giay_phep_kinh_doanh)
                                    <img src="{{asset('storage/'.$exitsMember->giay_phep_kinh_doanh)}}" alt="">
                                @else
                                    <div class="form-group col-md-12">
                                        <div class="image-upload">
                                            <div class="image-edit">
                                                <input type='file' name="giay_phep_kinh_doanh" id="coverUpload"
                                                       class="imageUpload" data-preview="imagePreview" accept="image/*"/>
                                                <label for="coverUpload"></label>
                                            </div>
                                            <div class="preview">
                                                <div id="imagePreview"></div>
                                            </div>
                                            <p class="error browser">
                                                Your browser does not support
                                                <a href="https://developer.mozilla.org/en/DOM/window.URL">URL</a> or
                                                <a href="https://developer.mozilla.org/en/DOM/FileReader">FileReader</a>
                                            </p>
                                            <p class="error invalid-file"></p>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Sign up</button>
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
        })
    </script>
    <script>
        var expanded = false;

        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                window.addEventListener('click', function (e) {
                    var checkboxes = document.getElementById("checkboxes");
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


        const ID_COUNTRY = 'countries-select'
        const ID_STATE = 'cities-select'
        const ID_CITY = 'provinces-select'
        const ID_WARD = 'wards-select'

        let country_code = ''
        let city_code = ''
        getListNation();

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

    <script>
        $(function () {
            "use strict";

            // Hide URL/FileReader API requirement message in capable browsers:
            if (
                window.createObjectURL ||
                window.URL ||
                window.webkitURL ||
                window.FileReader
            ) {
                $(".browser").hide();
                $(".preview").children().show();
            }

            function isDataURL(s) {
                return !!s.match(isDataURL.regex);
            }

            isDataURL.regex = /^\s*data:([a-z]+\/[a-z]+(;[a-z\-]+\=[a-z\-]+)?)?(;base64)?,[a-z0-9\!\$\&\'\,\(\)\*\+\,\;\=\-\.\_\~\:\@\/\?\%\s]*\s*$/i;

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var preview = $(input).data("preview");
                    var _invalid = $(input).parent().parent().find(".invalid-file");

                    reader.onload = function (e) {
                        if (isDataURL(e.target.result)) {
                            _invalid.hide();
                            $("#" + preview).css(
                                "background-image",
                                "url(" + e.target.result + ")"
                            );
                            $("#" + preview).hide();
                            $("#" + preview).fadeIn(650);
                        } else {
                            $("#" + preview).hide();

                            _invalid.html(
                                '<div class="alert alert-danger"><strong>Error!</strong> Invalid image file.</div>'
                            );
                            _invalid.show();
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".imageUpload").bind("change", function (e) {
                e.preventDefault();

                readURL(this);
            });
        });

    </script>
    <script>
        window.onbeforeunload = function (e) {
            var y = window.event.clientY;
            if (y < 0) {
                return 'Window closed';
            }
            else {
                return 'Window refreshed';
            }
        };
    </script>
@endsection



