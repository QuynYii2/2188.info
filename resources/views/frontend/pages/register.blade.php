@extends('frontend.layouts.master')

@section('title', 'Register')

<style>
    .register-tags {
        display: inline-block;
        margin: auto;
    }

    .link-tabs {
        color: #cccccc;
        background-color: #f9f9f9 !important;
    }

    .link-tabs:hover {
        color: #c69500;
    !important;
        background-color: #f7f7f7;
    }

</style>

@section('content')

    <div class="container bg-white mt-3">

        <div class="form-title text-center pt-2">
            <h4>{{ __('home.sign up') }}</h4>
        </div>
        <div class="row mt-5">
            <div class="col-md-8 register-tags">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                        <a class="nav-item nav-link active link-tabs" id="nav-buyer-tab" data-toggle="tab"
                           href="#nav-buyer"
                           role="tab" aria-controls="nav-buyer" onclick="buyer();">{{ __('home.buyer') }}</a>
                        <a class="nav-item nav-link link-tabs" id="nav-seller-tab" data-toggle="tab" href="#nav-seller"
                           role="tab"
                           aria-controls="nav-seller" onclick="seller();">{{ __('home.seller') }}</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="nav-buyer" role="tabpanel"
                         aria-labelledby="nav-buyer-tab">
                        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <input type="text" name="type_account" value="buyer" hidden="">
                                <div class="form-group">
                                    <input required type="text" class="form-control" name="name" id="name-buyer"
                                           placeholder="{{ __('home.input name') }}">
                                </div>
                                <div class="form-group">
                                    <input required type="number" class="form-control" name="phone" id="phone-buyer"
                                           placeholder="{{ __('home.input phone') }}">
                                </div>
                                <div class="form-group">
                                    <input required type="password" class="form-control" name="password"
                                           id="password-buyer"
                                           placeholder="{{ __('home.input password') }}">
                                </div>
                                <div class="form-group">
                                    <input required type="email" class="form-control" name="email" id="email-buyer"
                                           placeholder="{{ __('home.input email') }}">
                                </div>
                                <div class="form-group">
                                    <input required type="text" class="form-control" name="address" id="address-buyer"
                                           placeholder="{{ __('home.input address') }}">
                                </div>
                                <div class="form-group">
                                    <input required type="text" class="form-control" name="social_media"
                                           placeholder="{{ __('home.input socialNetwork') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="text-center m-2">
                                    <h5 class="text-danger"> Select the book you want to register here!</h5>
                                    <a href="#" class="link-tabs">Learn more about my rights...</a>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked1" checked
                                           disabled>
                                    <label class="form-check-label"
                                           for="flexSwitchCheckChecked1">view_all_products</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked2" checked
                                           disabled>
                                    <label class="form-check-label" for="flexSwitchCheckChecked2">view_profile</label>
                                </div>
                                @foreach($permissions as $permission)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               name="permission-{{$permission->id}}" id="permission-{{$permission->id}}"
                                               value="{{$permission->id}}">
                                        <label class="form-check-label"
                                               for="permission-{{$permission->id}}">{{$permission->name}}</label>
                                    </div>
                                @endforeach
                                <div>
                                    <button type="submit" id="btn-submit-permission" hidden="">Submit</button>
                                </div>
                            </div>
                            <div class="">
                                <div class="float-left">
                                    <a class="tabs-product-detail"
                                       href="{{route('home')}}">{{ __('home.back home') }}</a>
                                </div>
                                <div class="float-right">
                                    <a class="tabs-product-detail"
                                       href="{{route('login')}}">{{ __('home.sign in') }}</a>
                                </div>
                            </div>
                            <button type="submit" onclick="myFun(1)"
                                    class="btn btn-info btn-info-buyer btn-block btn-round mt-5">{{ __('home.sign up') }}
                            </button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-seller" role="tabpanel" aria-labelledby="nav-seller-tab">
                        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                           <div class="">
                               <input type="text" name="type_account" value="seller" hidden>
                               <div class="form-group">
                                   <input required type="text" class="form-control" name="name" id="name-seller"
                                          placeholder="{{ __('home.input name') }}">
                               </div>
                               <div class="form-group">
                                   <input required type="number" class="form-control" name="phone"
                                          placeholder="{{ __('home.input phone') }}">
                               </div>

                               <div class="form-group">
                                   <input required type="password" class="form-control" name="password"
                                          placeholder="{{ __('home.input password') }}">
                               </div>
                               <div class="form-group">
                                   <input required type="email" class="form-control" name="email" id="email-seller"
                                          placeholder="{{ __('home.input email') }}">
                               </div>
                               <div class="form-group">
                                   <input required type="text" class="form-control" name="address"
                                          placeholder="{{ __('home.input address') }}">
                               </div>
                               <div class="form-group">
                                   <input required type="text" class="form-control" name="rental_code"
                                          placeholder="{{ __('home.input taxCode') }}">
                               </div>
                           </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input required type="file" id="inputFile"
                                           class="form-control"
                                           name="image">
                                    <label class="custom-file-label"
                                           for="inputFile">{{ __('home.business license') }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="industry">
                                    <option selected>{{ __('home.choose branch') }}</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input required type="text" class="form-control" name="product_name"
                                       placeholder="{{ __('home.input nameProduct') }}">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="product_code"
                                       placeholder="{{ __('home.type product') }}" name="product_code">
                            </div>

                            <div class="form-group">
                                <input required type="text" class="form-control" name="social_media"
                                       placeholder="{{ __('home.input socialNetwork') }}">
                            </div>

                            <div class="mb-3">
                                <div class="text-center m-2">
                                    <h5 class="text-danger"> Select the book you want to register here!</h5>
                                    <a href="#" class="link-tabs">Learn more about my rights...</a>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked1" checked
                                           disabled>
                                    <label class="form-check-label"
                                           for="flexSwitchCheckChecked1">view_all_products</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked2" checked
                                           disabled>
                                    <label class="form-check-label" for="flexSwitchCheckChecked2">view_profile</label>
                                </div>
                                @foreach($permissions as $permission)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               name="permission-{{$permission->id}}" id="permission-{{$permission->id}}"
                                               value="{{$permission->id}}">
                                        <label class="form-check-label"
                                               for="permission-{{$permission->id}}">{{$permission->name}}</label>
                                    </div>
                                @endforeach
                                <div>
                                    <button type="submit" id="btn-submit-permission" hidden="">Submit</button>
                                </div>
                            </div>

                            <div class="">
                                <div class="float-left">
                                    <a class="tabs-product-detail"
                                       href="{{route('home')}}">{{ __('home.back home') }}</a>
                                </div>
                                <div class="float-right">
                                    <a class="tabs-product-detail"
                                       href="{{route('login')}}">{{ __('home.sign in') }}</a>
                                </div>
                            </div>
                            <button type="submit" onclick="myFun(1)"
                                    class="btn btn-info btn-info-seller btn-block btn-round mt-5">{{ __('home.sign up') }}
                            </button>
                        </form>
                    </div>
                    <div class="text-center text-muted delimiter">{{ __('home.or use a social network') }}</div>
                    <div class="d-flex justify-content-center social-buttons form-group">
                        <button type="button" class="btn btn-outline-primary btn-round mg-icon"
                                data-toggle="tooltip"
                                data-placement="top" title="Google">
                            <a href="{{ route('login.google') }}"><img class="custom-icon"
                                                                       src="data:image/png;base64,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"
                                                                       alt=""></a>
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-round mg-icon"
                                data-toggle="tooltip"
                                data-placement="top" title="Facebook">
                            <a href="{{ route('login.facebook') }}"><img class="custom-icon"
                                                                         src="data:image/png;base64,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"
                                                                         alt=""></a>
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-round mg-icon"
                                data-toggle="tooltip"
                                data-placement="top" title="Kakao Talk">
                            <a href="{{ route('login.kakaotalk') }}">  <img class="custom-icon"
                                                                            src="data:image/png;base64,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"
                                                                            alt=""></a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // function myFun(x) {
    //     var btn = document.getElementById('btn-submit-permission');
    //     btn.click();
    // }

    // function buyer() {
    //     $(document).ready(function() {
    //         $('.btn-info-buyer').prop('disabled', true);
    //
    //         function validateNextButton() {
    //             var buttonDisabled = $('#name-buyer').val().trim() === '' || $('#email-buyer').val().trim() === '' ||
    //                 $('#name-buyer').val().trim() === '' || $('#email-buyer').val().trim() === '';
    //             $('.btn-info-buyer').prop('disabled', buttonDisabled);
    //         }
    //
    //         $('#email-buyer').on('keyup', validateNextButton);
    //         $('#name-seller').on('keyup', validateNextButton);
    //     });
    // }
    //
    // buyer();
    //
    // function seller() {
    //     $(document).ready(function() {
    //         $('.btn-info-seller').prop('disabled', true);
    //
    //         function validateNextButton() {
    //             var buttonDisabled = $('#email-seller').val().trim() === '' || $('#name-seller').val().trim() === '';
    //             $('.btn-info-seller').prop('disabled', buttonDisabled);
    //         }
    //
    //         $('#email-seller').on('keyup', validateNextButton);
    //         $('#name-seller').on('keyup', validateNextButton);
    //     });
    // }

    // jQuery
    // $(document).ready(function(){
    //     $('.btn-info').attr('disabled',true);
    //     $('#name-seller').keyup(function(){
    //         if($(this).val().length !==0)
    //             $('.btn-info').attr('disabled', false);
    //         else
    //             $('.btn-info').attr('disabled',true);
    //     })
    // });

    //

</script>
<script>

    // Sử dụng AJAX để gửi yêu cầu đăng ký
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Gửi yêu cầu đăng ký khi người dùng nhấn nút đăng ký
    $('#nav-seller').submit(function (e) {
        e.preventDefault(); // Ngăn chặn form submit

        $.ajax({
            type: 'POST',
            url: '{{ route("register.store") }}',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    // Hiển thị popup thông báo
                    alert('Đăng ký thành công!');

                    // Chuyển trang sau khi nhấn OK
                    window.location.href = '{{ route("home") }}';
                } else {
                    // Xử lý nếu đăng ký không thành công
                    alert('Đăng ký không thành công!');
                }
            }
        });
    });
</script>
