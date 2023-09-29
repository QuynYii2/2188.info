@extends('backend.layouts.master')
@section('title')
    Seller page
@endsection
@php
    $isAdmin = (new \App\Http\Controllers\Frontend\HomeController())->checkAdmin();
@endphp
@section('content')
    <div class="container">
        @if($isAdmin == true)
            <div class="todo_list">
                <div class="title">{{ __('home.báo cáo thống kê') }}</div>
                <div class="title-small">{{ __('home.toàn bộ thống kê chi tiết') }}</div>
                <div class="card-body">
                    <h3 class="text-center mt-3 mb-3">{{ __('home.lưu lượng người truy cập') }} </h3>
                    <!-- Line Chart -->
                    <div id="reportsChart"></div>
                    <!-- End Line Chart -->
                </div>

                <div class="card-body">
                    <h3 class="text-center mt-3 mb-3">{{ __('home.Tổng số doanh thu') }}</h3>
                    <!-- Line Chart -->
                    <div id="revenueChart"></div>
                    <!-- End Line Chart -->
                </div>

                <div class="card-body">
                    <h3 class="text-center mt-3 mb-3">{{ __('home.tỉ lệ khách hàng') }}</h3>
                    <!-- Line Chart -->
                    <div id="customerChart"></div>
                    <!-- End Line Chart -->
                </div>
            </div>

            <div class="todo_list">
                <div class="title">{{ __('home.duyệt sản phẩm') }}</div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('home.Product Name') }}</th>
                        <th scope="col">{{ __('home.Shop Name') }}</th>
                        <th scope="col">{{ __('home.Status') }}</th>
                        <th scope="col">{{ __('home.Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productAll as $productAllItem)
                        <tr>
                            <th scope="row">{{$loop->index+1}}</th>
                            <td>{{$productAllItem->name}}</td>
                            <td>{{$productAllItem->user->name}}</td>
                            <td id="productStatus{{$productAllItem->id}}">{{$productAllItem->status}}</td>
                            @php
                                $isChecked = false;
                                if ($productAllItem->status == \App\Enums\ProductStatus::ACTIVE){
                                    $isChecked = true;
                                }
                            @endphp
                            <td>
                                <input type="checkbox" class="toggleProduct"
                                       value="{{$productAllItem->id}}" {{ $isChecked ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="todo_list">
            <div class="title">{{ __('home.phân tích bán hàng') }}</div>
            <div class="title-small">{{ __('home.phân tích bán hàng chi tiết') }}</div>
            <div class="full-width" id="listTodoRender">
                <div class="d-flex text-center">
                    <div class="border w-50">
                        <div class="smail">{{ __('home.lượt truy cập') }}</div>
                        <h3 id="countAccess">0</h3>
                        <p class="text-warning">{{ __('home.Vs hôm qua') }} <span id="countAccessPercent">0,00</span>%
                            --</p>
                    </div>
                    <div class="border w-50">
                        <div class="smail">{{ __('home.Lượt xem') }}</div>
                        <h3 id="countViews">0</h3>
                        <p class="text-warning">{{ __('home.Vs hôm qua') }} <span id="countViewPercent">0,00</span>% --
                        </p>
                    </div>
                </div>
                <div class="d-flex text-center">
                    <div class="border w-50">
                        <div class="smail">{{ __('home.Đơn hàng') }}</div>
                        <h3 id="countOrders">0</h3>
                        <p class="text-warning">{{ __('home.Vs hôm qua') }} <span id="countOrderPercent">0,00</span>% --
                        </p>
                    </div>
                    <div class="border w-50">
                        <div class="smail">{{ __('home.tỷ lệ chuyển đổi') }}</div>
                        <h3>0</h3>
                        <p class="text-warning">{{ __('home.Vs hôm qua') }} <span>0,00</span>% --</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="todo_list">
            <div class="title">{{ __('home.Danh sách cần làm') }}</div>
            <div class="title-small">{{ __('home.Những việc cần phải làm') }}</div>
            <div class="row mt-4 todo_list--bottom">
                <div class="col-md-3 col-6 list_item">
                    <span class="number">{{count($productWaitPayments)}}</span>
                    <p>{{ __('home.chờ xác nhận') }}</p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">{{count($productProcessings)}}</span>
                    <p>{{ __('home.đã xử lý') }}  </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">{{count($productShippings)}}</span>
                    <p> {{ __('home.đã lấy hàng') }}</p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">{{count($productDelivereds)}}</span>
                    <p>{{ __('home.đơn thành công') }}  </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">{{count($productCancels)}}</span>
                    <p> {{ __('home.đơn hủy') }} </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">{{count($productCancels)}}</span>
                    <p> {{ __('home.Trả Hàng / Hoàn Tiền Chờ Xử Lý') }} </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">{{count($productPause)}}</span>
                    <p>{{ __('home.sản phẩm hết hàng') }}  </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">{{count($promotions)}}</span>
                    <p>{{ __('home.chương trình khuyến mãi chờ xử lý') }}</p>
                </div>
            </div>
        </div>
        <div class="todo_list">
            <div class="title">{{ __('home.kênh marketing') }}</div>
            <div class="title-small">{{ __('home.công cụ marketing & Đăng ký chương trình khuyến mãi') }}</div>
            <div class="row mt-4 todo_list--bottom">
                <a href="{{route('seller.vouchers.list')}}" class="col-md-4 marketing list_item">
                    <div class="list_item--top">
                        <img src="https://deo.shopeemobile.com/shopee/shopee-seller-live-sg/rootpages/static/modules/marketing/module-icons/voucher.png"
                             alt="">
                        <p>{{ __('home.mã giảm giá của shop') }}</p>
                    </div>
                    <div class="list_item--bottom">
                        <p>{{ __('home.công cụ tăng đơn hàng bằng cách tạo mã giảm giá tặng cho người mua') }}</p>
                    </div>
                </a>
                <a href="{{route('seller.promotion.list')}}" class="col-md-4 marketing list_item">
                    <div class="list_item--top">
                        <img src="https://deo.shopeemobile.com/shopee/shopee-seller-live-sg/rootpages/static/modules/marketing/module-icons/discount.png"
                             alt="">
                        <p> {{ __('home.chương trình của shop') }}</p>
                    </div>
                    <div class="list_item--bottom">
                        <p>{{ __('home.công cụ tăng đơn hàng bằng cách tạo chương trình giảm giá') }}</p>
                    </div>
                </a>
                <a href="{{route('seller.promotion.list')}}" class="col-md-4 marketing list_item">
                    <div class="list_item--top">
                        <img src="https://deo.shopeemobile.com/shopee/shopee-seller-live-sg/rootpages/static/modules/marketing/module-icons/bundle.png"
                             alt="">
                        <p> {{ __('home.Combo Khuyến Mãi ') }}</p>
                    </div>
                    <div class="list_item--bottom">
                        <p>{{ __('home.tạo combo khuyến mãi để tăng giá trị đơn hàng trên mỗi người mua') }}</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="todo_list mb-5">
            <div class="title">{{ __('home.hiệu quả hoạt động') }}</div>
            <div class="title-small">{{ __('home.bảng hiệu quả hoạt động giúp người bán hiểu rõ hơn về hoạt động buôn bán của shop mình dựa trên những chỉ tiêu sau') }}
                :
            </div>
            <ul class="nav" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home" aria-selected="true">{{ __('home.vi phạm về đăng bán') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">{{ __('home.quản lý đơn hàng') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                       aria-controls="contact" aria-selected="false">
                        {{ __('home.Chăm sóc khách hàng') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col-4">{{ __('home.tiêu chí') }}</th>
                            <th scope="col-4">{{ __('home.shop của tôi') }}</th>
                            <th scope="col-4">{{ __('home.chỉ tiêu') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ __('home.Sản phẩm bị khóa/xóa') }}</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>{{ __('home.tỉ lệ hàng đặt trước') }}</td>
                            <td>0.00%</td>
                            <td>≤10.00%</td>
                        </tr>
                        <tr>
                            <td>{{ __('home.các vi phạm khác') }}</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col-4">{{ __('home.tiêu chí') }}</th>
                            <th scope="col-4">{{ __('home.shop của tôi') }}</th>
                            <th scope="col-4">{{ __('home.chỉ tiêu') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ __('home.Tỉ lệ đơn không thành công') }}</td>
                            <td>-</td>
                            <td><10.00%</td>
                        </tr>
                        <tr>
                            <td>{{ __('home.Tỉ lệ hàng đặt trước') }}</td>
                            <td>-</td>
                            <td><10.00%</td>
                        </tr>
                        <tr>
                            <td>{{ __('home.Thời gian chuẩn bị hàng') }}</td>
                            <td>-</td>
                            <td><1.50 days</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col-4">{{ __('home.tiêu chí') }}</th>
                            <th scope="col-4">{{ __('home.shop của tôi') }}</th>
                            <th scope="col-4">{{ __('home.chỉ tiêu') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ __('home.Tỉ lệ phản hồi') }}</td>
                            <td>57.00%</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>{{ __('home.Thời gian phản hồi') }}</td>
                            <td>≥80.00%</td>
                            <td><0.50 days</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var url = `{{ route('admin.toggle.products', ['id' => ':productID']) }}`;
        var urla = `{{route('admin.statistic.access')}}`;
        var urlb = `{{route('admin.statistic.revenues')}}`;
        var urlc = `{{route('admin.statistic.users')}}`;
        var urld = `{{route('shop.statistic.index')}}`;
    </script>
    <script src="{{ asset('js/backend/products-home.js') }}"></script>
@endsection