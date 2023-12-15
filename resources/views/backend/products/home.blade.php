@extends('backend.layouts.master')
@section('title')
    Seller page
@endsection
@php
    $isAdmin = (new \App\Http\Controllers\Frontend\HomeController())->checkAdmin();
@endphp
@section('content')
    <div class="product-home-seller">
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
                            <td scope="row">{{$loop->index+1}}</td>
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
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group d-flex justify-content-between check-value_address">
                                            <div>
                                                <input id="default{{$productAllItem->id}}" type="checkbox" name="default" class="mr-2 custom-checkbox toggleProduct" value="{{$productAllItem->id}}" {{ $isChecked ? 'checked' : '' }}>
                                                <label for="default{{$productAllItem->id}}"></label>
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
        <div class="todo_list">
            <div class="title title-sales">{{ __('home.phân tích bán hàng') }}</div>
            <div class="title-small title-small-sales">{{ __('home.phân tích bán hàng chi tiết') }}</div>
            <div class="full-width d-flex flex-wrap" id="listTodoRender">
                <div class="d-flex col-md-3 col-6">
                    <div class="border-product_home w-100 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M35.6944 10.6957L20.3472 1.66797L5 10.6957V28.7513L20.3472 37.7791L35.6944 28.7513V10.6957Z" stroke="#FEB95A" stroke-width="3" stroke-linejoin="round"/>
                            <path d="M13.125 21.5289V25.14M20.3472 17.9178V25.14V17.9178ZM27.5694 14.3066V25.14V14.3066Z" stroke="#FEB95A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <h3 class="mt-3" id="countAccess">0</h3>
                        <div class="smail">{{ __('home.lượt truy cập') }}</div>
                        <p class="mt-3 text-warning--1"><span id="countAccessPercent">0,00</span>%
                            {{ __('home.Vs hôm qua') }}</p>
                    </div>
                </div>
                <div class="d-flex col-md-3 col-6">
                    <div class="border-product_home w-100 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M31.7134 5.24074H28.0946V3.62184C28.0946 3.09807 27.5233 2.86001 26.9995 2.86001H24.1902C23.5236 0.955392 21.8571 0.00308302 19.9524 0.00308302C18.0688 -0.0677318 16.3555 1.08727 15.7147 2.86001H12.953C12.4292 2.86001 11.9054 3.09807 11.9054 3.62184V5.24074H8.28658C6.14209 5.26361 4.38766 6.95533 4.28687 9.09755V36.3811C4.28687 38.4762 6.19148 39.9999 8.28658 39.9999H31.7134C33.8085 39.9999 35.7131 38.4762 35.7131 36.3811V9.09764C35.6123 6.95533 33.8579 5.26361 31.7134 5.24074ZM13.81 4.76463H16.4288C16.886 4.70885 17.2532 4.36107 17.3336 3.90756C17.6156 2.67956 18.6929 1.79806 19.9524 1.76489C21.2003 1.80271 22.2614 2.68694 22.5236 3.90756C22.609 4.37674 23.0005 4.72899 23.476 4.76463H26.1901V8.57387H13.81V4.76463ZM33.8085 36.3812C33.8085 37.4288 32.7609 38.0954 31.7134 38.0954H8.28658C7.23903 38.0954 6.19148 37.4288 6.19148 36.3812V9.09764C6.28864 8.00726 7.19201 7.16541 8.28658 7.14545H11.9053V9.57384C11.9556 10.1074 12.4177 10.5065 12.9529 10.4786H26.9994C27.5444 10.5084 28.021 10.1147 28.0945 9.57384V7.14536H31.7133C32.8078 7.16541 33.7112 8.00717 33.8084 9.09755V36.3812H33.8085Z" fill="#00BFA6"/>
                            <path d="M16.3336 21.2871C15.9764 20.9106 15.3834 20.8894 15.0003 21.2396L11.9529 24.1441L10.6673 22.8108C10.3101 22.4343 9.71715 22.4131 9.334 22.7632C8.96516 23.1496 8.96516 23.7576 9.334 24.1441L11.2862 26.1439C11.4552 26.3331 11.6992 26.4377 11.9528 26.4296C12.204 26.4261 12.4436 26.3234 12.6194 26.1439L16.3334 22.6204C16.7016 22.2826 16.7262 21.7103 16.3883 21.3422C16.371 21.3229 16.3527 21.3046 16.3336 21.2871Z" fill="#00BFA6"/>
                            <path d="M29.9993 23.334H19.0478C18.5218 23.334 18.0955 23.7603 18.0955 24.2863C18.0955 24.8123 18.5218 25.2386 19.0478 25.2386H29.9993C30.5252 25.2386 30.9516 24.8123 30.9516 24.2863C30.9516 23.7603 30.5252 23.334 29.9993 23.334Z" fill="#00BFA6"/>
                            <path d="M16.3336 13.668C15.9764 13.2915 15.3834 13.2703 15.0003 13.6204L11.9529 16.5249L10.6673 15.1916C10.3101 14.8151 9.71715 14.7939 9.334 15.1441C8.96516 15.5305 8.96516 16.1385 9.334 16.5249L11.2862 18.5248C11.4552 18.714 11.6992 18.8186 11.9528 18.8105C12.204 18.8069 12.4436 18.7042 12.6194 18.5248L16.3334 15.0013C16.7016 14.6635 16.7262 14.0911 16.3883 13.723C16.371 13.7038 16.3527 13.6855 16.3336 13.668Z" fill="#00BFA6"/>
                            <path d="M29.9993 15.7168H19.0478C18.5218 15.7168 18.0955 16.1431 18.0955 16.6691C18.0955 17.1951 18.5218 17.6214 19.0478 17.6214H29.9993C30.5252 17.6214 30.9516 17.1951 30.9516 16.6691C30.9516 16.1431 30.5252 15.7168 29.9993 15.7168Z" fill="#00BFA6"/>
                            <path d="M16.3336 28.9062C15.9764 28.5297 15.3834 28.5086 15.0003 28.8587L11.9529 31.7632L10.6673 30.4299C10.3101 30.0534 9.71715 30.0322 9.334 30.3823C8.96516 30.7687 8.96516 31.3767 9.334 31.7632L11.2862 33.763C11.4552 33.9522 11.6992 34.0568 11.9528 34.0487C12.204 34.0452 12.4436 33.9425 12.6194 33.763L16.3334 30.2395C16.7016 29.9017 16.7262 29.3294 16.3883 28.9613C16.371 28.9421 16.3527 28.9238 16.3336 28.9062Z" fill="#00BFA6"/>
                            <path d="M29.9993 30.9531H19.0478C18.5218 30.9531 18.0955 31.3795 18.0955 31.9054C18.0955 32.4314 18.5218 32.8577 19.0478 32.8577H29.9993C30.5252 32.8577 30.9516 32.4314 30.9516 31.9054C30.9516 31.3795 30.5252 30.9531 29.9993 30.9531Z" fill="#00BFA6"/>
                        </svg>
                        <h3 class="mt-3" id="countViews">0</h3>
                        <div class="smail">{{ __('home.Lượt xem') }}</div>
                        <p class="mt-3 text-warning--2"><span id="countViewPercent">0,00</span>% {{ __('home.Vs hôm qua') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex col-md-3 col-6">
                    <div class="border-product_home w-100 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M38.4706 33.5873L31.7059 26.8226C31.2941 26.4108 30.647 26.4108 30.2353 26.8226L29.7059 27.352L27.7647 25.4108C29.4117 23.352 30.5882 20.8814 30.9411 18.1167C29.7059 18.1167 28.4117 17.8226 27.3529 17.2344L26.5882 17.352C26 21.5873 22.9411 24.9991 18.8823 26.0579V30.5873C21.4117 30.1167 23.7647 29.0579 25.647 27.4697L27.5882 29.4108L27 29.9991C26.5882 30.4108 26.5882 31.0579 27 31.4697L33.7647 38.2344C34.1764 38.6461 34.8235 38.6461 35.2353 38.2344L38.4706 34.9991C38.8823 34.6461 38.8823 33.9991 38.4706 33.5873Z" fill="#000AFF"/>
                            <path d="M8.82359 23.4118C6.88241 21.5294 5.70594 18.8824 5.70594 15.9412C5.70594 10.1765 10.4118 5.47059 16.1765 5.47059C18.8236 5.47059 21.2354 6.47059 23.0589 8.05882C23.4118 6.64706 24.1177 5.35294 25.1765 4.29412C25.2353 4.23529 25.2354 4.23529 25.2942 4.17647C22.7648 2.17647 19.5883 1 16.1177 1C7.88241 1 1.23535 7.64706 1.23535 15.8824C1.23535 18.5882 1.94123 21.1176 3.23535 23.3529H8.82359V23.4118Z" fill="#000AFF"/>
                            <path d="M17.0001 24.2949H13.1765V27.942C13.1765 28.6479 12.5883 29.2361 11.8824 29.2361C11.5883 29.2361 11.2942 29.1185 11.0589 28.942L9.58829 27.7655L8.1177 28.942C7.58829 29.3537 6.88241 29.2949 6.41182 28.8832C6.17653 28.6479 6.00006 28.2949 6.00006 27.942V24.2949H2.17653C1.64712 24.2949 1.23535 24.7067 1.23535 25.2361V37.8832C1.23535 38.4126 1.64712 38.8243 2.17653 38.8243H16.9412C17.4706 38.8243 17.8824 38.4126 17.8824 37.8832V25.2949C17.9412 24.7655 17.5295 24.2949 17.0001 24.2949ZM8.17653 36.4714C8.17653 36.589 8.05888 36.7067 7.94123 36.7067H3.76476C3.58829 36.7067 3.52947 36.589 3.52947 36.4714V34.5302C3.52947 34.4126 3.64712 34.2949 3.76476 34.2949H7.94123C8.05888 34.2949 8.17653 34.4126 8.17653 34.5302V36.4714Z" fill="#000AFF"/>
                            <path d="M6.88232 27.942C6.88232 28.2949 7.29409 28.4714 7.52938 28.2361L9.29409 26.8243C9.47056 26.7067 9.64703 26.7067 9.8235 26.8243L11.5882 28.2361C11.8823 28.4714 12.2353 28.2361 12.2353 27.942V24.2949H6.88232V27.942Z" fill="#000AFF"/>
                            <path d="M30.8824 14.6472C33.4118 14.6472 35.4707 12.5883 35.4707 10.0589C35.4707 7.52953 33.4118 5.4707 30.8824 5.4707C28.353 5.4707 26.2942 7.52953 26.2942 10.0589C26.353 12.5883 28.4118 14.6472 30.8824 14.6472ZM29.353 9.23541C29.5883 9.11776 29.8236 9.17659 29.9412 9.41188L30.353 10.0589L32.0589 9.05894C32.2942 8.94129 32.5295 9.00011 32.6471 9.23541C32.7648 9.4707 32.706 9.706 32.4707 9.82364L30.353 11.0589C30.2942 11.1178 30.2354 11.1178 30.1177 11.1178C29.9412 11.1178 29.8236 11.0589 29.7648 10.8825L29.1765 9.82364C29.0589 9.64717 29.1177 9.41188 29.353 9.23541Z" fill="#000AFF"/>
                            <path d="M24.5882 13.5299L23.8824 16.5887C23.8235 16.7652 24 16.9416 24.1765 16.8828L27.4118 16.2946C30.1765 17.824 33.6471 17.4122 36 15.0593C38.8235 12.3534 38.8235 7.76517 36 5.00046C33.1765 2.17693 28.6471 2.17693 25.8235 5.00046C23.5294 7.29458 23.1176 10.824 24.5882 13.5299ZM30.8824 4.5887C33.8824 4.5887 36.3529 7.05928 36.3529 10.0593C36.3529 13.0593 33.8824 15.5299 30.8824 15.5299C27.8824 15.5299 25.4118 13.0593 25.4118 10.0593C25.4118 7.05928 27.8824 4.5887 30.8824 4.5887Z" fill="#000AFF"/>
                            <path d="M10.1766 17.058C10.4119 17.058 10.6472 16.8815 10.6472 16.5874V12.1757C10.6472 11.9404 10.4708 11.7051 10.1766 11.7051C9.88252 11.7051 9.70605 11.8815 9.70605 12.1757V16.5874C9.70605 16.8227 9.94135 17.058 10.1766 17.058Z" fill="#000AFF"/>
                            <path d="M13 12.1757C13 11.9404 12.8235 11.7051 12.5294 11.7051C12.2353 11.7051 12.0588 11.8815 12.0588 12.1757V15.5874C12.0588 15.8227 12.2353 16.058 12.5294 16.058C12.8235 16.058 13 15.8815 13 15.5874V12.1757Z" fill="#000AFF"/>
                            <path d="M15.353 12.1757C15.353 11.9404 15.1766 11.7051 14.8825 11.7051C14.5883 11.7051 14.4119 11.8815 14.4119 12.1757V16.5874C14.4119 16.8227 14.5883 17.058 14.8825 17.058C15.1766 17.058 15.353 16.8815 15.353 16.5874V12.1757Z" fill="#000AFF"/>
                            <path d="M17.7058 12.1757C17.7058 11.9404 17.5294 11.7051 17.2352 11.7051C16.9411 11.7051 16.7646 11.8815 16.7646 12.1757V14.1757C16.7646 14.411 16.9411 14.6463 17.2352 14.6463C17.5294 14.6463 17.7058 14.4698 17.7058 14.1757V12.1757Z" fill="#000AFF"/>
                            <path d="M20.0589 12.1757C20.0589 11.9404 19.8824 11.7051 19.5883 11.7051C19.2941 11.7051 19.1177 11.8815 19.1177 12.1757V16.2933C19.1177 16.5286 19.2941 16.7639 19.5883 16.7639C19.8824 16.7639 20.0589 16.5874 20.0589 16.2933V12.1757Z" fill="#000AFF"/>
                            <path d="M22.4707 12.1757C22.4707 11.9404 22.2942 11.7051 22.0001 11.7051C21.706 11.7051 21.5295 11.8815 21.5295 12.1757V16.5874C21.5295 16.8227 21.706 17.058 22.0001 17.058C22.2942 17.058 22.4707 16.8815 22.4707 16.5874V12.1757Z" fill="#000AFF"/>
                            <path d="M9.70605 19.7066C9.70605 19.9419 9.88252 20.1772 10.1766 20.1772C10.4708 20.1772 10.6472 20.0007 10.6472 19.7066V19.2948C10.6472 19.0595 10.4708 18.8242 10.1766 18.8242C9.88252 18.8242 9.70605 19.0007 9.70605 19.2948V19.7066Z" fill="#000AFF"/>
                            <path d="M13 19.8833V19.2362C13 19.0009 12.8235 18.7656 12.5294 18.7656C12.2353 18.7656 12.0588 18.9421 12.0588 19.2362V19.8833C12.0588 20.1186 12.2353 20.3539 12.5294 20.3539C12.8235 20.3539 13 20.1774 13 19.8833Z" fill="#000AFF"/>
                            <path d="M14.8825 18.8242C14.6472 18.8242 14.4119 19.0007 14.4119 19.2948V19.7066C14.4119 19.9419 14.5883 20.1772 14.8825 20.1772C15.1766 20.1772 15.353 20.0007 15.353 19.7066V19.2948C15.353 19.0007 15.1766 18.8242 14.8825 18.8242Z" fill="#000AFF"/>
                            <path d="M17.2941 18.8242C17.0588 18.8242 16.8235 19.0007 16.8235 19.2948V19.7066C16.8235 19.9419 17 20.1772 17.2941 20.1772C17.5882 20.1772 17.7647 20.0007 17.7647 19.7066V19.2948C17.7058 19.0007 17.5294 18.8242 17.2941 18.8242Z" fill="#000AFF"/>
                            <path d="M19.6471 18.8242C19.4118 18.8242 19.1765 19.0007 19.1765 19.2948V19.7066C19.1765 19.9419 19.353 20.1772 19.6471 20.1772C19.9412 20.1772 20.1177 20.0007 20.1177 19.7066V19.2948C20.0589 19.0007 19.8824 18.8242 19.6471 18.8242Z" fill="#000AFF"/>
                            <path d="M22.0001 18.8242C21.7648 18.8242 21.5295 19.0007 21.5295 19.2948V19.7066C21.5295 19.9419 21.706 20.1772 22.0001 20.1772C22.2942 20.1772 22.4707 20.0007 22.4707 19.7066V19.2948C22.4707 19.0007 22.2354 18.8242 22.0001 18.8242Z" fill="#000AFF"/>
                        </svg>
                        <h3 class="mt-3" id="countOrders">0</h3>
                        <div class="smail">{{ __('home.Đơn hàng') }}</div>
                        <p class="mt-3 text-warning--3"><span id="countOrderPercent">0,00</span>% {{ __('home.Vs hôm qua') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex col-md-3 col-6">
                    <div class="border-product_home w-100 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <g clip-path="url(#clip0_319_20676)">
                                <path d="M19.9999 40.001C30.1348 39.9392 38.3688 31.8016 38.5499 21.6681C38.7309 11.5346 30.7928 3.10802 20.6666 2.6843V1.2883C20.6686 0.825889 20.4236 0.397596 20.0239 0.164964C19.642 -0.0571169 19.1697 -0.0548206 18.7899 0.170964L15.2979 2.21696C14.9063 2.45307 14.6668 2.87699 14.6668 3.3343C14.6668 3.7916 14.9063 4.21553 15.2979 4.45163L18.7906 6.49763C19.1702 6.72301 19.6421 6.72531 20.0239 6.50363C20.4236 6.271 20.6686 5.84271 20.6666 5.3803V4.01763C30.1463 4.38251 37.5715 12.3003 37.3275 21.7839C37.0835 31.2675 29.261 38.7931 19.7751 38.67C10.2891 38.547 2.66448 30.821 2.66659 21.3343C2.66659 20.9661 2.36811 20.6676 1.99992 20.6676C1.63173 20.6676 1.33325 20.9661 1.33325 21.3343C1.34501 31.6387 9.69548 39.9892 19.9999 40.001ZM16.0139 3.34296L19.3333 1.40096L19.3473 3.26363C19.3414 3.28693 19.3367 3.31051 19.3333 3.3343C19.3368 3.36128 19.3422 3.38801 19.3493 3.4143L19.3639 5.28896L16.0139 3.34296Z" fill="#20AEF3"/>
                                <path d="M2.09786 19.3268C2.1316 19.332 2.16572 19.3345 2.19986 19.3341C2.52992 19.3337 2.81001 19.0919 2.85853 18.7654C2.89053 18.5494 2.9252 18.3354 2.96653 18.1228C3.02786 17.7636 2.78956 17.4218 2.43139 17.3551C2.07323 17.2884 1.72787 17.5216 1.65586 17.8788C1.6132 18.1074 1.57386 18.3381 1.53986 18.5694C1.48568 18.9324 1.7351 19.271 2.09786 19.3268Z" fill="#20AEF3"/>
                                <path d="M2.79995 15.9622C2.96668 16.0214 3.15008 16.0118 3.30975 15.9357C3.46943 15.8595 3.59229 15.723 3.65129 15.5562C3.72817 15.3402 3.80862 15.1262 3.89262 14.9142C3.98098 14.693 3.94459 14.4414 3.79715 14.2542C3.64971 14.0671 3.41362 13.9728 3.17782 14.0069C2.94201 14.041 2.74232 14.1983 2.65395 14.4196C2.56506 14.6476 2.47862 14.878 2.39462 15.1109C2.33546 15.2776 2.34493 15.4609 2.42094 15.6205C2.49696 15.7802 2.6333 15.9031 2.79995 15.9622Z" fill="#20AEF3"/>
                                <path d="M4.25869 12.571C4.40975 12.6631 4.59123 12.6914 4.76317 12.6496C4.93511 12.6079 5.08339 12.4995 5.17535 12.3483C5.30869 12.131 5.44535 11.917 5.58535 11.7063C5.79044 11.4003 5.70865 10.9861 5.40269 10.781C5.09672 10.5759 4.68244 10.6577 4.47735 10.9636C4.32535 11.1908 4.17824 11.4212 4.03602 11.655C3.84462 11.9694 3.9443 12.3795 4.25869 12.571Z" fill="#20AEF3"/>
                                <path d="M6.66649 9.90781C6.85464 9.90789 7.03406 9.82847 7.16049 9.68914C7.33049 9.50114 7.50582 9.31714 7.68449 9.13647C7.94388 8.87506 7.94224 8.45286 7.68082 8.19347C7.41941 7.93408 6.99721 7.93573 6.73782 8.19714C6.54449 8.39181 6.35605 8.59047 6.17249 8.79314C5.9952 8.98851 5.9498 9.27006 6.0567 9.51126C6.16359 9.75245 6.40267 9.90793 6.66649 9.90781Z" fill="#20AEF3"/>
                                <path d="M9.33315 7.49999C9.4758 7.49899 9.61437 7.45225 9.72849 7.36666C9.90626 7.23643 10.0854 7.10955 10.2658 6.98599C10.5705 6.77925 10.6499 6.36467 10.4432 6.05999C10.2364 5.75531 9.82183 5.67592 9.51715 5.88266C9.32026 6.01599 9.12671 6.1531 8.93648 6.29399C8.7021 6.46427 8.60453 6.76643 8.69504 7.04164C8.78556 7.31684 9.04345 7.50208 9.33315 7.49999Z" fill="#20AEF3"/>
                                <path d="M12.1138 5.81596C12.2147 5.81589 12.3143 5.7931 12.4052 5.74929C12.5829 5.66307 12.7607 5.57996 12.9385 5.49996C13.1559 5.40278 13.305 5.19698 13.3296 4.96007C13.3542 4.72316 13.2505 4.49113 13.0576 4.3514C12.8647 4.21166 12.6119 4.18545 12.3945 4.28262C12.2012 4.36929 12.0105 4.45796 11.8205 4.54929C11.5403 4.68497 11.3914 4.99645 11.4616 5.2997C11.5318 5.60295 11.8025 5.81724 12.1138 5.81596Z" fill="#20AEF3"/>
                                <path d="M8.66667 31.3346H31.3333C31.7015 31.3346 32 31.0362 32 30.668C32 30.2998 31.7015 30.0013 31.3333 30.0013H29.3333V16.0013C29.3333 15.2649 28.7364 14.668 28 14.668H26.6667C25.9303 14.668 25.3333 15.2649 25.3333 16.0013V30.0013H24V18.668C24 17.9316 23.403 17.3346 22.6667 17.3346H21.3333C20.597 17.3346 20 17.9316 20 18.668V30.0013H18.6667V21.3346C18.6667 20.5983 18.0697 20.0013 17.3333 20.0013H16C15.2636 20.0013 14.6667 20.5983 14.6667 21.3346V30.0013H13.3333V25.3346C13.3333 24.5983 12.7364 24.0013 12 24.0013H10.6667C9.93029 24.0013 9.33333 24.5983 9.33333 25.3346V30.0013H8.66667C8.29848 30.0013 8 30.2998 8 30.668C8 31.0362 8.29848 31.3346 8.66667 31.3346ZM26.6667 16.0013H28V30.0013H26.6667V16.0013ZM21.3333 18.668H22.6667V30.0013H21.3333V18.668ZM16 21.3346H17.3333V30.0013H16V21.3346ZM10.6667 25.3346H12V30.0013H10.6667V25.3346Z" fill="#20AEF3"/>
                                <path d="M9.42733 21.0085C9.54742 21.2105 9.765 21.3343 10 21.3345C10.1198 21.3347 10.2373 21.3022 10.34 21.2405L26.9713 11.3665L26.6867 12.5058C26.6437 12.6774 26.6707 12.859 26.7618 13.0107C26.8528 13.1624 27.0004 13.2717 27.172 13.3145C27.2247 13.3279 27.2789 13.3346 27.3333 13.3345C27.6389 13.3342 27.9051 13.1262 27.9793 12.8298L28.646 10.1631C28.6889 9.99155 28.6619 9.80992 28.5709 9.65825C28.4799 9.50658 28.3323 9.3973 28.1607 9.35448L25.494 8.68782C25.2608 8.62385 25.0112 8.69123 24.8418 8.86388C24.6724 9.03653 24.6098 9.28737 24.6783 9.51935C24.7467 9.75133 24.9354 9.92805 25.1713 9.98115L26.238 10.2478L9.65934 20.0945C9.50734 20.1849 9.3975 20.332 9.35399 20.5034C9.31048 20.6748 9.33686 20.8565 9.42733 21.0085Z" fill="#20AEF3"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_319_20676">
                                    <rect width="40" height="40" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <h3 class="mt-3">0</h3>
                        <div class="smail">{{ __('home.tỷ lệ chuyển đổi') }}</div>
                        <p class="mt-3 text-warning--4"><span>0,00</span>% {{ __('home.Vs hôm qua') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="todo_list">
            <div class="title">{{ __('home.Danh sách cần làm') }}</div>
            <div class="title-small">{{ __('home.Những việc cần phải làm') }}</div>
            <div class="row mt-4 todo_list--bottom col-md-12">
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
        var urlToggleProduct = `{{ route('admin.toggle.products', ['id' => ':productID']) }}`;
        var urla = `{{route('admin.statistic.access')}}`;
        var urlb = `{{route('admin.statistic.revenues')}}`;
        var urlc = `{{route('admin.statistic.users')}}`;
        var urld = `{{route('shop.statistic.index')}}`;
        var token = `{{ csrf_token() }}`;
    </script>
    <script src="{{ asset('js/backend/products-home.js') }}"></script>
@endsection