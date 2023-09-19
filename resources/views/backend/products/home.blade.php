@extends('backend.layouts.master')
@section('title')
    Seller page
@endsection
@php
    $isAdmin = (new \App\Http\Controllers\Frontend\HomeController())->checkAdmin();
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.3/apexcharts.min.js"></script>
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
        $(".toggleProduct").click(function () {
            var productID = $(this).val();

            async function setProduct(productID) {
                let url = '{{ route('admin.toggle.products', ['id' => ':productID']) }}';
                url = url.replace(':productID', productID);

                try {
                    await $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            let status = document.getElementById('productStatus' + productID)
                            status.innerText = response['status'];
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                } catch (error) {
                    throw error;
                }
            }

            setProduct(productID);
        });
    </script>
    <script>
        function getAllStatisticAccess() {
            $.ajax({
                url: '{{route('admin.statistic.access')}}',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    var data = response[0];
                    getChar(data[0], data[1])
                },
                error: function (exception) {
                    console.log(exception)
                }
            });
        }

        getAllStatisticAccess();

        getAllStatisticRevenue();

        function getChar(data, datatime) {
            document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#reportsChart"), {
                    series: [{
                        name: 'Access',
                        data: data,
                    }],
                    chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                            show: false
                        },
                    },
                    markers: {
                        size: 4
                    },
                    colors: ['#4154f1'],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: datatime
                    },
                    tooltip: {
                        x: {
                            format: 'dd/MM/yy HH:mm'
                        },
                    }
                }).render();
            });
        }

        function getAllStatisticRevenue() {
            $.ajax({
                url: '{{route('admin.statistic.revenues')}}',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    var data = response[0];
                    getRevenueChar(data[0], data[1])
                },
                error: function (exception) {
                    console.log(exception)
                }
            });

            function getRevenueChar(data, datatime) {
                document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#revenueChart"), {
                        series: [{
                            name: 'Net Profit',
                            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                        }, {
                            name: 'Revenue',
                            data: data
                        }, {
                            name: 'Free Cash Flow',
                            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                        }],
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: datatime,
                        },
                        yaxis: {
                            title: {
                                text: '$ (thousands)'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "$ " + val + " thousands"
                                }
                            }
                        }
                    }).render();
                });
            }
        }

        getAllStatisticUser();

        function getAllStatisticUser() {
            $.ajax({
                url: '{{route('admin.statistic.users')}}',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    let customerChart = [];
                    customerChart.push(response[0], response[1])
                    localStorage.setItem('item', customerChart);
                },
                error: function (exception) {
                    console.log(exception)
                }
            });
        }

        var item = localStorage.getItem('item');
        console.log(item)
        arrayItem = item.split(',');

        getCustomerChart(parseInt(arrayItem[0]), parseInt(arrayItem[1]));

        function getCustomerChart(customerChart, testChart) {
            document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#customerChart"), {
                    series: [customerChart, testChart],
                    chart: {
                        height: 350,
                        type: 'pie',
                        toolbar: {
                            show: true
                        }
                    },
                    labels: ['Buyer', 'Seller']
                }).render();
            });
        }

        function getAllStatisticShops() {
            var access = document.getElementById('countAccess')
            var accessPercent = document.getElementById('countAccessPercent')
            var views = document.getElementById('countViews')
            var viewPercent = document.getElementById('countViewPercent')
            var orders = document.getElementById('countOrders')
            var orderPercent = document.getElementById('countOrderPercent')

            var listTodoRender = $('#listTodoRender');
            $.ajax({
                url: '{{route('shop.statistic.index')}}',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // listTodoRender.append(response);

                    var nowShop = response[0][0];
                    var perShop = response[1][1];

                    access.innerText = nowShop[0];
                    views.innerText = nowShop[1];
                    orders.innerText = nowShop[2];

                    accessPercent.innerText = (parseFloat(nowShop[0]) / parseFloat(perShop[0]) * 100).toFixed(2)
                    viewPercent.innerText = (parseFloat(nowShop[1]) / parseFloat(perShop[1]) * 100).toFixed(2)
                    orderPercent.innerText = (parseFloat(nowShop[2]) / parseFloat(perShop[2]) * 100).toFixed(2)

                },
                error: function (exception) {
                    console.log(exception)
                }
            });
        }

        getAllStatisticShops();
    </script>
@endsection