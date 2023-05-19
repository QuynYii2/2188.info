@extends('frontend.layouts.profile')

@section('title', 'Return Management')

@section('sub-content')
    <div class="row mt-5 bg-white rounded">
        <div class="row  rounded pt-1">
            <h5>{{ __('home.address book') }}</h5>
        </div>
        <div class="border-bottom"></div>
    </div>
    <div class="row bg-white rounded mt-2">
        <button class="btn btn-outline-info bg-white  py-3" id="addAction" data-toggle="modal"
                data-target="#modal-address">
            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
            </svg>
            {{ __('home.add address') }}
        </button>
    </div>
    <div class="row bg-white rounded mt-3">
        <div class="row">
            <div class="py-3">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Người nhận 1</h5>
                    <div>
                        <button class="btn btn-outline- " onclick="editModal()" data-target="#modal-address" data-toggle="modal" style="color: blue">{{ __('home.edit') }}</button>
                        <button class="btn btn-outline- " style="color: red">{{ __('home.delete') }}</button>
                    </div>
                </div>
                <p class="mb-1">{{ __('home.address') }}: Hà nội</p>
                <small>{{ __('home.phone number') }}: 0123456789</small>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-address" tabindex="-1" aria-labelledby="modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Họ và tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="aaa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Công ty</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="aaa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Số điện thoại</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="aaa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tỉnh/Thành phố</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="city">
                                    <option value="" selected>Chọn tỉnh thành</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Quận huyện</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="district">
                                    <option value="" selected>Chọn quận huyện</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phường xã</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="ward">
                                    <option value="" selected>Chọn phường xã</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Địa chỉ</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" name="aaa"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Loại địa chỉ</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                               value="1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Nhà riêng / Chung cư
                                        </label>
                                    </div>
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                               value="2">
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
                                    <input type="checkbox" class="mr-2">
                                    Đặt làm địa chỉ mặc định
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        const host = "https://provinces.open-api.vn/api/";
        var callAPI = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data, "city");
                });
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1');
        var callApiDistrict = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, "district");
                });
        }
        var callApiWard = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.wards, "ward");
                });
        }

        var renderData = (array, select) => {
            let row = ' <option disable value="">Chọn</option>';
            array.forEach(element => {
                row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }

        $("#city").change(() => {
            callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
        });
        $("#district").change(() => {
            callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
        });

        document.getElementById("addAction").addEventListener("click", function() {
            document.querySelector("#modalLabel").innerHTML = "Tạo sổ địa chỉ"
        });

        function editModal() {
            document.querySelector("#modalLabel").innerHTML = "Sửa sổ địa chỉ"
        };
    </script>
@endsection
