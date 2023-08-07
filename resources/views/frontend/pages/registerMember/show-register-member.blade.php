@extends('frontend.layouts.master')

@section('title', 'Register Member')

<style>
    .btn-hidden:hover {
        cursor: not-allowed !important;
    }
</style>

@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card border">
                <div class="form-title text-center pt-2">
                    <div class="title">{{ __('home.sign up member') }}</div>
                </div>
                <div class="mt-5">
                    @if($registerMember == \App\Enums\RegisterMember::VENDOR)
                        <div class="card border">
                            <h3 class="text-center">
                                Đồng ý với điều khoản quy định của hội viên {{\App\Enums\RegisterMember::VENDOR}}
                            </h3>
                            <div class="row ml-3 mr-3">
                                <div class="col-md-6 border">
                                    <h5 class="text-center">Kiểm tra nội quy định phải đồng ý ở bên dưới</h5>
                                    <div class="rules" onclick="validateAll()">
                                        <p class="text-warning">
                                            Đồng ý với quy định và điều khoản mà chúng tôi cung cấp
                                        </p>
                                        <input type="checkbox" id="rules" name="rules" required>
                                        <label for="rules"> Trust</label><br>
                                    </div>
                                    <div class="getInfo" onclick="validateAll()">
                                        <p class="text-warning">
                                            Cho phép thu thập thông tin
                                        </p>
                                        <input type="checkbox" id="getInfo" name="getInfo" required>
                                        <label for="getInfo"> Trust</label><br>
                                    </div>
                                    <div class="all" onclick="validate()">
                                        <p class="text-warning">
                                            Đồng ý tất cả
                                        </p>
                                        <input type="checkbox" id="all" name="all">
                                        <label for="all"> All</label><br>
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <h5 class="text-center">Chức năng chính dành riêng cho hội viên</h5>
                                    <ol class="text-success">
                                        <li>Quản lý xuất nhập kho của sản phẩm, quản lý tồn kho và quản lí kinh
                                            doanh
                                        </li>
                                        <li>Quản lí sản phẩm giao dịch bằng điện tử và giao dịch điện tử</li>
                                        <li>Gửi và nhận hàng hóa (quốc tế, trong nước, trên biển, hàng không, vận
                                            chuyển đặc
                                            biệt, giao hàng tận nơi …)
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <input type="text" hidden="" id="price" name="price"
                                   value="{{\App\Enums\RegisterMemberPrice::VENDOR}}">
                            <p class="bg-success full-width p-3 ml-3 mr-3"></p>
                            <div class="mt-3 mb-3">
                                <h5 class="text-center">
                                    Gia nhập hội viên {{\App\Enums\RegisterMember::VENDOR}}
                                    <p class="text-danger text-center">Price:
                                        ${{\App\Enums\RegisterMemberPrice::VENDOR}}</p>
                                </h5>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('show.register.member.info', \App\Enums\RegisterMember::VENDOR)}}"
                                       id="register" class="d-none btn btn-success mr-3">
                                        Đăng ký
                                    </a>
                                    <button id="register-btn" class="btn-hidden btn btn-secondary mr-3">
                                        Đăng ký
                                    </button>
                                </div>
                            </div>
                            <p class="bg-success mt-3 full-width p-3 ml-3 mr-3"></p>
                        </div>
                    @elseif($registerMember == \App\Enums\RegisterMember::POWER_VENDOR)
                        <div class="card border">
                            <h3 class="text-center">
                                Đồng ý với điều khoản quy định của hội
                                viên {{\App\Enums\RegisterMember::POWER_VENDOR}}
                            </h3>
                            <div class="row ml-3 mr-3">
                                <div class="col-md-6 border">
                                    <h5 class="text-center">Kiểm tra nội quy định phải đồng ý ở bên dưới</h5>
                                    <div class="rules" onclick="validateAll()">
                                        <p class="text-warning">
                                            Đồng ý với quy định và điều khoản mà chúng tôi cung cấp
                                        </p>
                                        <input type="checkbox" id="rules" name="rules" required>
                                        <label for="rules"> Trust</label><br>
                                    </div>
                                    <div class="getInfo" onclick="validateAll()">
                                        <p class="text-warning">
                                            Cho phép thu thập thông tin
                                        </p>
                                        <input type="checkbox" id="getInfo" name="getInfo" required>
                                        <label for="getInfo"> Trust</label><br>
                                    </div>
                                    <div class="all" onclick="validate()">
                                        <p class="text-warning">
                                            Đồng ý tất cả
                                        </p>
                                        <input type="checkbox" id="all" name="all">
                                        <label for="all"> All</label><br>
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <h5 class="text-center">Chức năng chính dành riêng cho hội viên</h5>
                                    <ol class="text-success">
                                        <li>Quản lý xuất nhập kho của sản phẩm, quản lý tồn kho và quản lí kinh
                                            doanh
                                        </li>
                                        <li>Quản lí sản phẩm giao dịch bằng điện tử và giao dịch điện tử</li>
                                        <li>Gửi và nhận hàng hóa (quốc tế, trong nước, trên biển, hàng không, vận
                                            chuyển đặc
                                            biệt, giao hàng tận nơi …)
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <input type="text" hidden="" id="price" name="price"
                                   value="{{\App\Enums\RegisterMemberPrice::POWER_VENDOR}}">
                            <p class="bg-success full-width p-3 ml-3 mr-3"></p>
                            <div class="mt-3 mb-3">
                                <h5 class="text-center">
                                    Gia nhập hội viên {{\App\Enums\RegisterMember::POWER_VENDOR}}
                                    <p class="text-danger text-center">Price:
                                        ${{\App\Enums\RegisterMemberPrice::POWER_VENDOR}}</p>
                                </h5>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('show.register.member.info', \App\Enums\RegisterMember::POWER_VENDOR)}}"
                                       id="register" class="d-none btn btn-success mr-3">
                                        Đăng ký
                                    </a>
                                    <button id="register-btn" class="btn-hidden btn btn-secondary mr-3">
                                        Đăng ký
                                    </button>
                                </div>
                            </div>
                            <p class="bg-success mt-3 full-width p-3 ml-3 mr-3"></p>
                        </div>
                    @elseif($registerMember == \App\Enums\RegisterMember::PRODUCTION)
                        <div class="card border">
                            <h3 class="text-center">
                                Đồng ý với điều khoản quy định của hội
                                viên {{\App\Enums\RegisterMember::PRODUCTION}}
                            </h3>
                            <div class="row ml-3 mr-3">
                                <div class="col-md-6 border">
                                    <h5 class="text-center">Kiểm tra nội quy định phải đồng ý ở bên dưới</h5>
                                    <div class="rules" onclick="validateAll()">
                                        <p class="text-warning">
                                            Đồng ý với quy định và điều khoản mà chúng tôi cung cấp
                                        </p>
                                        <input type="checkbox" id="rules" name="rules" required>
                                        <label for="rules"> Trust</label><br>
                                    </div>
                                    <div class="getInfo" onclick="validateAll()">
                                        <p class="text-warning">
                                            Cho phép thu thập thông tin
                                        </p>
                                        <input type="checkbox" id="getInfo" name="getInfo" required>
                                        <label for="getInfo"> Trust</label><br>
                                    </div>
                                    <div class="all" onclick="validate()">
                                        <p class="text-warning">
                                            Đồng ý tất cả
                                        </p>
                                        <input type="checkbox" id="all" name="all">
                                        <label for="all"> All</label><br>
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <h5 class="text-center">Chức năng chính dành riêng cho hội viên</h5>
                                    <ol class="text-success">
                                        <li>Quản lý xuất nhập kho của sản phẩm, quản lý tồn kho và quản lí kinh
                                            doanh
                                        </li>
                                        <li>Quản lí sản phẩm giao dịch bằng điện tử và giao dịch điện tử</li>
                                        <li>Gửi và nhận hàng hóa (quốc tế, trong nước, trên biển, hàng không, vận
                                            chuyển đặc
                                            biệt, giao hàng tận nơi …)
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <input type="text" hidden="" id="price" name="price"
                                   value="{{\App\Enums\RegisterMemberPrice::PRODUCTION}}">
                            <p class="bg-success full-width p-3 ml-3 mr-3"></p>
                            <div class="mt-3 mb-3">
                                <h5 class="text-center">
                                    Gia nhập hội viên {{\App\Enums\RegisterMember::PRODUCTION}}
                                    <p class="text-danger text-center">Price:
                                        ${{\App\Enums\RegisterMemberPrice::PRODUCTION}}</p>
                                </h5>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('show.register.member.info', \App\Enums\RegisterMember::PRODUCTION)}}"
                                       id="register" class="d-none btn btn-success mr-3">
                                        Đăng ký
                                    </a>
                                    <button id="register-btn" class="btn-hidden btn btn-secondary mr-3">
                                        Đăng ký
                                    </button>
                                </div>
                            </div>
                            <p class="bg-success mt-3 full-width p-3 ml-3 mr-3"></p>
                        </div>
                    @else
                        <div class="card border">
                            <h3 class="text-center">
                                Đồng ý với điều khoản quy định của hội
                                viên {{\App\Enums\RegisterMember::POWER_PRODUCTION}}
                            </h3>
                            <div class="row ml-3 mr-3">
                                <div class="col-md-6 border">
                                    <h5 class="text-center">Kiểm tra nội quy định phải đồng ý ở bên dưới</h5>
                                    <div class="rules" onclick="validateAll()">
                                        <p class="text-warning">
                                            Đồng ý với quy định và điều khoản mà chúng tôi cung cấp
                                        </p>
                                        <input type="checkbox" id="rules" name="rules" required>
                                        <label for="rules"> Trust</label><br>
                                    </div>
                                    <div class="getInfo" onclick="validateAll()">
                                        <p class="text-warning">
                                            Cho phép thu thập thông tin
                                        </p>
                                        <input type="checkbox" id="getInfo" name="getInfo" required>
                                        <label for="getInfo"> Trust</label><br>
                                    </div>
                                    <div class="all" onclick="validate()">
                                        <p class="text-warning">
                                            Đồng ý tất cả
                                        </p>
                                        <input type="checkbox" id="all" name="all">
                                        <label for="all"> All</label><br>
                                    </div>
                                </div>
                                <div class="col-md-6 border">
                                    <h5 class="text-center">Chức năng chính dành riêng cho hội viên</h5>
                                    <ol class="text-success">
                                        <li>Quản lý xuất nhập kho của sản phẩm, quản lý tồn kho và quản lí kinh
                                            doanh
                                        </li>
                                        <li>Quản lí sản phẩm giao dịch bằng điện tử và giao dịch điện tử</li>
                                        <li>Gửi và nhận hàng hóa (quốc tế, trong nước, trên biển, hàng không, vận
                                            chuyển đặc
                                            biệt, giao hàng tận nơi …)
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <input type="text" hidden="" id="price" name="price"
                                   value="{{\App\Enums\RegisterMemberPrice::POWER_PRODUCTION}}">
                            <p class="bg-success full-width p-3 ml-3 mr-3"></p>
                            <div class="mt-3 mb-3">
                                <h5 class="text-center">
                                    Gia nhập hội viên {{\App\Enums\RegisterMember::POWER_PRODUCTION}}
                                    <p class="text-danger text-center">Price:
                                        ${{\App\Enums\RegisterMemberPrice::POWER_PRODUCTION}}</p>
                                </h5>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('show.register.member.info', \App\Enums\RegisterMember::POWER_PRODUCTION)}}"
                                       id="register" class="d-none btn btn-success mr-3">
                                    Đăng ký
                                    </a>
                                    <button id="register-btn" class="btn-hidden btn btn-secondary mr-3">
                                        Đăng ký
                                    </button>
                                </div>
                            </div>
                            <p class="bg-success mt-3 full-width p-3 ml-3 mr-3"></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validate() {
        var all = document.getElementById("all");
        if (all.checked) {
            document.getElementById("rules").checked = true;
            document.getElementById("getInfo").checked = true;
        } else {
            document.getElementById("rules").checked = false;
            document.getElementById("getInfo").checked = false;
        }

        toggle();
    }

    function validateAll() {
        var all = document.getElementById("all");
        var rules = document.getElementById("rules");
        var getInfo = document.getElementById("getInfo");
        all.checked = !!(rules.checked && getInfo.checked);

        toggle();
    }

    function toggle() {
        var all = document.getElementById("all");
        if (all.checked) {
            document.getElementById("register").classList.remove('d-none');
            document.getElementById("register-btn").classList.add('d-none');
        } else {
            document.getElementById("register").classList.add('d-none');
            document.getElementById("register-btn").classList.remove('d-none');
        }
    }
</script>

