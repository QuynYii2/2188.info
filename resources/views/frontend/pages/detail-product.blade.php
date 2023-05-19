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
    </style>
    <div class="container">
        <div class="row mb-5 mt-5" id="mainDetailProduct">
            <div class="col-8" id="left-col">
                <div class="card">
                    <div class="product-imgs" id="product">
                        <div class="img-display">
                            <div class="img-showcase">
                                <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg"
                                     alt="shoe image">
                                <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                     alt="shoe image">
                                <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                     alt="shoe image">
                                <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg"
                                     alt="shoe image">
                            </div>
                        </div>
                        <div class="img-select">
                            <div class="img-item">
                                <a href="#" data-id="1">
                                    <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg"
                                         alt="shoe image">
                                </a>
                            </div>
                            <div class="img-item">
                                <a href="#" data-id="2">
                                    <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                                         alt="shoe image">
                                </a>
                            </div>
                            <div class="img-item">
                                <a href="#" data-id="3">
                                    <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                                         alt="shoe image">
                                </a>
                            </div>
                            <div class="img-item">
                                <a href="#" data-id="4">
                                    <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg"
                                         alt="shoe image">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h2 class="product-title">nike shoes</h2>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.7(21)</span>
                        </div>

                        <div class="product-price">
                            <p class="last-price">Old Price: <span>$257.00</span></p>
                            <p class="new-price">New Price: <span>$249.00 (5%)</span></p>
                        </div>

                        {{--                        <div class="product-detail">--}}
                        {{--                            <h2>about this item: </h2>--}}
                        {{--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eveniet veniam tempora--}}
                        {{--                                fuga tenetur placeat sapiente architecto illum soluta consequuntur, aspernatur--}}
                        {{--                                quidem at sequi ipsa!</p>--}}
                        {{--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, perferendis--}}
                        {{--                                eius. Dignissimos, labore suscipit. Unde.</p>--}}
                        {{--                            <ul>--}}
                        {{--                                <li>Color: <span>Black</span></li>--}}
                        {{--                                <li>Available: <span>in stock</span></li>--}}
                        {{--                                <li>Category: <span>Shoes</span></li>--}}
                        {{--                                <li>Shipping Area: <span>All over the world</span></li>--}}
                        {{--                                <li>Shipping Fee: <span>Free</span></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}

                        <div class="row">
                            <div class="col-md-6">
                                <label for="size">Size</label>
                                <select id="size" name="size" class="form-control">
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="color">Color</label>
                                <select id="color" name="color" class="form-control">
                                    <option>Blue</option>
                                    <option>Green</option>
                                    <option>Red</option>
                                </select>
                            </div>
                        </div>

                        <div class="count__wrapper count__wrapper--ml mt-3">
                            <label for="qty">Quantity</label>
                            <input class="product-qty input" type="number" name="product-qty" min="0"
                                   style="width: 55px"
                                   value="1">
                        </div>

                        <div class="purchase-info">
                            <button type="button" class="btn">
                                Trả góp qua thẻ
                            </button>
                            <button type="button" class="btn mt-2"><i class="fas fa-shopping-cart"></i>
                                Mua ngay
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4 bg-white">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link lead active" role="tab" data-toggle="tab"
                               href="#tabDescription">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lead" role="tab" data-toggle="tab"
                               href="#tabSpecification">Specification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lead" role="tab" data-toggle="tab" href="#tabReview">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
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

                            <a href="#more" data-toggle="collapse" class="more-link" id="more-link"
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
                                    <div class="">Write a read</div>
                                    <form>
                                        <div class="rating">
                                            <input type="radio" name="rating" id="star1">
                                            <label for="star1"><i class="fas fa-star"></i></label>
                                            <input type="radio" name="rating" id="star2">
                                            <label for="star2"><i class="fas fa-star"></i></label>
                                            <input type="radio" name="rating" id="star3">
                                            <label for="star3"><i class="fas fa-star"></i></label>
                                            <input type="radio" name="rating" id="star4">
                                            <label for="star4"><i class="fas fa-star"></i></label>
                                            <input type="radio" name="rating" id="star5">
                                            <label for="star5"><i class="fas fa-star"></i></label>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-12 col-form-label">Your Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="" name=""
                                                       placeholder="Your Name"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-12 col-form-label">Your Review</label>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="" name="" placeholder="Your Review"
                                                      rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header">Write a review</div>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <strong>Ilea Heidemann</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p>Quaerat et sit sequi unde nostrum, accusantium accusamus ad placeat.
                                                    Libero sit ut sit ut in consequuntur, sed recusandae esse; qui eum
                                                    alias
                                                    fuga ratione ut reiciendis commodi et laboriosam? Earum eveniet et
                                                    neque
                                                    est alias commodi voluptatem veniam est. Ad aut sit excepturi unde
                                                    laudantium voluptatem reiciendis nostrum eos. Molestiae omnis
                                                    consectetur, culpa in sed aliquam porro quas asperiores. Eum modi, a
                                                    incidunt dolor ut molestiae aut accusamus aspernatur! Tenetur sed
                                                    eveniet nesciunt, quam reprehenderit modi repellat quasi voluptatem.
                                                    Sit
                                                    quia nulla similique omnis in ipsa quasi ipsam consectetur!</p>
                                                <p class="m-0">18/03/2013</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <strong>Customer Rating: </strong>
                                                <span class="fa fa-stack">
												<i class="fas fa-star fa-stack-1x"></i>
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                                <span class="fa fa-stack">
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                                <span class="fa fa-stack">
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                                <span class="fa fa-stack">
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                                <span class="fa fa-stack">
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <strong>Jelea lehwe</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p>Libero sit ut sit ut in consequuntur, sed recusandae esse; qui eum
                                                    alias
                                                    fuga ratione ut reiciendis commodi et laboriosam? Earum eveniet et
                                                    neque
                                                    est alias commodi voluptatem veniam est. Ad aut sit excepturi unde
                                                    laudantium voluptatem reiciendis nostrum eos. Molestiae omnis
                                                    consectetur, culpa in sed aliquam porro quas asperiores.</p>
                                                <p class="m-0">18/03/2013</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <strong>Customer Rating: </strong>
                                                <span class="fa fa-stack">
												<i class="fas fa-star fa-stack-1x"></i>
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                                <span class="fa fa-stack">
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                                <span class="fa fa-stack">
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                                <span class="fa fa-stack">
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                                <span class="fa fa-stack">
												<i class="far fa-star fa-stack-1x"></i>
											</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white rounded p-2">
                    <div class="purchase-info">
                        <div class="btn p-3 text-center text-uppercase text-white text-bold fw-bold"
                             style="border-radius: 5px; background-color: red">
                            Thu cũ đổi mới
                            <br>
                            <span style="font-size: 1.25rem">trợ giá 1.000.000đ</span>
                        </div>
                    </div>

                    <div>
                        <div class="p-3 text-center text-uppercase text-white text-bold fw-bold"
                             style="border-radius: 5px 5px 0 0; background-color: #00bf90">
                            {{ __('home.promotion information') }}
                        </div>
                        <div class="product-detail"
                             style="border: 1px solid black; border-top: none; border-radius: 0 0 5px 5px ">
                            <ul class="pt-3">
                                <li>Tích điểm đổi quà giảm đến 10% cho thành viên.</li>
                                <li>Miễn phí quẹt thẻ Tín dụng Visa Mastercard.</li>
                                <li>Miễn phí trả góp 0% lãi suất cho thẻ tín dụng</li>
                                <li>Miễn phí giao hàng toàn quốc.</li>
                                <li>Giảm ngay 50k khi mua Apple Pencil</li>
                                <li>Giảm ngay 200k khi mua combo bao da + kính cường lực</li>
                                <li>Giảm ngay 100k khi mua sim số đẹp chọn số</li>
                                <li>Giảm ngay 50k khi mua kèm tai nghe Airpods</li>
                                <li>Giảm ngay 50k khi mua Smart keyboard</li>
                                <li>Giảm ngay 50k khi mua Magic mouse</li>
                                <li>Giảm ngay 50k khi mua kèm Airtag</li>
                                <li>Giảm ngay 1 triệu khi thu cũ lên đời máy mới</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded p-2 mt-5">
                    <div class="card"
                         style="border: 1px solid black; border-radius: 5px ">
                        <div class="card-text">
                            <div class="card-header" style="font-weight: 400; font-size: 1.25rem">{{ __('home.product status') }}
                            </div>
                            <div class="card-body">
                                <ul class="pt-3">
                                    <li><span class="text-bold">{{ __('home.condition') }}</span><br>Máy likenew chính hãng
                                        Apple Việt Nam
                                    </li>
                                    <li><span class="text-bold">{{ __('home.box included') }}</span><br>Thân máy</li>
                                    <li><span class="text-bold">{{ __('home.warranty') }}</span><br>Bảo hành 1 tháng</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded p-2 mt-5">
                    <div class="card"
                         style="border: 1px solid black; border-radius: 5px ">
                        <div class="card-text">
                            <div class="card-header" style="font-weight: 400; font-size: 1.25rem">{{ __('home.why choose IL') }}
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="list-group-item list-group-item-action row">

                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40">
                                                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0H133.9c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0H487.4C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z"/>
                                            </svg>
                                            <h5 class="mb-1 ml-3">{{ __('home.reputable brand') }}<br>
                                                <span style="font-weight: normal; font-size: 14px">{{ __('home.years of service') }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="border-bottom my-3"></div>
                                    <div class="list-group-item list-group-item-action row">

                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M312 24V34.5c6.4 1.2 12.6 2.7 18.2 4.2c12.8 3.4 20.4 16.6 17 29.4s-16.6 20.4-29.4 17c-10.9-2.9-21.1-4.9-30.2-5c-7.3-.1-14.7 1.7-19.4 4.4c-2.1 1.3-3.1 2.4-3.5 3c-.3 .5-.7 1.2-.7 2.8c0 .3 0 .5 0 .6c.2 .2 .9 1.2 3.3 2.6c5.8 3.5 14.4 6.2 27.4 10.1l.9 .3 0 0c11.1 3.3 25.9 7.8 37.9 15.3c13.7 8.6 26.1 22.9 26.4 44.9c.3 22.5-11.4 38.9-26.7 48.5c-6.7 4.1-13.9 7-21.3 8.8V232c0 13.3-10.7 24-24 24s-24-10.7-24-24V220.6c-9.5-2.3-18.2-5.3-25.6-7.8c-2.1-.7-4.1-1.4-6-2c-12.6-4.2-19.4-17.8-15.2-30.4s17.8-19.4 30.4-15.2c2.6 .9 5 1.7 7.3 2.5c13.6 4.6 23.4 7.9 33.9 8.3c8 .3 15.1-1.6 19.2-4.1c1.9-1.2 2.8-2.2 3.2-2.9c.4-.6 .9-1.8 .8-4.1l0-.2c0-1 0-2.1-4-4.6c-5.7-3.6-14.3-6.4-27.1-10.3l-1.9-.6c-10.8-3.2-25-7.5-36.4-14.4c-13.5-8.1-26.5-22-26.6-44.1c-.1-22.9 12.9-38.6 27.7-47.4c6.4-3.8 13.3-6.4 20.2-8.2V24c0-13.3 10.7-24 24-24s24 10.7 24 24zM568.2 336.3c13.1 17.8 9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5H192 32c-17.7 0-32-14.3-32-32V416c0-17.7 14.3-32 32-32H68.8l44.9-36c22.7-18.2 50.9-28 80-28H272h16 64c17.7 0 32 14.3 32 32s-14.3 32-32 32H288 272c-8.8 0-16 7.2-16 16s7.2 16 16 16H392.6l119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5zM193.6 384l0 0-.9 0c.3 0 .6 0 .9 0z"/>
                                            </svg>
                                            <h5 class="mb-1 ml-3">{{ __('home.best price') }}<br>
                                                <span style="font-weight: normal; font-size: 14px">{{ __('home.money back') }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="border-bottom my-3"></div>

                                    <div class="list-group-item list-group-item-action row">

                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path d="M400 0H176c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8H24C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9H192c-17.7 0-32 14.3-32 32s14.3 32 32 32H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H357.9C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24H446.4c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112h84.4c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6h84.4c-5.1 66.3-31.1 111.2-63 142.3z"/>
                                            </svg>
                                            <h5 class="mb-1 ml-3">{{ __('home.genuine products') }}<br>
                                                <span style="font-weight: normal; font-size: 14px">{{ __('home.full VAT') }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="border-bottom my-3"></div>

                                    <div class="list-group-item list-group-item-action row">

                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                <path d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zm64 320H64V320c35.3 0 64 28.7 64 64zM64 192V128h64c0 35.3-28.7 64-64 64zM448 384c0-35.3 28.7-64 64-64v64H448zm64-192c-35.3 0-64-28.7-64-64h64v64zM288 160a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/>
                                            </svg>
                                            <h5 class="mb-1 ml-3">{{ __('home.support installment') }}<br>
                                                <span style="font-weight: normal; font-size: 14px">{{ __('home.up to 0%') }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="border-bottom my-3"></div>

                                    <div class="list-group-item list-group-item-action row">

                                        <div class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                <path d="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 272c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 48c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 240c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64V416c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H112zM544 237.3V256H416V160h50.7L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"/>
                                            </svg>
                                            <h5 class="mb-1 ml-3">{{ __('home.super fast delivery') }}<br>
                                                <span style="font-weight: normal; font-size: 14px">{{ __('home.nationwide') }}</span></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mt-5 row">

                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card h-100">

                            <img src="https://picsum.photos/300/200" alt="">
                            <div class="card-body position-relative d-flex flex-column">

                                <h3 class="text-success">$1120.00</h3>
                                <div class="rating text-warning">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </div>
                                <h4>Macbook M1</h4>
                                <p>Sở hữu thiết kế tinh tế, màn hình xuất sắc và cấu hình mạnh mẽ, đáp ứng được hầu hết
                                    nhu cầu ...</p>
                                <a href="#" class="btn btn-success btn-block mt-auto">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    Product Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card h-100">

                            <img src="https://picsum.photos/300/200" alt="">
                            <div class="card-body position-relative d-flex flex-column">

                                <h3 class="text-success">$1120.00</h3>
                                <div class="rating text-warning">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </div>
                                <h4>Macbook M1</h4>
                                <p>Sở hữu thiết kế tinh tế, màn hình xuất sắc và cấu hình mạnh mẽ, đáp ứng được hầu hết
                                    nhu cầu ...</p>
                                <a href="#" class="btn btn-success btn-block mt-auto">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    Product Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card h-100">

                            <img src="https://picsum.photos/300/200" alt="">
                            <div class="card-body position-relative d-flex flex-column">

                                <h3 class="text-success">$1120.00</h3>
                                <div class="rating text-warning">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </div>
                                <h4>Macbook M1</h4>
                                <p>Sở hữu thiết kế tinh tế, màn hình xuất sắc và cấu hình mạnh mẽ, đáp ứng được hầu hết
                                    nhu cầu ...</p>
                                <a href="#" class="btn btn-success btn-block mt-auto">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    Product Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card h-100">

                            <img src="https://picsum.photos/300/200" alt="">
                            <div class="card-body position-relative d-flex flex-column">

                                <h3 class="text-success">$1120.00</h3>
                                <div class="rating text-warning">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </div>
                                <h4>Macbook M1</h4>
                                <p>Sở hữu thiết kế tinh tế, màn hình xuất sắc và cấu hình mạnh mẽ, đáp ứng được hầu hết
                                    nhu cầu ...</p>
                                <a href="#" class="btn btn-success btn-block mt-auto">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    Product Detail
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-12">
                <div class="mt-5 row">
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z"/></svg>
                                <h5 class="ml-3 text-center">Sạc, cáp kết nối
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M80 0C44.7 0 16 28.7 16 64V448c0 35.3 28.7 64 64 64H304c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H80zm80 432h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H160c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>                                <h5 class="ml-3 text-center">Ốp điện thoại
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0H133.9c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0H487.4C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z"/>
                                </svg>
                                <h5 class="ml-3 text-center">Dán màn hình
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 160c8.8 0 16 7.2 16 16V336c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16H464zM80 96C35.8 96 0 131.8 0 176V336c0 44.2 35.8 80 80 80H464c44.2 0 80-35.8 80-80V320c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32V176c0-44.2-35.8-80-80-80H80zm368 96H96V320H448V192z"/></svg>
                                <h5 class="ml-3 text-center">Pin dự phòng
                                </h5>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="mt-3 row">
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 80C149.9 80 62.4 159.4 49.6 262c9.4-3.8 19.6-6 30.4-6c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48c-44.2 0-80-35.8-80-80V384 336 288C0 146.6 114.6 32 256 32s256 114.6 256 256v48 48 16c0 44.2-35.8 80-80 80c-26.5 0-48-21.5-48-48V304c0-26.5 21.5-48 48-48c10.8 0 21 2.1 30.4 6C449.6 159.4 362.1 80 256 80z"/></svg>
                                <h5 class="ml-3 text-center">Tai nghe
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M128 64c0-17.7-14.3-32-32-32S64 46.3 64 64V213.6L23.2 225.2c-17 4.9-26.8 22.6-22 39.6s22.6 26.8 39.6 22L64 280.1V448c0 17.7 14.3 32 32 32H352c17.7 0 32-14.3 32-32s-14.3-32-32-32H128V261.9l136.8-39.1c17-4.9 26.8-22.6 22-39.6s-22.6-26.8-39.6-22L128 195.3V64z"/></svg>
                                <h5 class="ml-3 text-center">Phụ kiện
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z"/></svg>
                                <h5 class="ml-3 text-center">Sạc điện thoại
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mb-3 mb-md-0">
                        <div class="card">
                            <div class="d-flex px-3 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 80C141.1 80 48 173.1 48 288V392c0 13.3-10.7 24-24 24s-24-10.7-24-24V288C0 146.6 114.6 32 256 32s256 114.6 256 256V392c0 13.3-10.7 24-24 24s-24-10.7-24-24V288c0-114.9-93.1-208-208-208zM80 352c0-35.3 28.7-64 64-64h16c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H144c-35.3 0-64-28.7-64-64V352zm288-64c35.3 0 64 28.7 64 64v64c0 35.3-28.7 64-64 64H352c-17.7 0-32-14.3-32-32V320c0-17.7 14.3-32 32-32h16z"/></svg>
                                <h5 class="ml-3 text-center">Loa Bluetooth
                                </h5>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/compiled.js') }}"></script>
    <script>

        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });


        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;
            document.querySelector('.img-showcase').style.transform = `translateX(${-(imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);

        var wrapper = document.querySelector('.count__wrapper'),
            res = document.querySelector('.subtotal__price'),
            input = wrapper.querySelector('input[class*=input]');

        wrapper.addEventListener('click', e => {
            var t = e.target;

            input.value = +input.value;

            if (t.closest('button[class*=--minus]')) {
                --input.value;
            } else if (t.closest('button[class*=--add]')) {
                ++input.value;
            }

        });

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

    </script>
@endsection
