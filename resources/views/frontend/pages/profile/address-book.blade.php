@extends('backend.layouts.master')
@section('title', __('home.address book'))
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@section('content')
    <style>

    </style>
    <div class="container-fluid" id="address-book">
        <div class="row mt-2 bg-white rounded header-address-book">
            <div class="row w-100 rounded d-flex justify-content-center align-items-center title-address-book">
                {{ __('home.address book') }}
            </div>
            <div class="border-bottom"></div>
        </div>
        <div class="row bg-white rounded mt-2 justify-content-end d-flex">
            <button class="btn btn-outline-info py-3 link-tabs" id="addAction" data-toggle="modal"
                    data-target="#modal-address">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 5V19M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                {{ __('home.add address') }}
            </button>
        </div>

        <div class="row bg-white mt-3">
            @foreach($addresses as $address)
                <div class="col-12 col-sm-12 my-2 border-address-book">
                    <div class="py-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex"><span class="mb-1">{{ __('home.Name') }}:&nbsp;</span>
                                <div
                                        class="name-address-book"> {{ ($address->username) }}</div>
                            </div>

                            <div class="">
                                <button class="btn btn-outline- " onclick="editModal({{$address}})"
                                        data-target="#modal-address-edit"
                                        data-toggle="modal" style="color: blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path d="M12 20.0002H21M3 20.0002H4.67454C5.16372 20.0002 5.40832 20.0002 5.63849 19.945C5.84256 19.896 6.03765 19.8152 6.2166 19.7055C6.41843 19.5818 6.59138 19.4089 6.93729 19.063L19.5 6.50023C20.3285 5.6718 20.3285 4.32865 19.5 3.50023C18.6716 2.6718 17.3285 2.6718 16.5 3.50023L3.93726 16.063C3.59136 16.4089 3.4184 16.5818 3.29472 16.7837C3.18506 16.9626 3.10425 17.1577 3.05526 17.3618C3 17.5919 3 17.8365 3 18.3257V20.0002Z"
                                              stroke="#929292" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <a href="/address/delete/{{$address->id}}">
                                    <button class="btn btn-outline- " style="color: red">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path d="M16 6V5.2C16 4.0799 16 3.51984 15.782 3.09202C15.5903 2.71569 15.2843 2.40973 14.908 2.21799C14.4802 2 13.9201 2 12.8 2H11.2C10.0799 2 9.51984 2 9.09202 2.21799C8.71569 2.40973 8.40973 2.71569 8.21799 3.09202C8 3.51984 8 4.0799 8 5.2V6M10 11.5V16.5M14 11.5V16.5M3 6H21M19 6V17.2C19 18.8802 19 19.7202 18.673 20.362C18.3854 20.9265 17.9265 21.3854 17.362 21.673C16.7202 22 15.8802 22 14.2 22H9.8C8.11984 22 7.27976 22 6.63803 21.673C6.07354 21.3854 5.6146 20.9265 5.32698 20.362C5 19.7202 5 18.8802 5 17.2V6"
                                                  stroke="#E90000" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </a>
                                {{--                                <a href="{{ route('address.delete'),  $address->id }}"><button class="btn btn-outline- " style="color: red">{{ __('home.delete') }}</button></a>--}}
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex"><span class="mb-1">{{ __('home.phone number') }}: &nbsp;</span>
                                <div class="name-address-book"> {{ ($address->phone) }}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex"><span class="mb-1">{{ __('home.address') }}:&nbsp;</span>
                                <div class="name-address-book">  {{ ($address->address_detail) }}
                                    , {{ ($address->location) }},
                                    {{ ($address->province) }}, {{ ($address->city) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{--    Modal thêm mới--}}
    <div class="modal fade" id="modal-address" tabindex="-1" aria-labelledby="modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-address">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title modal-title_address" id="modalLabel">{{ __('home.Add new address') }}</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('address.create')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="id" hidden value="">
                        <div class="form-group">
                            <div><label for="username"
                                        class="col-sm-3 col-form-label">{{ __('home.Họ và tên') }}</label></div>
                            <div class="col-sm-12">
                                <input id="username" type="text" class="form-control" name="username" required
                                       placeholder="Nguyen Van A">
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="company" class="col-sm-3 col-form-label">{{ __('home.Công ty') }}</label>
                            </div>
                            <div class="col-sm-12">
                                <input id="company" type="text" class="form-control" name="company" required
                                       placeholder="Nguyen Van A">
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="phone"
                                        class="col-sm-3 col-form-label">{{ __('home.Số điện thoại') }}</label></div>
                            <div class="col-sm-12">
                                <input id="phone" type="tel" class="form-control" name="phone" required
                                       placeholder="0379357213"
                                       pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="city"
                                        class="col-sm-3 col-form-label">{{ __('home.address') }}</label></div>
                            <div class="col-sm-12">
                                <select class="form-control" id="city" name="city" required>
                                    <option value="" selected>{{ __('home.Tỉnh/Thành phố') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="district"
                                        class="col-sm-3 col-form-label"></label></div>
                            <div class="col-sm-12">
                                <select class="form-control" id="district" name="province" required>
                                    <option value="" selected>{{ __('home.Quận huyện') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="ward" class="col-sm-3 col-form-label"></label>
                            </div>
                            <div class="col-sm-12">
                                <select class="form-control" id="ward" name="location" required>
                                    <option value="" selected>{{ __('home.Phường xã') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="address_detail"
                                        class="col-sm-3 col-form-label"></label></div>
                            <div class="col-sm-12">
                                <textarea id="address_detail" type="text" class="form-control" name="address_detail"
                                          required placeholder="{{ __('home.Specific address') }}"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label class="col-sm-3 col-form-label"></label></div>
                            <div class="col-md-12 row">
                                <div class="form-check col-sm-6 d-flex align-items-center">
                                    <input class="form-check-input input-address-select m-0" type="radio"
                                           name="address_option"
                                           id="exampleRadios1"
                                           value="{{\App\Enums\AddressOrderOption::HOME_PRIVATE}}" checked>
                                    <label class="form-check-label color-addressType" for="exampleRadios1" style="margin-left: 30px;">
                                        {{ __('home.Nhà riêng / Chung cư') }}
                                    </label>


                                </div>
                                <div class="form-check col-sm-6 d-flex align-items-center">
                                    <input class="form-check-input input-address-select m-0" type="radio"
                                           name="address_option"
                                           id="exampleRadios2"
                                           value="{{\App\Enums\AddressOrderOption::COMPANY}}">
                                    <label class="form-check-label color-addressType" for="exampleRadios2" style="margin-left: 30px;">
                                        {{ __('home.Cơ quan / Công ty') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group d-flex justify-content-between check-value_address">
                                    <div class="align-items-center d-flex"><label class="form-check-label" for="default">{{ __('home.Đặt làm địa chỉ mặc định') }}</label></div>
                                    <div>
                                        <input id="default" type="checkbox" name="default" class="mr-2 custom-checkbox" value="{{\App\Enums\AddressOrder::DEFAULT}}">
                                        <label for="default"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('home.Lưu thay đổi') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--    Modal sửa--}}
    <div class="modal fade" id="modal-address-edit" tabindex="-1" aria-labelledby="modalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-address">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title modal-title_address" id="modalLabel">{{ __('home.Sửa địa chỉ') }}</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formInput">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="id" id="id-edit" hidden value="">
                        <div class="form-group">
                            <div><label for="username-edit"
                                        class="col-sm-3 col-form-label">{{ __('home.Họ và tên') }}</label></div>
                            <div class="col-sm-12">
                                <input  id="username-edit" type="text" class="form-control" name="username" required
                                       placeholder="Nguyen Van A">
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="company-edit" class="col-sm-3 col-form-label">{{ __('home.Công ty') }}</label>
                            </div>
                            <div class="col-sm-12">
                                <input id="company-edit" type="text" class="form-control" name="company" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="phone-edit"
                                        class="col-sm-3 col-form-label">{{ __('home.Số điện thoại') }}</label></div>
                            <div class="col-sm-12">
                                <input  id="phone-edit" type="number" class="form-control" name="phone" required
                                       pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b">
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="city"
                                        class="col-sm-3 col-form-label">{{ __('home.address') }}</label></div>
                            <div class="col-sm-12">
                                <select class="form-control" id="city-edit" name="city" required>
                                    <option value="" selected>{{ __('home.Tỉnh/Thành phố') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="province-edit"
                                        class="col-sm-3 col-form-label"></label></div>
                            <div class="col-sm-12">
                                <select class="form-control" id="province-edit" name="province" required>
                                    <option value="" selected>{{ __('home.Quận huyện') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="location-edit" class="col-sm-3 col-form-label"></label>
                            </div>
                            <div class="col-sm-12">
                                <select class="form-control" id="location-edit" name="location" required>
                                    <option value="" selected>{{ __('home.Phường xã') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label for="address_detail-edit"
                                        class="col-sm-3 col-form-label"></label></div>
                            <div class="col-sm-12">
                                <textarea id="address_detail-edit" type="text" class="form-control" name="address_detail"
                                          required placeholder="{{ __('home.Specific address') }}"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div><label class="col-sm-3 col-form-label"></label></div>
                            <div class="col-md-12 row">
                                <div class="form-check col-sm-6 d-flex align-items-center">
                                    <input class="form-check-input input-address-select m-0" type="radio"
                                           name="address_option"
                                           id="address_option-edit-1"
                                           value="{{\App\Enums\AddressOrderOption::HOME_PRIVATE}}" checked>
                                    <label class="form-check-label color-addressType" for="address_option-edit-1" style="margin-left: 30px;">
                                        {{ __('home.Nhà riêng / Chung cư') }}
                                    </label>


                                </div>
                                <div class="form-check col-sm-6 d-flex align-items-center">
                                    <input class="form-check-input input-address-select m-0" type="radio"
                                           name="address_option"
                                           id="address_option-edit-2"
                                           value="{{\App\Enums\AddressOrderOption::COMPANY}}">
                                    <label class="form-check-label color-addressType" for="address_option-edit-2" style="margin-left: 30px;">
                                        {{ __('home.Cơ quan / Công ty') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group d-flex justify-content-between check-value_address">
                                    <div class="align-items-center d-flex"><label class="form-check-label" for="default">{{ __('home.Đặt làm địa chỉ mặc định') }}</label></div>
                                    <div>
                                        <input id="default-edit" type="checkbox" name="default" class="mr-2 custom-checkbox" value="{{\App\Enums\AddressOrder::DEFAULT}}">
                                        <label for="default-edit"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('home.Lưu thay đổi') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('js/frontend/pages/profile/address-book.js')}}"></script>
@endsection
