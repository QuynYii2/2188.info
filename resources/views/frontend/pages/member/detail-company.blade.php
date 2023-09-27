<link rel="stylesheet" href="{{asset('css/register_member.css')}}">
<link href="{{asset('css/voucher.css')}}" rel="stylesheet">

<div class="container-fluid">
    <div class="d-flex">
        <a href="{{route('profile.show')}}" class="btn btn-success mr-3">{{ __('home.info_company') }}</a>
        <a href="{{route('profile.member.person')}}" class="btn btn-success mr-3">{{ __('home.Registrator Information') }}</a>
        <a href="{{route('profile.member.represent')}}" class="btn btn-success mr-3">{{ __('home.Representative Information') }}</a>
        <a href="#" class="btn btn-success">{{ __('home.Staffs Information') }}</a>
    </div>

    <h3 class="text-center mt-5">{{ __('home.Congratulations, you have registered as a member') }} {{$company->member}}</h3>
    <div class="start-page mb-3">
        <div class="background pt-3 justify-content-center pb-3">
            <div class="form-title text-center solid-3x pt-2 pb-3 bg-member-green">
                <div class="title text-primary"
                     style="font-size: 35px; font-weight: 600">{{ __('home.Sign up company information') }}</div>
            </div>
            <div class="">
                @if($company->member == \App\Enums\RegisterMember::BUYER)
                    @include('frontend.pages.registerMember.buyer')
                @else
                    @include('frontend.pages.registerMember.more-member-other')
                @endif
                <h2 id="result"></h2>
            </div>
        </div>
    </div>
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




