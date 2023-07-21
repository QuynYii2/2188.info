@php
    use App\Models\Attribute;
    use App\Models\VoucherItem;
    use App\Models\Properties;use Illuminate\Support\Facades\Auth;
@endphp


@extends('frontend.layouts.master')


@section('title', 'Detail')


@section('content')

    <style>
        #mainDetailProduct > #left-col > .card {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1.5rem;
        }


        .d-flex > svg {
            width: 40px;
            height: 40px;
        }


        .labels > div {
            width: 150px;
            position: absolute;
        }


        .labels > div.label-new {
            left: -40px;
            top: 20px;
            transform: rotate(-45deg);
        }


        .labels > div.label-sale {
            right: -40px;
            top: 20px;
            transform: rotate(45deg);
        }


        .card {
            overflow: hidden;
            box-shadow: 0 3px 17px rgba(0, 0, 0, 0.15), 0 0 5px rgba(0, 0, 0, 0.15);
        }


        .card img {
            width: 100%;
            height: auto !important;
        }


        .description {
            text-align: center;
        }


        .description p {
            text-align: left;
        }


        .btn {
            padding: 8px 16px;
            /*margin: 0 16px;*/
        }


        .btn:hover {
            background-color: #00bf90;
        }


        .link-tabs:hover {
            color: #c69500 !important;
        }


        .text-more-tabs:hover {
            color: #c69500 !important;
        }


        .product-content {
            padding-top: 0;
        }


        .product-content p {
            margin-bottom: 0;
        }


        #img-default {
            cursor: pointer;
        }


        .img-focus {
            cursor: pointer;
        }


        .btn-16 {
            margin: 0 16px;
        }


        .btn-cancel:hover {
            background-color: #cccccc;
        }


        .checked {
            color: orange;
        }


        .list-items-ml-0 {
            margin-left: 0;
        }


        @media only screen and (min-width: 1200px) {
            .tabs-product {


            }


            .img-focus {
                width: 80px;
                height: 80px;
                cursor: pointer;
            }
        }


        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .tabs-product {


            }


            .img-focus {
                width: 80px;
                height: 80px;
            }
        }


        @media only screen and (min-width: 769px) and (max-width: 991px) {
            .tabs-item a {
                font-size: 15px;
            }


            .tabs-product {
                display: flex !important;
            }
        }


        @media only screen and (max-width: 767px) {


            .tabs-item a {
                font-size: 15px;
            }
        }


        @media only screen and (max-width: 767px) {


            .tabs-item a {
                font-size: 15px;
            }


            .img-focus {
                width: 80px;
                height: 80px;
            }
        }


        @media only screen and (max-width: 365px) {


            .tabs-item a {
                font-size: 12px;
            }


            .btn-block {
                display: block;
            }


            .img-focus {
                width: 60px;
                height: 60px;
            }
        }


        .col-2_5 {
            width: 20%;
            position: relative;
            padding-right: 10px;
            padding-left: 10px;
        }


        .col-2_5 .card {
            height: 100%;
        }


        .col-2_5 .card .d-flex {
            height: 100%;
            flex-wrap: wrap;
            align-content: center;
        }


        .tablet-button {
            display: none;
        }


        @media only screen and (min-width: 576px ) and (max-width: 991px) {
            .tablet-button {
                display: block;
            }


            .not-tablet-button {
                display: none !important;
            }
        }


        @media not (min-width: 576px ) and (max-width: 991px) {
            .tablet-button {
                display: none;
            }


            .not-tablet-button {
                display: block !important;
            }
        }


    </style>


    <div class="container-fluid mt-4">
        <a href="{{route('home')}}">Home</a> / <a href="#">Electronics</a> / <a href="#">Televisions</a> / <a href="#">Magnis Darturien </a>
        <div class="detail">
            <div class="tabs-product row mt-4" >
                <div class="product-imgs col-xl-6 py-1">
                    <div class="img-display ">
                        <div class="img-showcase d-flex flex-row bd-highlight">
                            <figure class="zoom" onmousemove="zoom(event)">
                                <img id="img-default" class="img w-100"
                                     src="{{ asset('storage/' . $product->thumbnail) }}"
                                     alt="image" width="360px" height="250px" data-toggle="modal"
                                     data-target="#seeImageProduct">
                            </figure>
                            <div class="modal fade" id="seeImageProduct" tabIndex="-1" role="dialog"
                                 aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row d-flex justify-content-between">
                                                <div class="col-md-10 img-main">
                                                    <img class="img" id="img-modal"
                                                         src="{{ asset('storage/' . $product->thumbnail) }}"
                                                         alt="">
                                                </div>
                                                <div class="col-md-2 img-second">
                                                    <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                         src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                                                    <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                         src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                                         alt="">
                                                    <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                         src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                                         alt="">
                                                    <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                         src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg"
                                                         alt="">
                                                    <img class="img mt-2 img-focus" onclick="zoomImgModal(this)"
                                                         src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                                         alt="">
                                                </div>
                                                <div class="">
                                                    <button class="btn btn-secondary btn-16 btn-cancel mr-5"
                                                            data-dismiss="modal"
                                                            aria-label="Close">Cancel
                                                    </button>
                                                    <button class="btn btn-danger" id="btn-buy-modal"
                                                            onclick="orderClick();">Buy now
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="img-select d-flex flex-row bd-highlight mb-2 mt-2 ">
                        <div class="img-item">
                            <img class="img img-focus" onclick="zoomImg(this)"
                                 src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                 alt="shoe image">
                        </div>
                        <div class="img-item">
                            <img class="img img-focus" onclick="zoomImg(this)"
                                 src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                 alt="shoe image">
                        </div>
                        <div class="img-item">
                            <img class="img img-focus" onclick="zoomImg(this)"
                                 src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg"
                                 alt="shoe image">
                        </div>
                        <div class="img-item">
                            <img class="img img-focus" onclick="zoomImg(this)"
                                 src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                 alt="shoe image">
                        </div>
                    </div>
                </div>
                <div class="product-content col-xl-6 py-1" style="z-index: 88;">
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <h2 class="product-title">{{$product->name}}</h2>
                        <small class="text-warning">{{$product->category->name}}</small>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>4.7(21)</span>
                        </div>
                        <div class="product-price d-flex" style="gap: 3rem">
                            <p class="last-price">{{ __('home.old price') }}:
                                <span>
                                        $
                                        <span id="priceDefault">
                                            {{$product->old_price}}
                                        </span>
                                    </span>
                            </p>
                            <p class="new-price">{{ __('home.new price') }}:
                                <span>
                                        $
                                        <span id="priceDiscount">
                                            {{$product->price}}
                                        </span>
                                        (
                                        <span id="percentDiscount">
                                            5%
                                        </span>
                                        )
                                    </span>
                            </p>
                        </div>
                        <div class="row">
                            @foreach($attributes as $attribute)
                                @php
                                    $att = Attribute::find($attribute->attribute_id);
                                    $properties_id = $attribute->value;
                                    $arrayAtt = array();
                                    $arrayAtt = explode(',', $properties_id);
                                @endphp
                                <div class="col-sm-6 col-6">
                                    <label for="{{$att->name}}">{{$att->name}}</label>
                                    <select id="{{$att->name}}" name="{{$att->name}}" class="form-control">
                                        @foreach($arrayAtt as $data)
                                            @php
                                                $property = Properties::find($data);
                                            @endphp
                                            <option value="{{$data}}">{{$property->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                        <div class="">
                            <input id="product_id" hidden value="{{$product->id}}">
                        </div>
                        <div class="count__wrapper count__wrapper--ml mt-3">
                            <label for="qty">{{ __('home.quantity') }}</label>
                            <input class="product-qty input" type="number" name="quantity" min="1"
                                   max="{{$product->qty}}"
                                   style="width: 55px"
                                   value="1">
                            <label for="qty">Còn lại: {{$product->qty}}</label>

                        </div>
                        <div class="count__wrapper count__wrapper--ml mt-3">
                        </div>
                        <div class="purchase-info d-flex mt-3">
                            <button type="button" class="btn btn-warning">
                                {{ __('home.installment by card') }}
                            </button>
                            <button type="submit" class="btn-danger btn btn-16" id="btn-order-now"><i
                                        class="fa fa-shopping-cart"></i>
                                {{ __('home.buy now') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-4 bg-white">
                <ul class="nav nav-tabs row justify-content-around " id="myTab" role="tablist">
                    <li class="col-sm-4 col-4 nav-item tabs-product-detail tabs-item"><a
                                class="nav-link lead active link-tabs w-100" role="tab" data-toggle="tab"
                                href="#tabDescription">{{ __('home.description') }}</a></li>
                    <li class="col-sm-4 col-4 nav-item tabs-product-detail tabs-item"><a
                                class="nav-link lead link-tabs w-100" role="tab" data-toggle="tab"
                                href="#tabSpecification">{{ __('home.specification') }}</a></li>
                    <li class="col-sm-4 col-4 nav-item tabs-product-detail tabs-item"><a
                                class="nav-link lead link-tabs w-100" role="tab" data-toggle="tab"
                                href="#tabReview">{{ __('home.review') }}</a></li>
                </ul>
                <div class="tab-content mb-5" id="myTabContent">
                    <div class="description tab-pane active show" role="tabpanel" id="tabDescription">
                        <p>
                            Sở hữu thiết kế tinh tế, màn hình xuất sắc và cấu hình mạnh mẽ, đáp ứng được hầu hết nhu
                            cầu
                            của một người sáng tạo chuyên nghiệp. Điều khó có một thế hệ máy tính bảng nào khác có
                            thể
                            làm được, đã xuất hiện trên iPad Pro 12.9 inch Wifi (2020).
                            Màn hình tuyệt đẹp, nhiều công nghệ tích hợp
                            iPad Pro 12.9 inch 2020 có một thiết kế khá vuông vức với viền màn hình 4 cạnh không quá
                            dày
                            và đều nhau, giúp cho trải nghiệm cầm nắm dễ dàng, giúp cho tổng thể mặt trước của iPad
                            hài
                            hòa và đẹp mắt hơn.
                        </p>
                        <div class="collapse" id="more">
                            <p>
                                Tổng thể chiếc máy có khối lượng chỉ 471 g và mỏng 5.9 mm so với kích thước 12.9
                                inch
                                thì điều đó cho thấy iPad Pro 12.9 inch 2020 rất mỏng nhẹ, gọn gàng.
                                Trên tay kích thước iPad Pro 12.9 2020
                                Thật khó lòng khi tìm ra khuyết điểm về màn hình của iPad Pro 12.9 inch 2020, với
                                kích
                                thước 12.9 inch cùng với độ phân giải 2048 x 2732 pixels giúp cho máy hiển thị vô
                                cùng
                                sắc nét và không gian làm việc lớn.
                                Xem thêm: Tìm hiểu về các loại độ phân giải màn hình
                                kích thước màn hình iPad Pro 12.9 2020
                                Máy sử dụng công nghệ màn hình Liquid Retina Display với các công nghệ hỗ trợ như
                                Pro
                                Motion và True Tone, giúp màu sắc được thể hiện một cách tự nhiên, trung thực và
                                sống
                                động.
                                Xem thêm: Màn hình Retina là gì?
                                màn hình hiển thị trên iPad Pro 12.9 2020
                                Hiệu năng mạnh mẽ với chip CPU A12Z với 8 nhân đồ họa
                                iPad Pro 12.9 inch 2020 được trang bị bộ vi xử lý Apple A12Z Bionic mạnh mẽ hơn
                                người
                                tiền nhiệm, giúp cho thao tác sử dụng những phần mềm đồ họa như Photoshop,
                                illustrator
                                mượt mà và phản hồi nhanh chóng hơn.
                                Cấu hình iPad Pro 2020
                                Với việc có thể kết nối với bàn phím, chuột không dây và con trỏ chuột được làm mới,
                                giúp người dùng thao tác và sử dụng một cách dễ dàng.
                                iPad Pro 12.9 2020 kết nối bàn phím
                                Hơn thế nữa, bộ vi xử lý A12Z với 8 nhân đồ hoạ thì máy có thể chiến hầu hết các tựa
                                game hiện có trên thị trường như PUBG, Liên Quân, Asphalt 9,… với mức thiết lập đồ
                                họa
                                cao nhất với tốc độ khung hình ổn định trong suốt quá trình chơi.
                                chơi game với iPad Pro 12.9 2020
                                Bằng việc tích hợp sẵn bộ nhớ trong 128 GB giúp cho người dùng có nhiều không gian
                                lưu
                                trữ hơn, làm được nhiều việc hơn trên chiếc iPad Pro 12.9 inch 2020. Đây là mức dung
                                lượng hoàn hảo cho tùy chọn cơ bản nhất của chiếc máy.
                                Bộ nhớ trên iPad Pro 12.9 2020
                                Cụm camera “Pro”, nâng tầm trải nghiệm AR
                                Apple thật sự ưu ái khi tích hợp cho chiếc máy này với 2 camera sau, 1 camera chính
                                12
                                MP và 1 camera góc siêu rộng 125 độ 10 MP, cùng với đó là camera selfie 7 MP hỗ trợ
                                công
                                nghệ TrueDepth. Giúp bạn hoàn toàn có thể chụp ra những bức ảnh ưng ý nhất.
                                Cụm camera trên iPad Pro 12.9 2020
                                Việc quay video, chụp ảnh và chỉnh sửa trực tiếp một cách chuyên nghiệp để gửi đi
                                khách
                                hàng, đối tác chỉ với một thiết bị duy nhất đã không còn là điều xa vời với người
                                dùng
                                iPad Pro 2020.
                                Hơn thế nữa, iPad Pro 12.9 inch 2020 còn được tích hợp thêm cảm biến Lidar đo chiều
                                sâu,
                                giúp hỗ trợ những ứng dụng AR nhận diện bối cảnh một cách chính xác nhất.
                                Lidar hỗ trợ AR trên iPad Pro 12.9 2020
                                Cảm biến này cực kì hữu ích đặc biệt trong các lĩnh vực thiết kế, thi công bởi người
                                dùng có thể “ướm” thử các mô hình 3D của thiết kế lên thực tế và quan sát nhiều góc
                                độ
                                một cách trực quan nhất bằng công nghệ thực tại ảo AR.
                            </p>
                        </div>
                        <a href="#more" data-toggle="collapse" class="more-link text-center text-more-tabs"
                           id="more-link"
                           onclick="toggleReadMore()">{{ __('home.read more') }}</a>
                    </div>
                    <div class="tab-pane pt-4" role="tabpanel" id="tabSpecification">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td colspan="2"><strong>Memory</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>test 1</td>
                                <td>16GB</td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <td colspan="2"><strong>Processor</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>No. of Cores</td>
                                <td>4</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane pt-4" role="tabpanel" id="tabReview">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="">{{ __('home.write a read') }}</div>
                                <form method="post" action="{{route('create.evaluate')}}">
                                    @csrf
                                    <input type="text" class="form-control" id="product_id" name="product_id"
                                           value="{{$product->id}}" hidden/>
                                    <div class="rating">
                                        <input type="radio" name="star_number" id="star1" value="1" hidden="">
                                        <label for="star1" onclick="starCheck(1)"><i id="icon-star-1"
                                                                                     class="fa fa-star"></i></label>
                                        <input type="radio" name="star_number" id="star2" value="2" hidden="">
                                        <label for="star2" onclick="starCheck(2)"><i id="icon-star-2"
                                                                                     class="fa fa-star"></i></label>
                                        <input type="radio" name="star_number" id="star3" value="3" hidden="">
                                        <label for="star3" onclick="starCheck(3)"><i id="icon-star-3"
                                                                                     class="fa fa-star"></i></label>
                                        <input type="radio" name="star_number" id="star4" value="4" hidden="">
                                        <label for="star4" onclick="starCheck(4)"><i id="icon-star-4"
                                                                                     class="fa fa-star"></i></label>
                                        <input type="radio" name="star_number" id="star5" value="5" hidden="">
                                        <label for="star5" onclick="starCheck(5)"><i id="icon-star-5"
                                                                                     class="fa fa-star"></i></label>
                                    </div>
                                    <input id="input-star" value="0" hidden="">
                                    <div id="text-message" class="text-danger d-none">Please select star rating
                                    </div>

                                    <div class="form-group row">
                                        <label for=""
                                               class="col-sm-12 col-form-label">{{ __('home.your name') }}</label>
                                        <div class="col-sm-12">
                                            <input onclick="checkStar()" type="text" class="form-control" id=""
                                                   name="username"
                                                   placeholder="{{ __('home.your name') }}" required/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for=""
                                               class="col-sm-12 col-form-label">{{ __('home.your review') }}</label>
                                        <div class="col-sm-12">
                                                <textarea onclick="checkStar()" class="form-control" id=""
                                                          name="content"
                                                          placeholder="{{ __('home.your review') }}"
                                                          rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <button id="btn-submit" class="btn btn-primary btn-16" type="submit">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">{{ __('home.write a review') }}</div>
                                @foreach($result as $res)
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <strong>{{$res->username}}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p>{{$res->content}}</p>
                                                <p class="m-0">{{$res->created_at}}</p>
                                            </td>
                                        </tr>
                                        @if($res->status == \App\Enums\EvaluateProductStatus::PENDING)
                                            <tr>
                                                <td colspan="2">
                                                    <p class="text-danger">{{ __('home.wait a review') }}</p>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td colspan="2">
                                                <strong class="mr-2">{{ __('home.customer rating') }}: </strong>
                                                @if($res->star_number == 1)
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                @endif
                                                @if($res->star_number == 2)
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                @endif
                                                @if($res->star_number == 3)
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                @endif
                                                @if($res->star_number == 4)
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star-o"></i></span>
                                                @endif
                                                @if($res->star_number == 5)
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                    <span class="fa fa-stack">
                                                            <i class="fa fa-star"></i></span>
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5 mt-5" id="mainDetailProduct">
            <div class="col-md-12 tablet-button">
                <div class="bg-white rounded mt-5">
                    <div style="border: 1px solid black; border-radius: 5px ">
                        <div class="card-text">
                            <div class="card-header text-center"
                                 style="font-weight: 400; font-size: 1.25rem">{{ __('home.why choose IL') }}
                            </div>
                            <div class="card-body row">
                                <div class="col-2_5 mb-3 mb-md-0">
                                    <div class="card">
                                        <div class="d-flex px-2 py-3 random-color text-center">
                                            <h5 class="">{{ __('home.reputable brand') }}<br>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2_5 mb-3 mb-md-0">
                                    <div class="card">
                                        <div class="d-flex px-2 py-3 random-color text-center">
                                            <h5 class="">{{ __('home.best price') }}<br>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2_5 mb-3 mb-md-0">
                                    <div class="card">
                                        <div class="d-flex px-2 py-3 random-color text-center">
                                            <h5 class="">{{ __('home.genuine products') }}<br>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2_5 mb-3 mb-md-0">
                                    <div class="card">
                                        <div class="d-flex px-2 py-3 random-color text-center">
                                            <h5 class="">{{ __('home.support installment') }}<br>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2_5 mb-3 mb-md-0">
                                    <div class="card">
                                        <div class="d-flex px-2 py-3 random-color text-center">
                                            <div class="">
                                                <div class="d-flex">
                                                    <h5 class="">{{ __('home.super fast delivery') }}<br>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row" id="product-other">
                    @foreach($otherProduct as $product)
                        <div class="product-other mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                            <div class="card h-100">
                                <img class="img" src="{{$product->thumbnail}}" alt="">
                                <div class="card-body position-relative d-flex flex-column">
                                    <h3 class="text-success">${{$product->price}}</h3>
                                    <div class="rating text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <h4>{{$product->name}}</h4>
                                    <p>{{$product->description}}</p>
                                    <a href="{{route('detail_product.show', $product->id)}}"
                                       class="btn btn-success btn-block mt-auto">
                                        <i class="fa fa-eye"></i>
                                        {{ __('home.see now') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                    <path d="M80 0C44.7 0 16 28.7 16 64V448c0 35.3 28.7 64 64 64H304c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H80zm80 432h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H160c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                <h5 class="ml-3 text-center">{{ __('home.phone case') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                    <path d="M80 0C44.7 0 16 28.7 16 64V448c0 35.3 28.7 64 64 64H304c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H80zm80 432h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H160c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                <h5 class="ml-3 text-center">{{ __('home.phone case') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40">
                                    <path d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0H133.9c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0H487.4C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z"/>
                                </svg>
                                <h5 class="ml-3 text-center">{{ __('home.screen protector') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path d="M464 160c8.8 0 16 7.2 16 16V336c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16H464zM80 96C35.8 96 0 131.8 0 176V336c0 44.2 35.8 80 80 80H464c44.2 0 80-35.8 80-80V320c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32V176c0-44.2-35.8-80-80-80H80zm368 96H96V320H448V192z"/>
                                </svg>
                                <h5 class="ml-3 text-center">{{ __('home.power bank') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M256 80C149.9 80 62.4 159.4 49.6 262c9.4-3.8 19.6-6 30.4-6c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48c-44.2 0-80-35.8-80-80V384 336 288C0 146.6 114.6 32 256 32s256 114.6 256 256v48 48 16c0 44.2-35.8 80-80 80c-26.5 0-48-21.5-48-48V304c0-26.5 21.5-48 48-48c10.8 0 21 2.1 30.4 6C449.6 159.4 362.1 80 256 80z"/>
                                </svg>
                                <h5 class="ml-3 text-center">{{ __('home.headphone') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M128 64c0-17.7-14.3-32-32-32S64 46.3 64 64V213.6L23.2 225.2c-17 4.9-26.8 22.6-22 39.6s22.6 26.8 39.6 22L64 280.1V448c0 17.7 14.3 32 32 32H352c17.7 0 32-14.3 32-32s-14.3-32-32-32H128V261.9l136.8-39.1c17-4.9 26.8-22.6 22-39.6s-22.6-26.8-39.6-22L128 195.3V64z"/>
                                </svg>
                                <h5 class="ml-3 text-center">{{ __('home.accessories') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z"/>
                                </svg>
                                <h5 class="ml-3 text-center">{{ __('home.phone charger') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M256 80C141.1 80 48 173.1 48 288V392c0 13.3-10.7 24-24 24s-24-10.7-24-24V288C0 146.6 114.6 32 256 32s256 114.6 256 256V392c0 13.3-10.7 24-24 24s-24-10.7-24-24V288c0-114.9-93.1-208-208-208zM80 352c0-35.3 28.7-64 64-64h16c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H144c-35.3 0-64-28.7-64-64V352zm288-64c35.3 0 64 28.7 64 64v64c0 35.3-28.7 64-64 64H352c-17.7 0-32-14.3-32-32V320c0-17.7 14.3-32 32-32h16z"/>
                                </svg>
                                <h5 class="ml-3 text-center">{{ __('home.bluetooth speaker') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function zoom(e){
        var zoomer = e.currentTarget;
        e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
        e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
        x = offsetX/zoomer.offsetWidth*100
        y = offsetY/zoomer.offsetHeight*100
        zoomer.style.backgroundPosition = x + '% ' + y + '%';
    }
</script>


    <script>
        function createVoucherItems(id) {
            $.ajax({
                url: '/vouchers-item',
                method: 'POST',
                data: {
                    'voucher_id': id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response)
                    if (response == "Error") {
                        alert('Voucher đã có sẵn trong giỏ hàng rồi! Sử dụng thôi!')
                    } else {
                        alert("Nhận voucher thành công")
                    }
                },
                error: function (exception) {
                    console.log(exception)
                    if (exception['status'] == 403) {
                        alert('Error, please try again!')
                    } else if (exception['status'] == 401) {
                        alert('Please login to continue!')
                        window.location.href = '/login';
                    } else {
                        alert('Error, please try again!')
                    }
                }
            });
        }

        {{--function createPromotionItems(id) {--}}
        {{--    $.ajax({--}}
        {{--        url: '/promotions-item',--}}
        {{--        method: 'POST',--}}
        {{--        data: {--}}
        {{--            'promotion_id': id,--}}
        {{--            _token: '{{ csrf_token() }}'--}}
        {{--        },--}}
        {{--        success: function (response) {--}}
        {{--            console.log(response)--}}
        {{--            if (response == "Error") {--}}
        {{--                alert('Bạn đã tham gia chương trình rồi!')--}}
        {{--            } else {--}}
        {{--                alert("Tham gia chương trình thành công!")--}}
        {{--                let btn = document.getElementById('btn-join-now');--}}
        {{--                btn.innerText = "Sử dụng ngay";--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (exception) {--}}
        {{--            console.log(exception)--}}
        {{--            if (exception['status'] == 403) {--}}
        {{--                alert('Error, please try again!')--}}
        {{--            } else if (exception['status'] == 401) {--}}
        {{--                alert('Please login to continue!')--}}
        {{--                window.location.href = '/login';--}}
        {{--            } else {--}}
        {{--                alert('Error, please try again!')--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>
    <script>
        function checkProductReviews() {
            let product_id = document.getElementById('product_id').value;


            const arrayID = [];
            if (localStorage.getItem('productIDs') != null) {
                const oldValue = localStorage.getItem('productIDs');
                const result = oldValue.split(',');
                for (let i = 0; i < result.length; i++) {
                    if (result[i] != product_id) {
                        arrayID.push(result[i])
                    }
                }
                arrayID.push(product_id);
            } else {
                arrayID.push(product_id);
            }
            localStorage.setItem('productIDs', arrayID.toString());
        }


        checkProductReviews();
    </script>
    <script>
        function zoomImg(x) {
            imgDf = document.getElementById('img-default');
            imgDf.src = x.src;
        }

        function normalImg() {
            imgDf = document.getElementById('img-default');
            imgRollback = document.getElementById('img-rollback').value;
            imgDf.src = imgRollback;
        }

        function zoomImgModal(x) {
            imgDf = document.getElementById('img-modal');
            imgDf.src = x.src;
        }

        function orderClick() {
            btnOrder = document.getElementById('btn-order-now');
            btnOrder.click();
        }

        function checkStar() {
            let btn = document.getElementById('btn-submit');
            let input = document.getElementById('input-star');
            let message = document.getElementById('text-message');
            if (input.value == 0) {
                message.classList.remove("d-none");
                btn.disabled = true;
            } else {
                message.classList.add("d-none");
                btn.disabled = false;
            }
        }


        function starCheck(value) {
            let star1 = document.getElementById('star1');
            let star2 = document.getElementById('star2');
            let star3 = document.getElementById('star3');
            let star4 = document.getElementById('star4');
            let star5 = document.getElementById('star5');
            let input = document.getElementById('input-star');
//
            let icon1 = document.getElementById('icon-star-1');
            let icon2 = document.getElementById('icon-star-2');
            let icon3 = document.getElementById('icon-star-3');
            let icon4 = document.getElementById('icon-star-4');
            let icon5 = document.getElementById('icon-star-5');


            switch (value) {
                case 1:
                    star1.checked = true;
                    input.value = 1;
                    icon1.classList.add("checked");
                    break;
                case 2:
                    star2.checked = true;
                    input.value = 2;
                    icon1.classList.add("checked");
                    icon2.classList.add("checked");
                    break;
                case 3:
                    star3.checked = true;
                    input.value = 3;
                    icon1.classList.add("checked");
                    icon2.classList.add("checked");
                    icon3.classList.add("checked");
                    break;
                case 4:
                    star4.checked = true;
                    input.value = 4;
                    icon1.classList.add("checked");
                    icon2.classList.add("checked");
                    icon3.classList.add("checked");
                    icon4.classList.add("checked");
                    break;
                default:
                    star5.checked = true;
                    input.value = 5;
                    icon1.classList.add("checked");
                    icon2.classList.add("checked");
                    icon3.classList.add("checked");
                    icon4.classList.add("checked");
                    icon5.classList.add("checked");
                    break;
            }
            checkStar();
        }

        function toggleReadMore() {
            var moreLink = document.getElementById("more-link");
            var moreContent = document.getElementById("more");
            var readMore = '{{ __("home.read more") }}';
            var readLess = '{{ __("home.read less") }}';


            if (moreContent.classList.contains("show")) {
                moreLink.textContent = readMore;
            } else {
                moreLink.textContent = readLess;
            }
        }

        let urlParams = window.location.href;
        let myParam = urlParams.split('/');
        let num = myParam.length;
        document.getElementById("product_id").value = myParam[num - 1];

        function myFunction(x) {
            let tabs = document.getElementById('id-tabs-product');
            if (x.matches) {
                tabs.classList.remove("card");
                tabs.classList.add("border");
            }
        }

        var x = window.matchMedia("(max-width: 770px)")
        myFunction(x)
        x.addListener(myFunction)

        function responsiveTable(y) {
            let tabs = document.getElementsByClassName('product-other');
            console.log(tabs.length)
            var i;
            for (i = 0; i < tabs.length; i++) {
                if (y.matches) {
                    tabs[i].classList.remove("col-md-3");
                    tabs[i].classList.add("col-sm-6");
                }
            }


        }


        var y = window.matchMedia("(max-width: 991px)")
        responsiveTable(y);
        x.addListener(responsiveTable)


        var elements = document.getElementsByClassName('random-color');


        // for (var i = 0; i < elements.length; i++) {
        // let random_color = Math.floor(Math.random()*16777215).toString(16);
        // elements[i].style.backgroundColor = '#' + random_color;
        // }


        for (var i = 0; i < elements.length; i++) {
            let random_color = getBrightRandomColor();
            elements[i].style.backgroundColor = '#' + random_color;
        }


        // chỉ lấy màu sáng
        function getBrightRandomColor() {
            var minBrightness = 128; // Độ sáng tối thiểu
            var maxBrightness = 255; // Độ sáng tối đa


            var color;
            var brightness;


            do {
                color = Math.floor(Math.random() * 16777215).toString(16);
                brightness = getBrightness(color);
            } while (brightness < minBrightness || brightness > maxBrightness);


            return color;
        }


        function getBrightness(color) {
            var hexColor = color.replace('#', '');
            var red = parseInt(hexColor.substr(0, 2), 16);
            var green = parseInt(hexColor.substr(2, 2), 16);
            var blue = parseInt(hexColor.substr(4, 2), 16);


// Áp dụng công thức để tính độ sáng
            var brightness = (red * 299 + green * 587 + blue * 114) / 1000;
            return brightness;
        }
    </script>
    <script>
        function getPercent() {
            let defaultPrice = document.getElementById('priceDefault');
            let discountPrice = document.getElementById('priceDiscount');
            let percentPrice = document.getElementById('percentDiscount');
            let percent = 100 - (parseFloat(discountPrice.innerText) / parseFloat(defaultPrice.innerText)) * 100;
            percent = parseFloat(percent).toFixed(1);
            percentPrice.innerText = percent + '%'
        }

        getPercent();
    </script>
@endsection

