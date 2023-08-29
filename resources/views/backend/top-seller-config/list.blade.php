@extends('backend.layouts.master')
@section('title', 'List Top Seller')
<style>
    select{
        max-width: 0;
    }
    .CTA h1 {
        color: #ffffff;
        margin-top: 10px;
        margin-left: 9px;
    }

    nav a {
        list-style: none;
        padding: 35px;
        color: #ffffff;
        display: block;
        transition: all 0.3s ease-in-out;
    }
    nav a :hover {
        color: #3fb6a8;
        transform: scale(1.2);
        cursor: pointer;
    }
    nav a :first-child {
        margin-top: 7px;
    }

    footer {
        position: absolute;
        width: 20%;
        bottom: 0;
        right: -20px;
        text-align: right;
        font-size: 0.8em;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    footer p {
        border: none;
        padding: 0;
    }
    footer a {
        color: #ffffff;
        text-decoration: none;
    }
    footer a:hover {
        color: #7d7d7d;
    }


</style>
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách marketing</h5>
            <a href="{{ route('seller.config.processCreate') }}" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Thêm mới</a>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="height: 100%">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông tin thanh toán</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span style="color: #e11d1d; font-size: 14px">Vui lòng thanh toán trước khi tạo</span>
                        <div class="mt-1">
                            <div class="rightbox">
                                <form id="checkout" action="">
                                    <div class="profile">
                                        <h2>Tên tài khoản</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="text"
                                                placeholder="Nhập tên tài khoản" required
                                        />
                                        <h2>Tên ngân hàng</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="text"
                                                placeholder="Nhập tên ngân hàng" required
                                        />
                                        <h2>Số tài khoản</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="number"
                                                placeholder="Nhập số tài khoản" required
                                        />
                                        <h2>Số điện thoại</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="number"
                                                placeholder="Nhập số điện thoại" required
                                        />
                                        <h2>Số tiền</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="number"
                                                placeholder="Nhập số tiền" required
                                        />
                                        <h2>Nhập mã OTP</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="number"
                                                placeholder="Nhập mã OTP" required
                                        />
                                        <div class="text-center mt-3">
{{--                                            <input class="btn btn-success" onclick="location();" type="button" name="thanhtoan" value="Thanh toán" />--}}
                                            <a href="{{ route('seller.config.processCreate') }}" class="btn btn-success" type="button" value="Thanh toán" >Thanh toán</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($configs->isEmpty())
            Không có configs nào được tạo
        @else
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Thumbnail banner</th>
                        <th>Location</th>
                        <th>Url redirect</th>
                        <th>Thêm</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($configs as $config)
                        <tr>
                            <td class="">{{$loop->index + 1}}</td>
                            <td>
                                <img src="{{ asset('storage/'.$config->thumbnail) }}" style="width: 100px" class="img img-100"
                                     alt="Thumbnail">
                            </td>
                            <td>
                               Location: {{$config->local}}
                            </td>
                            <td class="">
                                <a href="{{$config->url}}">link</a>
                            </td>
                            <td>
                                <form method="post" action="{{route('seller.config.delete', $config->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        Xoá
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <script>
        {{--function location() {--}}
        {{--    window.location.redirect('{{route('seller.config.processCreate')}}');--}}
        {{--}--}}
    </script>
    <script>
        /*active button class onclick*/
        $("nav a").click(function (e) {
            e.preventDefault();
            $("nav a").removeClass("active");
            $(this).addClass("active");
            if (this.id === !"payment") {
                $(".payment").addClass("noshow");
            } else if (this.id === "payment") {
                $(".payment").removeClass("noshow");
                $(".rightbox").children().not(".payment").addClass("noshow");
            } else if (this.id === "profile") {
                $(".profile").removeClass("noshow");
                $(".rightbox").children().not(".profile").addClass("noshow");
            } else if (this.id === "subscription") {
                $(".subscription").removeClass("noshow");
                $(".rightbox").children().not(".subscription").addClass("noshow");
            } else if (this.id === "privacy") {
                $(".privacy").removeClass("noshow");
                $(".rightbox").children().not(".privacy").addClass("noshow");
            } else if (this.id === "settings") {
                $(".settings").removeClass("noshow");
                $(".rightbox").children().not(".settings").addClass("noshow");
            }
        });

    </script>
@endsection
