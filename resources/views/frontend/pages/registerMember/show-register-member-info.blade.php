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
            <div class="form-title text-center pt-2">
                <div class="title">{{ __('home.Sign up for information') }}</div>
            </div>
            <div class="mt-4">
                @if($member->name == \App\Enums\RegisterMember::BUYER)
                    @include('frontend.pages.registerMember.buyer')
                @else
                    @include('frontend.pages.registerMember.more-member-other')
                @endif
                <h2 id="result"></h2>
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



