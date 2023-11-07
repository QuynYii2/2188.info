@extends('backend.layouts.master')
@section('title', 'Information')
@section('content')
    <div class="container rounded mt-5 bg-white m-auto">
        <div class="row my-5">
            <div id="form-info" class="col-sm-12 col-12 border-bottom border-right">
{{--                @if() @endif--}}
                <form action="{{ route('profile.shop.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-center justify-content-center">

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="staticEmail"
                                       class="col-md-3 col-12 col-form-label">{{ __('home.Tên người bán') }}</label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="staticEmail" required name="name"
                                           value="{{ $sellerInfo->name ?? ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Quốc gia') }}</label>
                        <div class="col-md-9 col-12">
                            <select style="display: block!important;" class="form-control" id="country" name="region">
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Mã số thuế') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" name="rental_code"
                                   value="{{ $sellerInfo->masothue ?? ''}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Tên sản phẩm đăng ký') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="product_name"
                                   value="{{ $sellerInfo->product_name ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Mã sản phẩm đăng ký') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="product_code"
                                   value="{{ $sellerInfo->product_code ?? '' }}">
                        </div>
                    </div>


                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Diện tích sàn(㎡)') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control"  name="acreage"
                                   value="{{ $shopinformation->acreage ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Dây chuyền sản xuất') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control"  name="machine_number"
                                   value="{{ $shopinformation->machine_number ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Tổng sản lượng hằng năm(đơn vị)') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="annual_output"
                                   value="{{ $shopinformation->annual_output ?? '' }}">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Năm trong ngành') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="industry_year"
                                   value="{{ $shopinformation->industry_year ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Thị trường chính') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="marketing"
                                   value="{{ $shopinformation->marketing ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Đối tác chuỗi cung ứng') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control"  name="partner"
                                   value="{{ $shopinformation->partner ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Các loại khách hàng chính') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="customers"
                                   value="{{ $shopinformation->customers ?? '' }}">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Phương pháp kiểm tra sản phẩm') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control"  name="test_method"
                                   value="{{ $shopinformation->test_method ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Nhân viên kiểm tra') }} </label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control"  name="inspection_staff"
                                   value="{{ $shopinformation->inspection_staff ?? '' }}">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Ngành sản phẩm đăng ký') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="industry" value="{{ $user->industry ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="short_description" class="col-md-3 col-12 col-form-label">{{ __('home.Thông tin công ty') }}</label>
                        <div class="col-md-9 col-12">
                            <textarea class="form-control description" name="information" rows="5">
                                    {{$sellerInfo->information ?? '' }}
                            </textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Ảnh giấy phép kinh doanh') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="file" class="form-control" name="image" required accept="image/*">
                            <img src="{{ asset('storage/' . $user->image) }}" alt={{ __('home.Ảnh giấy phép kinh doanh') }}
                                 height="100" width="100">
                        </div>
                    </div>
                    <div class="row pl-2 pt-3">
                        <label for="day" class="col-sm-3 col-form-label col-12"></label>
                        <div class="col-md-9 col-12">
                            <button class="btn btn-outline-primary align-center" type="submit">{{ __('home.Lưu') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('js/backend/show_profile/index.js')}}"></script>
@endsection
