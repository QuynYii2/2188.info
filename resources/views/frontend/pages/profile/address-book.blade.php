@extends('frontend.layouts.profile')

@section('title', 'Return Management')

<style>
    .link-tabs {
        background-color: #f7f7f7 !important;
    }

    .link-tabs:hover {
        color: #c69500 !important;
    }
</style>

@section('sub-content')
    <div class="container-fluid">
        <div class="row mt-2 bg-white rounded">
            <div class="row  rounded pt-1 ml-5">
                <h5>{{ __('home.address book') }}</h5>
            </div>
            <div class="border-bottom"></div>
        </div>
        <div class="row bg-white rounded mt-2" style="display: contents">
            <button class="btn btn-outline-info bg-white py-3 link-tabs" id="addAction" data-toggle="modal"
                    data-target="#modal-address">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                </svg>
                {{ __('home.add address') }}
            </button>
        </div>

        <div class="row bg-white mt-3">
            @foreach($addresses as $address)
                <div class="col-12 col-sm-12 my-2 border">
                    <div class="py-3">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">{{$address->username}}</h5>
                            <div class="">
                                <button class="btn btn-outline- " onclick="editModal({{$address}})"
                                        data-target="#modal-address-edit"
                                        data-toggle="modal" style="color: blue">{{ __('home.edit') }}</button>
                                <a href="/address/delete/{{$address->id}}"><button class="btn btn-outline- " style="color: red">{{ __('home.delete') }}</button></a>
{{--                                <a href="{{ route('address.delete'),  $address->id }}"><button class="btn btn-outline- " style="color: red">{{ __('home.delete') }}</button></a>--}}
                            </div>
                        </div>
                        <p class="mb-1">{{ __('home.address') }}:{{$address->address_detail}}, {{$address->location}},
                            {{$address->province}}, {{$address->city}}</p>
                        <small>{{ __('home.phone number') }}: {{$address->phone}}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

{{--    Modal thêm mới--}}
    <div class="modal fade" id="modal-address" tabindex="-1" aria-labelledby="modalLabel"
    >
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Thêm mới địa chỉ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('address.create')}}" method="post" >
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="id" hidden value="">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Họ và tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Công ty</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="company" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Số điện thoại</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone" required
                                       pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tỉnh/Thành phố</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="city" name="city" required>
                                    <option value="" selected>Chọn tỉnh thành</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Quận huyện</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="district" name="province" required>
                                    <option value="" selected>Chọn quận huyện</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phường xã</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="ward" name="location" required>
                                    <option value="" selected>Chọn phường xã</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Địa chỉ</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" name="address_detail" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Loại địa chỉ</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" name="address_option"
                                               id="exampleRadios1"
                                               value="{{\App\Enums\AddressOrderOption::HOME_PRIVATE}}" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Nhà riêng / Chung cư
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" name="address_option"
                                               id="exampleRadios2"
                                               value="{{\App\Enums\AddressOrderOption::COMPANY}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Cơ quan / Công ty
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="checkbox" name="default" class="mr-2"
                                           value="{{\App\Enums\AddressOrder::DEFAULT}}">
                                    Đặt làm địa chỉ mặc định
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--    Modal sửa--}}
    <div class="modal fade" id="modal-address-edit" tabindex="-1" aria-labelledby="modalLabel"
    >
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Sửa địa chỉ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formInput">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="id" id="id-edit" hidden value="">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Họ và tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" id="username-edit" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Công ty</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="company" id="company-edit" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Số điện thoại</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone"
                                       pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b" id="phone-edit" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tỉnh/Thành phố</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="city" id="city-edit" required>
                                    <option value="" selected>Chọn tỉnh thành</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Quận huyện</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="province" id="province-edit" required>
                                    <option value="" selected>Chọn quận huyện</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phường xã</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="location" id="location-edit" required>
                                    <option value="" selected>Chọn phường xã</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Địa chỉ</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" name="address_detail" id="address_detail-edit" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Loại địa chỉ</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" name="address_option"
                                               id="address_option-edit-1"
                                               value="{{\App\Enums\AddressOrderOption::HOME_PRIVATE}}">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Nhà riêng / Chung cư
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" name="address_option"
                                               id="address_option-edit-2"
                                               value="{{\App\Enums\AddressOrderOption::COMPANY}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Cơ quan / Công ty
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="checkbox" name="default" class="mr-2" id="default-edit">
                                    Đặt làm địa chỉ mặc định
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
            referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>

        var renderData = (array, select) => {
            let row = ' <option disable value="">Chọn</option>';
            array.forEach(element => {
                row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }

        const host = "https://provinces.open-api.vn/api/";
        var callAPI = (api, id) => {
            if (sessionStorage.hasOwnProperty('city')) {
                renderData(JSON.parse(sessionStorage.getItem('city')), id);
            } else {
                return axios.get(api)
                    .then((response) => {
                        sessionStorage.setItem('city', JSON.stringify(response.data))
                        renderData(response.data, id);
                    });
            }
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1', 'city');
        var callApiDistrict = (api, id) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, id);
                });
        }
        var callApiWard = (api, id) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.wards, id);
                });
        }


        $("#city").change(() => {
            callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2", 'district');
        });
        $("#district").change(() => {
            callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2", "ward");
        });
        $("#city-edit").change(() => {
            callApiDistrict(host + "p/" + $("#city-edit").find(':selected').data('id') + "?depth=2", 'province-edit');
        });
        $("#province-edit").change(() => {
            callApiWard(host + "d/" + $("#province-edit").find(':selected').data('id') + "?depth=2", "location-edit");
        });

        async function editModal(obj) {
            callAPI('https://provinces.open-api.vn/api/?depth=1', 'city-edit');

            document.getElementById('id-edit').value = obj.id;
            document.getElementById('username-edit').value = obj.username;
            document.getElementById('company-edit').value = obj.company;
            document.getElementById('phone-edit').value = obj.phone;

            document.getElementById('city-edit').value = obj.city;
            await callApiDistrict(host + "p/" + $("#city-edit").find(':selected').data('id') + "?depth=2", 'province-edit');
            document.getElementById('province-edit').value = obj.province;
            await callApiWard(host + "d/" + $("#province-edit").find(':selected').data('id') + "?depth=2", 'location-edit');
            document.getElementById('location-edit').value = obj.location;

            document.getElementById('address_detail-edit').textContent = obj.address_detail;

            var homeRadio = document.getElementById("address_option-edit-1");
            var companyRadio = document.getElementById("address_option-edit-2");
            let typeAdd = obj.address_option;

            if (typeAdd == "{{\App\Enums\AddressOrderOption::HOME_PRIVATE}}") {
                homeRadio.checked = true;
            } else if (obj.address_option == "{{\App\Enums\AddressOrderOption::COMPANY}}") {
                companyRadio.checked = true;
            }

            var checkbox = document.getElementById('default-edit');
            if (obj.default == 1) {
                checkbox.checked = true;
            } else {
                checkbox.checked = false;
            }

            let formInput = document.getElementById('formInput');

            formInput.action = "/address-update/" + obj.id;

        }


    </script>
@endsection
