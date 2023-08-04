@extends('backend.layouts.master')
@section('title', 'Information')
@section('content')
    <style>
        #dateOfBirth select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .size-img {
            width: 20px;
            height: 20px;
        }

        .avatar-upload img {
            max-width: none;
        }

        @media (max-width: 991px) {
            .border-right {
                border-right: none !important;
            }

            #form-info {
                padding-bottom: 3rem;
            }
        }

        @media (min-width: 992px) {
            .border-bottom {
                border-bottom: none !important;
            }
        }

        .cus-mr-modal {
        }

        @media (max-width: 575px) {
            .list-group .list-group-item {
                padding: 0.75rem 0;
            }

            .cus-mr-modal {
                width: 100vw;
                margin: 0 !important;
            }
        }

        @media (max-width: 481px) {
            .avatar-upload .preview, .image-upload .preview {
                width: 60px;
                height: 60px;
                position: relative;
                border: 6px solid #c9c9c9;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
            }

            .avatar-upload .avatar-edit input + label, .image-upload .image-edit input + label {
                display: inline-block;
                width: 15px;
                height: 15px;
                margin-bottom: 0;
                border-radius: 100%;
                background: #e0dfdf;
                border: 1px solid;
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.12);
                cursor: pointer;
                font-weight: normal;
                transition: all 0.2s ease-in-out;
            }

            .size-img {
                width: 10px;
                height: 10px;
                display: flex;
            }
        }

    </style>
    <div class="container rounded mt-5 bg-white m-auto">
        <div class="row my-5">
            <div id="form-info" class="col-sm-12 col-12 border-bottom border-right">
                <form action="{{ route('profile.shop.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-center justify-content-center">

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="staticEmail"
                                       class="col-md-3 col-12 col-form-label">Tên người bán</label>
                                <div class="col-md-9 col-12">
                                    <input type="text" class="form-control" id="staticEmail" name="name"
                                           value="{{ $sellerInfo->name ?? ''}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">Quốc gia</label>
                        <div class="col-md-9 col-12">
                            <select style="display: block!important;" class="form-control" id="country" name="region">
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">Mã số thuế</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" name="rental_code"
                                   value="{{ $sellerInfo->masothue }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">Tên sản phẩm đăng ký</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" name="product_name"
                                   value="{{ $sellerInfo->product_name }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">Mã sản phẩm đăng ký</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" name="product_code"
                                   value="{{ $sellerInfo->product_code }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">Ngành sản phẩm đăng ký</label>

                        <div class="col-md-9 col-12">
                            <input type="text" class="form-control" name="industry" value="{{ $user->industry }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="short_description" class="col-md-3 col-12 col-form-label">Thông tin công ty</label>
                        <div class="col-md-9 col-12">
                            <textarea class="form-control description" name="information" rows="5">
                                    {{$sellerInfo->information}}
                            </textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="day" class="col-md-3 col-12 col-form-label">Ảnh giấy phép kinh doanh</label>

                        <div class="col-md-9 col-12">
                            <input type="file" class="form-control" name="image" accept="image/*">
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Ảnh giấy phép kinh doanh"
                                 height="100" width="100">
                        </div>
                    </div>
                    <div class="row pl-2 pt-3">
                        <label for="day" class="col-sm-3 col-form-label col-12"></label>
                        <div class="col-md-9 col-12">
                            <button class="btn btn-outline-primary align-center" type="submit">Lưu</button>
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
                console.log(error);
            });
    </script>

    <script>
        let desc = document.querySelectorAll('.description');
        for (let i = 0; i < desc.length; i++) {
            ClassicEditor
                .create(desc[i])
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
@endsection
