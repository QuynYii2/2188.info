@extends('backend.layouts.master')
@section('title', 'Information')
@section('content')
    <div class="rounded bg-white m-auto">
        <div class="row my-3 p-3">
            <div id="form-info" class="col-sm-12 col-12 border-bottom border-right">
                <form action="{{ route('profile.shop.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-center justify-content-center">

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="staticEmail"
                                       class="col-md-3 col-12 col-form-label">{{ __('home.Tên người bán') }}</label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="staticEmail" required name="name"
                                           value="{{ $user->name ?? ''}}">
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
                                   value="{{ $shop_infos->masothue ?? ''}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Tên sản phẩm đăng ký') }}</label>
                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="product_name"
                                   value="{{ $shop_infos->product_name ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Mã sản phẩm đăng ký') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="product_code"
                                   value="{{ $shop_infos->product_code ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Diện tích sàn(㎡)') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="number" class="form-control" name="acreage"
                                   value="{{ $shop_infos->acreage ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Dây chuyền sản xuất') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" name="machine_number"
                                   value="{{ $shop_infos->machine_number ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Tổng sản lượng hằng năm(đơn vị)') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="number" class="form-control" required name="annual_output"
                                   value="{{ $shop_infos->annual_output ?? '' }}">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Năm trong ngành') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="number" class="form-control" required name="industry_year"
                                   value="{{ $shop_infos->industry_year ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Thị trường chính') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="marketing"
                                   value="{{ $shop_infos->marketing ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Đối tác chuỗi cung ứng') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" name="partner"
                                   value="{{ $shop_infos->partner ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Các loại khách hàng chính') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="customers"
                                   value="{{ $shop_infos->customers ?? '' }}">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Phương pháp kiểm tra sản phẩm') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" name="test_method"
                                   value="{{ $shop_infos->test_method ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Nhân viên kiểm tra') }} </label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" name="inspection_staff"
                                   value="{{ $shop_infos->inspection_staff ?? '' }}">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Ngành sản phẩm đăng ký') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" required name="industry"
                                   value="{{ $user->industry ?? '' }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="short_description" class="col-md-3 col-12 col-form-label">{{ __('home.Thông tin công ty') }}</label>
                        <div class="col-md-9 col-12">
                            <textarea class="form-control description" name="information" rows="5">
                                    {{$shop_infos->information ?? '' }}
                            </textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">{{ __('home.Ảnh giấy phép kinh doanh') }}</label>

                        <div class="col-md-9 col-12">
                            <input type="file" class="form-control" name="image" accept="image/*">
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
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('avatarPreview');
                output.src = reader.result;
                output.style.backgroundSize = "cover";
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        var countrySelect = document.getElementById('country');
        fetch('https://restcountries.com/v2/all')
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                const regionUser = "{{ Auth::user()->region }}";
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement('option');
                    let codeRegion = data[i].alpha2Code.toLowerCase();
                    option.value = codeRegion;
                    option.text = data[i].name;
                    if (codeRegion === regionUser) {
                        option.selected = true;
                    }
                    countrySelect.add(option);
                }
            })
            .catch(function (error) {

            });
    </script>

    <script>
        let desc = document.querySelectorAll('.description');
        for (let i = 0; i < desc.length; i++) {
            CKEDITOR.replace(desc[i], {
                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            });
        }
    </script>
@endsection
