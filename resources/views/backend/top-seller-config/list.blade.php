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
            <h5 class="card-title">{{ __('home.danh sách marketing') }}</h5>
            <a href="{{ route('seller.config.processCreate') }}" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">{{ __('home.thêm mới') }}</a>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="height: 100%">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Thông tin thanh toán') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span style="color: #e11d1d; font-size: 14px">{{ __('home.Vui lòng thanh toán trước khi tạo') }}</span>
                        <div class="mt-1">
                            <div class="rightbox">
                                <form id="checkout" action="">
                                    <div class="profile">
                                        <h2>{{ __('home.Tên tài khoản') }}</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="text"
                                                placeholder="Nhập tên tài khoản" required
                                        />
                                        <h2>{{ __('home.Tên ngân hàng') }}</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="text"
                                                placeholder="Nhập tên ngân hàng" required
                                        />
                                        <h2>{{ __('home.Số tài khoản') }}</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="number"
                                                placeholder="Nhập số tài khoản" required
                                        />
                                        <h2>{{ __('home.Số điện thoại') }}</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="number"
                                                placeholder="Nhập số điện thoại" required
                                        />
                                        <h2>{{ __('home.Số tiền') }}</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="number"
                                                placeholder="Nhập số tiền" required
                                        />
                                        <h2>{{ __('home.Nhập mã OTP') }}</h2>
                                        <input
                                                style="width: 100%; height: 20px"
                                                id="cardnumber"
                                                type="number"
                                                placeholder="Nhập mã OTP" required
                                        />
                                        <div class="text-center mt-3">
{{--                                            <input class="btn btn-success" onclick="location();" type="button" name="thanhtoan" value="Thanh toán" />--}}
                                            <a href="{{ route('seller.config.processCreate') }}" class="btn btn-success" type="button" value="Thanh toán" >{{ __('home.Thanh toán') }}</a>
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
            {{ __('home.Không có configs nào được tạo') }}
        @else
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>{{ __('home.thumbnail') }}</th>
                        <th>{{ __('home.Name') }}</th>
                        <th>{{ __('home.Qty Products') }}</th>
                        <th>{{ __('home.Atc') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $list_Setups = \App\Models\SetupMarketing::all();
                    @endphp
                    @foreach($list_Setups as $list_Setup)
                        <tr>
                            <td class="">{{$loop->index + 1}}</td>
                            <td>
                                <img src="{{ asset('storage/'.$list_Setup->thumbnail) }}" style="width: 100px; height: 100px; object-fit: cover" class="img img-100"
                                     alt="Thumbnail">
                            </td>
                            <td>
                              {{$list_Setup->name}}
                            </td>
                            <td>
                                @php
                                    $topSeller = \App\Models\TopSellerConfig::where('local', $list_Setup->id)->get();
                                   $arrayProduct = null;

                                   foreach ($topSeller as $item) {
                                       $listProduct = $item->product;
                                       $arrayProductItem = explode(',', $listProduct);
                                       foreach ($arrayProductItem as $value) {
                                           $arrayProduct[] = $value;
                                       }
                                   }
                                   $products = null;
                                   if ($arrayProduct){
                                       $products = \App\Models\Product::whereIn('id', $arrayProduct)->get();
                                   }
                                @endphp
                                @if($products)
                                    {{count($products)}}
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                <a href="#" class="mr-2" style="color: black" data-toggle="modal" data-target="#exampleModal_eye{{$list_Setup->id}}">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <div class="modal fade" id="exampleModal_eye{{$list_Setup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <a href="{{ route('detail-marketing.show', $list_Setup->id) }}">{{ __('home.Xem chi tiết') }}</a>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">{{ __('home.thumbnail') }}</th>
                                                        <th scope="col">{{ __('home.Name') }}</th>
                                                        <th scope="col">{{ __('home.Act') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($products)
                                                        @foreach($products as $productMkt)
                                                            <tr>
                                                                <th scope="row">{{$loop->index + 1}}</th>
                                                                <td>
                                                                    <img src="{{ asset('storage/'.$productMkt->thumbnail) }}" style="width: 100px; height: 100px; object-fit: cover" class="img img-100"
                                                                         alt="Thumbnail">
                                                                </td>
                                                                <td>{{$productMkt->name}}</td>
                                                                <td>
                                                                    <form method="post" action="{{route('detail-marketing.delete',
                                                                    [
                                                                        'id' => $list_Setup->id,
                                                                        'product' => $productMkt->id,
                                                                    ])}}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn">
                                                                            <i class="fa-solid fa-trash-can" style="color: red"></i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
