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

    #code_1 {
        display: none;
        border: 1px #dadada solid;
    }

    #code_1 label {
        display: block;
    }

    #code_1 label:hover {
        background-color: #cccccc;
    }

    #code_2 {
        display: none;
        border: 1px #dadada solid;
    }

    #code_2 label {
        display: block;
    }

    #code_2 label:hover {
        background-color: #cccccc;
    }

    #code_3 {
        display: none;
        border: 1px #dadada solid;
    }

    #code_3 label {
        display: block;
    }

    #code_3 label:hover {
        background-color: #cccccc;
    }

</style>
@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <link href="{{asset('css/voucher.css')}}" rel="stylesheet">
    <div class="container">
        <div class="start-page mb-3">
            <div class="background container pt-3 justify-content-center pb-3">
                <div class="form-title text-center solid-3x pt-2 pb-3 bg-member-green">
                    <div class="title text-primary"
                         style="font-size: 35px; font-weight: 600">{{ __('home.Sign up company information') }}</div>
                </div>
                <div>
                    @if($member->name == \App\Enums\RegisterMember::BUYER)
                        @include('frontend.pages.registerMember.buyer')
                    @else
                        @include('frontend.pages.registerMember.more-member-other')
                    @endif
                    <h2 id="result"></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-address" tabindex="-1" aria-labelledby="modal-addressLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.address') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 65vh; overflow-y: auto">
                    @include('frontend.pages.registerMember.regionAddress')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="r_getListNation()">
                        {{ __('home.Back') }}
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-create-region">{{ __('home.tao moi vi tri') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-create-region" tabindex="-1" aria-labelledby="modal-create-regionLabel"
         aria-hidden="true">
        <form action="{{ route('location.create') }}" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('home.tao moi vi tri') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="continents">{{ __('home.chau luc') }}</label>
                                        <select class="form-control" id="continents" name="continents">
                                            <option value="Asia">{{ __('home.chau a') }}</option>
                                            <option value="Europe">{{ __('home.chau au') }}</option>
                                            <option value="Africa">{{ __('home.chau phi') }}</option>
                                            <option value="Americas">{{ __('home.chau my') }}</option>
                                            <option value="Oceania">{{ __('home.chau dai duong') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="what_create">{{ __('home.cap bac tao') }}</label>
                                        <select class="form-control" id="what_create" name="what_create"
                                                onchange="selectWhatCreate()">
                                            <option value="0">{{ __('home.Nation') }}</option>
                                            <option value="1">{{ __('home.tinh thanh') }}</option>
                                            <option value="2">{{ __('home.quan huyen') }}</option>
                                            <option value="3">{{ __('home.xa phuong') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nation">{{ __('home.Nation') }}</label>
                                        <input type="text" class="form-control" id="nation-input" name="nation-input">
                                        <select class="form-control" id="nation-select" name="nation-select"
                                                onchange="getListState_selectModal(this.value)">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="province">{{ __('home.tinh thanh') }}</label>
                                        <input type="text" class="form-control" id="province-input"
                                               name="province-input">
                                        <select class="form-control" id="province-select" name="province-select"
                                                onchange="getListCity_selectModal(this.value)">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="district">{{ __('home.quan huyen') }}</label>
                                        <input type="text" class="form-control" id="district-input"
                                               name="district-input">
                                        <select class="form-control" id="district-select" name="district-select">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="commune">{{ __('home.xa phuong') }}</label>
                                        <input type="text" class="form-control" id="commune-input" name="commune-input">
                                        <select class="form-control" id="commune-select" name="commune-select">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('home.Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('home.save changes') }}</button>
                    </div>
                </div>
            </div>
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

            $('.inputCheckboxCategory2').on('click', function () {
                let count = document.querySelectorAll('.inputCheckboxCategory2:checked').length
                if (count > 3) {
                    $('.inputCheckboxCategory2:checkbox:not(:checked)').prop('disabled', true);
                } else {
                    $('.inputCheckboxCategory2:checkbox:not(:checked)').prop('disabled', false);
                }
            })

            $('.form-group.address-above').on('click', function () {
                whereSelectRegion = 0;
            });

            $('.form-group.address-below').on('click', function () {
                whereSelectRegion = 1;
            });
        })

        function getDate() {
            let nowTime = new Date().toLocaleDateString('en-GB');
            $('#datetime_register').val(nowTime);
        }

        getDate();
    </script>
    <script>
        var expanded = false, expanded1 = false, expanded2 = false;

        function showCheckboxes() {
            var code_1 = document.getElementById("code_1");
            if (!expanded) {
                window.addEventListener('click', function (e) {
                    var code_1_item = document.getElementById('code_1_item');
                    if (code_1.contains(e.target) || code_1_item.contains(e.target)) {
                        $('#code_1_item').on('click', function () {
                            if (!expanded) {
                                code_1.style.display = "block";
                                expanded = true;
                            } else {
                                code_1.style.display = "none";
                                expanded = false;
                            }
                        });
                    } else {
                        code_1.style.display = "none";
                        expanded = false;
                    }
                })
                code_1.style.display = "block";
                expanded = true;
            } else {
                code_1.style.display = "none";
                expanded = false;
            }
        }

        function showCheckboxes1() {
            var code_3 = document.getElementById("code_3");
            if (!expanded1) {
                window.addEventListener('click', function (e) {
                    let code_3_item = document.getElementById('code_3_item');
                    if (code_3.contains(e.target) || code_3_item.contains(e.target)) {
                        $('#code_3_item').on('click', function () {
                            if (!expanded1) {
                                code_3.style.display = "block";
                                expanded1 = true;
                            } else {
                                code_3.style.display = "none";
                                expanded1 = false;
                            }
                        });
                    } else {
                        code_3.style.display = "none";
                        expanded1 = false;
                    }
                })
                code_3.style.display = "block";
                expanded1 = true;
            } else {
                code_3.style.display = "none";
                expanded1 = false;
            }
        }

        function showCheckboxes2() {
            var code_2 = document.getElementById("code_2");
            if (!expanded2) {
                window.addEventListener('click', function (e) {
                    let code_2_item = document.getElementById('code_2_item');
                    if (code_2.contains(e.target) || code_2_item.contains(e.target)) {
                        $('#code_2_item').on('click', function () {
                            if (!expanded2) {
                                code_2.style.display = "block";
                                expanded2 = true;
                            } else {
                                code_2.style.display = "none";
                                expanded2 = false;
                            }
                        });
                    } else {
                        code_2.style.display = "none";
                        expanded2 = false;
                    }
                })
                code_2.style.display = "block";
                expanded2 = true;
            } else {
                code_2.style.display = "none";
                expanded2 = false;
            }
        }
    </script>
    <script>
        const ID_COUNTRY = 'countries-select'
        const ID_STATE = 'cities-select'
        const ID_CITY = 'provinces-select'
        const ID_WARD = 'wards-select'

        const ID_COUNTRY_1 = 'countries-select-1'
        const ID_STATE_1 = 'cities-select-1'
        const ID_CITY_1 = 'provinces-select-1'
        const ID_WARD_1 = 'wards-select-1'

        const ID_NATION_MODAL_CREATE = 'nation-select'
        const ID_PROVINCE_MODAL_CREATE = 'province-select'
        const ID_DISTRICT_MODAL_CREATE = 'district-select'
        const ID_COMMUNE_MODAL_CREATE = 'commune-select'

        let country_code = ''
        let city_code = ''

        var whereSelectRegion = '';
        getListNation();

        function getListNation() {
            let url = '{{ route('location.nation.get') }}'
            fetch(url)
                .then(async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_COUNTRY)
                    makeHTMLFromJson(data, ID_COUNTRY_1)
                    makeHTMLFromJson(data, ID_NATION_MODAL_CREATE)
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

        function getListState1(id) {
            let url = '{{ route('location.state.get', ['id' => ':id']) }}';
            url = url.replace(':id', id);
            country_code = id;
            fetch(url)
                .then(async function (res) {
                    clearDataOption1();
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_STATE_1)
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
        }

        function clearDataOption1() {
            document.getElementById(ID_STATE_1).innerHTML = '';
            document.getElementById(ID_CITY_1).innerHTML = '';
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
        selectWhatCreate();

        function selectWhatCreate() {
            let what = document.getElementById('what_create').value;
            const arrInput = ['nation-input', 'province-input', 'district-input', 'commune-input'];
            const arrSelect = ['nation-select', 'province-select', 'district-select', 'commune-select'];

            for (let i = 0; i < arrSelect.length; i++) {
                const itemInput = arrInput[i];
                const itemSelect = arrSelect[i];

                // check hiển thị select hoặc input tùy theo đang tạo cái gì
                if (i > what) {
                    document.getElementById(itemInput).disabled = true;
                    document.getElementById(itemInput).style.display = 'block';
                    document.getElementById(itemInput).required = false;

                    document.getElementById(itemSelect).style.display = 'none';
                    document.getElementById(itemSelect).required = false;
                } else if (i == what) {
                    document.getElementById(itemInput).disabled = false;
                    document.getElementById(itemInput).style.display = 'block';
                    document.getElementById(itemInput).required = true;

                    document.getElementById(itemSelect).style.display = 'none';
                } else {
                    document.getElementById(itemInput).disabled = false;
                    document.getElementById(itemInput).style.display = 'none';
                    document.getElementById(itemInput).required = false;

                    document.getElementById(itemSelect).style.display = 'block';
                    document.getElementById(itemSelect).required = true;
                }
            }
        }

        function getListState_selectModal(id) {
            let url = '{{ route('location.state.get', ['id' => ':id']) }}';
            url = url.replace(':id', id);
            country_code = id;
            fetch(url)
                .then(async function (res) {
                    clearDataOption1();
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_PROVINCE_MODAL_CREATE)
                });
        }

        function getListCity_selectModal(id) {
            let url = '{{ route('location.city.get', ['id' => ':id', 'code' => ':code']) }}';
            url = url.replace(':id', id);
            url = url.replace(':code', country_code);
            fetch(url)
                .then(async function (res) {
                    const data = await res.json();
                    makeHTMLFromJson(data, ID_DISTRICT_MODAL_CREATE)
                });
        }

        function getListWard_selectModal(id) {
            {{--let url = '{{ route('location.ward.get', ['id' => ':id', 'code' => ':code']) }}';--}}
            {{--url = url.replace(':id', id);--}}
            {{--url = url.replace(':code', country_code);--}}
            {{--fetch(url)--}}
            {{--    .then(async function (res) {--}}
            {{--        const data = await res.json();--}}
            {{--        makeHTMLFromJson(data, ID_WARD_1)--}}
            {{--    });--}}
        }


    </script>
@endsection



