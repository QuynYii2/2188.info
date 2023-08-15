@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card">
                <div class="form-title text-center pt-2">
                    <div class="title">{{ __('home.sign up member') }}</div>
                </div>
                <div class="mt-5 row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        <h5 class="text-center mt-2 mb-3 member-name">
                            {{\App\Enums\RegisterMember::TRUST}}
                        </h5>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-danger text-center">
                                    $0
                                </h3>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Hội viên {{\App\Enums\RegisterMember::TRUST}}
                                </h6>
                                <h6 class="text-nowrap">
                                    Xem chi tiết
                                </h6>
                                <ol class="text-success">
                                    <li>Tìm các sản phẩm B2B</li>
                                    <li>Quản lí và tìm kiếm giao dịch</li>
                                    <li>Nhắn tin và quảng cáo sản phẩm</li>
                                </ol>
                                <a href="{{route('show.register.member', \App\Enums\RegisterMember::TRUST)}}"
                                   class="btn btn-primary">Đăng kí ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-center mt-2 mb-3 member-name">
                            {{\App\Enums\RegisterMember::LOGISTIC}}
                        </h5>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-danger text-center">
                                    $0
                                </h3>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Hội viên {{\App\Enums\RegisterMember::LOGISTIC}}
                                </h6>
                                <h6 class="text-nowrap">
                                    Xem chi tiết
                                </h6>
                                <ol class="text-success">
                                    <li>Tìm các sản phẩm B2B</li>
                                    <li>Quản lí và tìm kiếm giao dịch</li>
                                    <li>Nhắn tin và quảng cáo sản phẩm</li>
                                </ol>
                                <a href="{{route('show.register.member', \App\Enums\RegisterMember::LOGISTIC)}}"
                                   class="btn btn-primary">Đăng kí ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-center mt-2 mb-3 member-name">
                            {{\App\Enums\RegisterMember::VENDOR}}
                        </h5>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-danger text-center">
                                    ${{\App\Enums\RegisterMemberPrice::VENDOR}}
                                </h3>
                                <h6 class="card-subtitle mb-2 text-muted text-nowrap">
                                    Hội viên {{\App\Enums\RegisterMember::VENDOR}}
                                </h6>
                                <h6 class="text-nowrap">
                                    Xem chi tiết
                                </h6>
                                <ol class="text-success">
                                    <li>Tìm các sản phẩm B2B</li>
                                    <li>Quản lí và tìm kiếm giao dịch</li>
                                    <li>Nhắn tin và quảng cáo sản phẩm</li>
                                </ol>
                                <a href="{{route('show.register.member', \App\Enums\RegisterMember::VENDOR)}}"
                                   class="btn btn-primary">Đăng kí ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-center mt-2 mb-3 member-name">
                            {{\App\Enums\RegisterMember::POWER_VENDOR}}
                        </h5>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-danger text-center">
                                    ${{\App\Enums\RegisterMemberPrice::POWER_VENDOR}}
                                </h3>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Hội viên {{\App\Enums\RegisterMember::POWER_VENDOR}}
                                </h6>
                                <h6 class="text-nowrap">
                                    Xem chi tiết
                                </h6>
                                <ol class="text-success">
                                    <li>Tìm các sản phẩm B2B</li>
                                    <li>Quản lí và tìm kiếm giao dịch</li>
                                    <li>Nhắn tin và quảng cáo sản phẩm</li>
                                </ol>
                                <a href="{{route('show.register.member', \App\Enums\RegisterMember::POWER_VENDOR)}}"
                                   class="btn btn-primary">Đăng kí ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-center mt-2 mb-3 member-name">
                            {{\App\Enums\RegisterMember::PRODUCTION}}
                        </h5>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-danger text-center">
                                    ${{\App\Enums\RegisterMemberPrice::PRODUCTION}}
                                </h3>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Hội viên {{\App\Enums\RegisterMember::PRODUCTION}}
                                </h6>
                                <h6 class="text-nowrap">
                                    Xem chi tiết
                                </h6>
                                <ol class="text-success">
                                    <li>Tìm các sản phẩm B2B</li>
                                    <li>Quản lí và tìm kiếm giao dịch</li>
                                    <li>Nhắn tin và quảng cáo sản phẩm</li>
                                </ol>
                                <a href="{{route('show.register.member', \App\Enums\RegisterMember::PRODUCTION)}}"
                                   class="btn btn-primary">Đăng kí ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-center mt-2 mb-3 member-name">
                            {{\App\Enums\RegisterMember::POWER_PRODUCTION}}
                        </h5>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-danger text-center">
                                    ${{\App\Enums\RegisterMemberPrice::POWER_PRODUCTION}}
                                </h3>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Hội viên {{\App\Enums\RegisterMember::POWER_PRODUCTION}}
                                </h6>
                                <h6 class="text-nowrap">
                                    Xem chi tiết
                                </h6>
                                <ol class="text-success">
                                    <li>Tìm các sản phẩm B2B</li>
                                    <li>Quản lí và tìm kiếm giao dịch</li>
                                    <li>Nhắn tin và quảng cáo sản phẩm</li>
                                </ol>
                                <a href="{{route('show.register.member', \App\Enums\RegisterMember::POWER_PRODUCTION)}}"
                                   class="btn btn-primary">Đăng kí ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script></script>

