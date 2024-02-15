@extends('frontend.layouts.master')
@section('title', 'Home page')
@section('content')
    <style>
        body {
            background: #f5f5f5;
        }

        @media (min-width: 1900px) {
            .col-xl-2 {
                max-width: 14%;
            }

            .col-xl-8 {
                max-width: 72%;
            }
        }

        .swiper {
            width: 100%;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    @php
        $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
    @endphp
    <link rel="stylesheet" href="{{asset('css/frontend.css')}}">
    <div class="body m-3" id="body-content">
        <section class="section-First pt-3 pb-3 container-fluid bg-white">
            <div class="row m-0">
                <div class="section-First-category col-xl-3 col-md-2 col-12">
                    <div class="show-list-category">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-2" width="16" height="17" viewBox="0 0 16 17"
                             fill="none">
                            <path d="M2 8.5H10M2 4.5H14M2 12.5H14" stroke="black" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>All Categories</span>
                    </div>
                    <ul class="m-auto all-category">
                        @foreach($categoriesParent as $category)
                            <li class="category-item" data-toggle="modal"
                                data-target="#modalCategory_{{ $category->id }}">
                                <a href="{{ route('category.show', $category->id) }}" class="category-item-name">
                                    {{($category->{'name' . $langDisplay->getLangDisplay()})}}
                                </a>
                            </li>
                            @php
                                $categoryChilds = \App\Models\Category::where('parent_id', $category->id)
                                        ->where('status', \App\Enums\CategoryStatus::ACTIVE)
                                        ->orderBy('id', 'desc')
                                        ->get();
                            @endphp
                            <div class="category-hover">

                            </div>
                            <div class="modal fade" id="modalCategory_{{ $category->id }}" tabindex="-1"
                                 aria-labelledby="modalCategoryLabel" aria-hidden="true">
                                <div class="modal-dialog modal-category">
                                    <div class="modal-content ">
                                        <div class="modal-body">
                                            <div class="row list-category-child">
                                                @foreach($categoryChilds as $categoryChild)
                                                    <div class="col-md-6 show-category-child">
                                                        <div class="category-child">
                                                            <a href="{{ route('category.show', $categoryChild->id) }}"
                                                               class="category-item-name">
                                                                {{($categoryChild->{'name' . $langDisplay->getLangDisplay()})}}
                                                            </a>
                                                        </div>
                                                        @php
                                                            $categoryChild2s = \App\Models\Category::where('parent_id', $category->id)
                                                                    ->where('status', \App\Enums\CategoryStatus::ACTIVE)
                                                                    ->orderBy('id', 'desc')
                                                                    ->get();
                                                        @endphp
                                                        <ul class="list-group-flush">
                                                            @foreach($categoryChild2s as $categoryChild2)
                                                                <li class="category-item">
                                                                    <a href="{{ route('category.show', $categoryChild2->id) }}"
                                                                       class="category-item-name">
                                                                        {{($categoryChild2->{'name' . $langDisplay->getLangDisplay()})}}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
                <div class="section-First-middle col-xl-6 col-md-8 col-12">
                    <!-- Swiper -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @if(!$banner)
                                <div class="swiper-slide">
                                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/742w/carousel/17/slideshow-home2-1.jpg?c=1"
                                         alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/740w/carousel/18/slideshow-home2-2.jpg?c=1"
                                         alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/740w/carousel/19/slideshow-home2-3.jpg?c=1"
                                         alt="">
                                </div>
                            @else
                                @php
                                    $listBanner = $banner->thumbnails;
                                    $arrayThumbnails = explode(',', $listBanner);
                                @endphp
                                @foreach($arrayThumbnails as $bannerdemo)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $bannerdemo) }}" alt="">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="section-First-posted col-xl-3 col-md-2">
                    <p class="list-item-posted-title pl-2">
                        You may like it
                    </p>
                    <div class="list-item-posted">
                        @foreach($posts as $post)
                            <div class="border list-item d-flex align-items-center p-2 m-2">
                                @php
                                    $thumbnails = $post->thumbnails;
                                    $thumbnailArray = explode(',', $thumbnails);
                                    $image = $thumbnailArray[0];
                                @endphp
                                <img src="{{ asset('storage/' . $image) }}" alt="" class="posted-image">
                                <div class="posted-content ml-3">
                                    <div class="posted-title">{{ $post->product_name }}</div>
                                    <div class="posted-value">{{ $post->purchase_quantity }} products</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="list-item-posted-bottom pl-2">
                        No desirable products?
                    </p>
                    <div class="btn-my-posted d-flex align-items-center justify-content-between">
                        <a href="{{ route('processCreate.post.rfq') }}" class="btnPosted w-100 bg-white">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32"
                                     viewBox="0 0 33 32"
                                     fill="none">
                                <g clip-path="url(#clip0_187_12220)">
                                    <path d="M26.7768 5.72324C24.0317 2.97824 20.3821 1.46643 16.5 1.46643C12.6179 1.46643 8.96825 2.97824 6.22325 5.72324C3.47825 8.46831 1.9665 12.118 1.9665 16C1.9665 19.882 3.47825 23.5317 6.22325 26.2767C8.96831 29.0217 12.618 30.5335 16.5 30.5335C20.382 30.5335 24.0317 29.0217 26.7768 26.2767C29.5218 23.5317 31.0335 19.882 31.0335 16C31.0335 12.118 29.5218 8.46831 26.7768 5.72324ZM24.8015 24.3015C22.5841 26.5189 19.6359 27.7401 16.5 27.7401C13.3641 27.7401 10.4159 26.5189 8.1985 24.3015C5.98106 22.0841 4.75987 19.1359 4.75987 16C4.75987 12.8641 5.98106 9.91593 8.1985 7.69849C10.4159 5.48106 13.3641 4.25987 16.5 4.25987C19.6359 4.25987 22.5841 5.48106 24.8015 7.69849C27.0189 9.91593 28.2401 12.8641 28.2401 16C28.2401 19.1359 27.0189 22.0841 24.8015 24.3015Z"
                                          fill="#FF8086"/>
                                    <path d="M26.7768 5.72324C24.0318 2.97824 20.3821 1.46643 16.5 1.46643C16.1858 1.46643 15.8733 1.47737 15.5625 1.49706C19.0917 1.72031 22.3789 3.20037 24.9018 5.72324C27.6468 8.46831 29.1585 12.118 29.1585 16C29.1585 19.882 27.6468 23.5317 24.9018 26.2767C22.3789 28.7996 19.0917 30.2796 15.5625 30.5029C15.8733 30.5225 16.1858 30.5335 16.5 30.5335C20.3821 30.5335 24.0318 29.0217 26.7768 26.2767C29.5218 23.5317 31.0335 19.882 31.0335 16C31.0335 12.118 29.5218 8.46831 26.7768 5.72324Z"
                                          fill="#E5646E"/>
                                    <path d="M16.5 2.93294C16.2411 2.93294 16.0312 2.72306 16.0312 2.46419V0.46875C16.0312 0.209875 16.2411 0 16.5 0C16.7589 0 16.9688 0.209875 16.9688 0.46875V2.46419C16.9688 2.72306 16.7589 2.93294 16.5 2.93294Z"
                                          fill="#655E68"/>
                                    <path d="M16.5 32C16.2411 32 16.0312 31.7901 16.0312 31.5312V29.5358C16.0312 29.2769 16.2411 29.067 16.5 29.067C16.7589 29.067 16.9688 29.2769 16.9688 29.5358V31.5312C16.9688 31.7901 16.7589 32 16.5 32Z"
                                          fill="#655E68"/>
                                    <path d="M2.96419 16.4688H0.96875C0.709875 16.4688 0.5 16.2589 0.5 16C0.5 15.7411 0.709875 15.5312 0.96875 15.5312H2.96419C3.22306 15.5312 3.43294 15.7411 3.43294 16C3.43294 16.2589 3.22306 16.4688 2.96419 16.4688Z"
                                          fill="#655E68"/>
                                    <path d="M32.0312 16.4688H30.0358C29.7769 16.4688 29.5671 16.2589 29.5671 16C29.5671 15.7411 29.7769 15.5312 30.0358 15.5312H32.0312C32.2901 15.5312 32.5 15.7411 32.5 16C32.5 16.2589 32.2901 16.4688 32.0312 16.4688Z"
                                          fill="#655E68"/>
                                    <path d="M8.21056 20.8745C8.09319 21.3972 8.34544 21.9307 8.81419 22.19C9.97225 22.8305 11.304 23.1953 12.721 23.1953C14.1383 23.1953 15.4702 22.8304 16.6285 22.1898C17.0973 21.9305 17.3496 21.397 17.2321 20.8743C16.7684 18.8101 14.9255 17.2679 12.7214 17.2679C10.5171 17.268 8.67419 18.8103 8.21056 20.8745Z"
                                          fill="#A4CCFF"/>
                                    <path d="M16.6285 22.1899C17.0973 21.9306 17.3496 21.3971 17.2321 20.8744C16.7684 18.8103 14.9255 17.2681 12.7214 17.2681C12.0832 17.2681 11.4757 17.3981 10.9229 17.6318C10.1451 18.3608 9.582 19.3161 9.34 20.3933C9.20243 21.0057 9.498 21.6308 10.0472 21.9346C11.2357 22.5919 12.5804 23.0013 14.0116 23.0928C14.9472 22.9425 15.8292 22.6319 16.6285 22.1899Z"
                                          fill="#8BB3EA"/>
                                    <path d="M15.1893 14.2712V15.4415C15.1893 16.8045 14.0844 17.9094 12.7214 17.9094C11.3584 17.9094 10.2534 16.8045 10.2534 15.4415V14.2712L11.7839 12.3962H13.6589L15.1893 14.2712Z"
                                          fill="#F2CCBC"/>
                                    <path d="M15.1893 14.2712L13.6589 12.3962H11.8746L11.7335 12.6566V14.0277C11.7335 15.6246 13.0281 16.9192 14.625 16.9192C14.65 16.9192 14.6747 16.9179 14.6996 16.9173C15.0071 16.5057 15.1892 15.9949 15.1892 15.4416V14.2712H15.1893Z"
                                          fill="#ECAD9A"/>
                                    <path d="M13.7425 10.9836H11.7002C10.9011 10.9836 10.2534 11.6314 10.2534 12.4304V14.2713L12.3447 13.5823C13.116 13.3282 13.9613 13.4448 14.6349 13.8982L15.1892 14.2713V12.4304C15.1893 11.6314 14.5416 10.9836 13.7425 10.9836Z"
                                          fill="#655E68"/>
                                    <path d="M13.7425 10.9836H11.7335V13.7837L12.3447 13.5823C13.116 13.3283 13.9613 13.4448 14.6349 13.8983L15.1892 14.2713L13.8492 10.988C13.814 10.9854 13.7785 10.9836 13.7425 10.9836Z"
                                          fill="#544F57"/>
                                    <path d="M15.7679 20.8745C15.6505 21.3972 15.9027 21.9307 16.3715 22.19C17.5296 22.8305 18.8613 23.1953 20.2783 23.1953C21.6956 23.1953 23.0276 22.8304 24.1858 22.1898C24.6546 21.9305 24.9069 21.397 24.7894 20.8743C24.3257 18.8101 22.4828 17.2679 20.2787 17.2679C18.0744 17.268 16.2315 18.8103 15.7679 20.8745Z"
                                          fill="#B3E59F"/>
                                    <path d="M24.7894 20.8744C24.3257 18.8103 22.4828 17.2681 20.2787 17.2681C19.9574 17.2681 19.644 17.3018 19.3412 17.3641C21.1156 17.7298 22.5183 19.1112 22.9144 20.8744C23.0319 21.3971 22.7796 21.9306 22.3108 22.1899C21.4118 22.6871 20.4079 23.0173 19.3409 23.1405C19.6485 23.1761 19.9611 23.1953 20.2783 23.1953C21.6956 23.1953 23.0276 22.8304 24.1858 22.1898C24.6546 21.9306 24.9069 21.3971 24.7894 20.8744Z"
                                          fill="#95D6A4"/>
                                    <path d="M22.7466 14.2712V15.4415C22.7466 16.8045 21.6417 17.9094 20.2787 17.9094C18.9157 17.9094 17.8107 16.8045 17.8107 15.4415V14.2712L19.3412 12.3962H21.2162L22.7466 14.2712Z"
                                          fill="#F2CCBC"/>
                                    <path d="M22.1537 12.3962L20.8716 13.3337V15.4415C20.8716 16.4726 20.2391 17.3555 19.3412 17.7246C19.6303 17.8434 19.9467 17.9094 20.2787 17.9094C21.6417 17.9094 22.7466 16.8045 22.7466 15.4415V14.2712L22.1537 12.3962Z"
                                          fill="#ECAD9A"/>
                                    <path d="M21.2998 10.9836H19.2575C18.4584 10.9836 17.8107 11.6314 17.8107 12.4304V14.2713L19.9021 13.5823C20.6733 13.3282 21.5186 13.4448 22.1922 13.8982L22.7466 14.2713V12.4304C22.7466 11.6314 22.0989 10.9836 21.2998 10.9836Z"
                                          fill="#655E68"/>
                                    <path d="M21.2998 10.9836H19.4248C20.2239 10.9836 20.8716 11.6314 20.8716 12.4304V13.4554C21.3379 13.4815 21.7951 13.6308 22.1923 13.8981L22.7466 14.2712V12.4303C22.7466 11.6314 22.0989 10.9836 21.2998 10.9836Z"
                                          fill="#544F57"/>
                                    <path d="M11.215 20.3932C11.0774 21.0056 11.373 21.6307 11.9222 21.9344C13.2791 22.6849 14.8394 23.1123 16.4996 23.1123C18.1602 23.1123 19.7207 22.6848 21.0777 21.9342C21.627 21.6304 21.9226 21.0054 21.785 20.3929C21.2417 17.9745 19.0825 16.1676 16.5001 16.1676C13.9175 16.1676 11.7582 17.9747 11.215 20.3932Z"
                                          fill="#FF8086"/>
                                    <path d="M21.785 20.393C21.2417 17.9746 19.0825 16.1677 16.5001 16.1677C16.1803 16.1677 15.8671 16.1956 15.5626 16.2487C17.7174 16.6247 19.4339 18.274 19.91 20.393C20.0476 21.0054 19.7521 21.6305 19.2027 21.9343C18.1043 22.5418 16.8724 22.9375 15.5622 23.0663C15.8706 23.0966 16.1832 23.1123 16.4996 23.1123C18.1602 23.1123 19.7207 22.6848 21.0777 21.9343C21.627 21.6305 21.9226 21.0053 21.785 20.393Z"
                                          fill="#E5646E"/>
                                    <path d="M19.3915 12.6566V14.0277C19.3915 15.6247 18.0969 16.9192 16.5 16.9192C14.9031 16.9192 13.6085 15.6247 13.6085 14.0277V12.6566L14.625 10.7816H18.375L19.3915 12.6566Z"
                                          fill="#F2CCBC"/>
                                    <path d="M18.375 10.7816H17.5165V14.0277C17.5165 15.2964 16.6991 16.3735 15.5625 16.763C15.8566 16.8637 16.1718 16.9192 16.5 16.9192C18.0969 16.9192 19.3915 15.6247 19.3915 14.0277V12.6566L18.375 10.7816Z"
                                          fill="#ECAD9A"/>
                                    <path d="M17.6964 8.80469H15.3036C14.3674 8.80469 13.6085 9.56362 13.6085 10.4998V12.6566L16.0588 11.8494C16.9624 11.5517 17.9529 11.6883 18.7421 12.2195L19.3915 12.6566V10.4998C19.3915 9.56362 18.6326 8.80469 17.6964 8.80469Z"
                                          fill="#655E68"/>
                                    <path d="M17.6964 8.80469H15.8214C16.7576 8.80469 17.5166 9.56362 17.5166 10.4998V11.7358C17.9497 11.8062 18.3686 11.9681 18.7421 12.2195L19.3916 12.6566V10.4998C19.3915 9.56362 18.6326 8.80469 17.6964 8.80469Z"
                                          fill="#544F57"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_187_12220">
                                        <rect width="32" height="32" fill="white" transform="translate(0.5)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            </span>
                            <span>
                                Posted my RFQ
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="section margin-layout-index container-fluid mt-3">
            <h3 class="title-category content-products">{{ __('home.Category') }}</h3>
            <div class="main-list-category">
                @foreach($categoriesParent as $category)
                    <a href="{{ route('category.show', $category->id) }}" class="main-category-item bg-white">
                        <img src="{{ asset('storage/'.$category->thumbnail) }}" alt="" class="main-category-image">
                        <p class="main-category-name">
                            {{($category->{'name' . $langDisplay->getLangDisplay()})}}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>

        @if(isset($member) && $member->name == 'LOGISTIC')
            <div class="bg-white">
                @include('frontend.pages.member.header_member_only_main')
                <div class="row m-0">
                    <div class="col-md-6 border">
                        <div class="row">
                            <div class="col-md-12 border" style="border-right: 1px solid white!important">
                                <div class="mt-2">
                                    <h5 class="mb-3">
                                        {{ ($company->name) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        <div class="mb-3 size"><b>{{ __('home.Company code') }}
                                                : </b> {{ ($company->code_business) }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        <div class="mb-3 size"><b>{{ __('home.Elite enterprise') }}
                                                : </b> {{ ($company->member) }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        <div class="mb-3 size"><b>{{ __('home.Membership classification') }}
                                                : </b> {{ ($company->member) }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        <div class="mb-3 size"><b>{{ __('home.Customer rating score') }}: </b></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 border">
                        <div class="row">
                            <div class="col-md-12 border" style="border-left: 1px solid white!important">
                                <div class="mt-2">
                                    <h5 class="mb-3">{{ __('home.Specified products') }}</h5>
                                </div>
                            </div>
                            @php
                                $listCategory = $company->category_id;
                                $arrayCategory = explode(',', $listCategory);
                            @endphp
                            <div class="col-12">
                                <div class="row">
                                    @foreach($arrayCategory as $itemArrayCategory)
                                        @php
                                            $category = \App\Models\Category::find($itemArrayCategory);
                                        @endphp
                                        @if($category)
                                            <div class="col-md-6">
                                                <div class="mt-2 d-flex">
                                                    <a href="{{route('category.show', $category->id)}}" class="mb-3 size">
                                                        @if(locationHelper() == 'kr')
                                                            {{ ($category->name_ko) }}
                                                        @elseif(locationHelper() == 'cn')
                                                            {{ ($category->name_zh) }}
                                                        @elseif(locationHelper() == 'jp')
                                                            {{ ($category->name_ja) }}
                                                        @elseif(locationHelper() == 'vi')
                                                            {{ ($category->name_vi) }}
                                                        @else
                                                            {{ ($category->name_en) }}
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($member) && $member->name == 'TRUST')
            @include('frontend.pages.member.header_member_only_main')
            @include('frontend.pages.member.tabs_info')
        @endif

        <div class="section margin-layout-index margin-top-layout container-fluid mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="content-products">{{ __('home.New Products') }}</h3>
                <div class="see-all">
                    <a href="#">See All</a>
                </div>
            </div>
            <div class="swiper NewProducts">
                <div class="swiper-wrapper">
                    @foreach($newProducts as $product)
                        <div class="swiper-slide swiper-slide-product">
                            @include('frontend.layouts.branch.list-product-new')
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <div class="section margin-layout-index margin-top-layout container-fluid mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="content-products">{{ __('home.Featured Products') }}</h3>
                <div class="see-all">
                    <a href="#">See All</a>
                </div>
            </div>
            <div class="swiper FeaturedProducts">
                <div class="swiper-wrapper">
                    @foreach($productFeatures as $product)
                        <div class="swiper-slide swiper-slide-product">
                            @include('frontend.layouts.branch.list-product-feature')
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <div class="section margin-layout-index margin-top-layout container-fluid mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="content-products">
                    <span>
                        <img class="img-gif" src="{{ asset('images/gif/hot-deal.gif') }}"
                             alt="">
                    </span> {{ __('home.Hot Deals') }}</h3>
                <div class="see-all">
                    <a href="#">See All</a>
                </div>
            </div>

            <div class="swiper HotDeals">
                <div class="swiper-wrapper">
                    @foreach($productHots as $product)
                        <div class="swiper-slide swiper-slide-product">
                            @include('frontend.layouts.branch.list-product-hot')
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <div class="section margin-layout-index margin-top-layout container-fluid mt-3">
            <div class="row list-marketing">
                <div class="col-md-6 show-marketing">
                    <img src=" {{ asset('images/Rectangle 8.png') }}" alt="">
                    <a href="#" class="text-content">
                        <span>Shop Now</span>
                    </a>
                </div>
                <div class="col-md-6 show-marketing">
                    <img src=" {{ asset('images/Rectangle 9.png') }}" alt="">
                    <a href="#" class="text-content">
                        <span>Shop Now</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="section margin-layout-index margin-top-layout container-fluid mt-3">
            <div class="category-img list-flag">
                <div class="d-flex justify-content-between align-items-center">
                    @if($locale == 'jp')
                        <div class="content item-flag">
                            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="64" viewBox="0 0 85 64"
                                 fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M-5.3125 0H90.3125V64H-5.3125V0Z"
                                      fill="white"/>
                                <path d="M42.5073 51.897C53.4514 51.897 62.3234 42.9903 62.3234 32.0032C62.3234 21.0161 53.4514 12.1094 42.5073 12.1094C31.5631 12.1094 22.6912 21.0161 22.6912 32.0032C22.6912 42.9903 31.5631 51.897 42.5073 51.897Z"
                                      fill="#BC002D"/>
                            </svg>
                            <span class="text-flag-region">Japan</span>
                        </div>
                    @elseif($locale == 'kr')
                        <div class="content item-flag">
                            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="64" viewBox="0 0 85 64"
                                 fill="none">
                                <g clip-path="url(#clip0_45_12018)">
                                    <rect width="85" height="64" fill="white"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M64.6487 56.756L68.8381 50.5205L71.3226 52.2029L67.1331 58.4384L64.6487 56.756Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M69.5085 49.5236L73.698 43.2881L76.1825 44.9704L71.993 51.2059L69.5085 49.5236Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M61.1707 54.4003L65.3601 48.1648L67.8446 49.8472L63.6551 56.0826L61.1707 54.4003Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M66.0305 47.1679L70.22 40.9324L72.7044 42.6147L68.515 48.8502L66.0305 47.1679Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M57.6924 52.046L61.8818 45.8105L64.3663 47.4929L60.1768 53.7284L57.6924 52.046Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M62.5525 44.8119L66.742 38.5764L69.2264 40.2588L65.0369 46.4943L62.5525 44.8119Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M10.9845 43.2881L20.0337 56.7567L17.5492 58.4391L8.5 44.9704L10.9845 43.2881Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M19.3223 48.1648L23.5118 54.4003L21.0274 56.0826L16.8379 49.8472L19.3223 48.1648Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M14.4625 40.9324L18.6519 47.1679L16.1675 48.8502L11.978 42.6147L14.4625 40.9324Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M17.9408 38.5764L26.99 52.0451L24.5055 53.7274L15.4563 40.2588L17.9408 38.5764Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M42.6287 48.0985C33.5325 48.0985 26.1584 40.6896 26.1584 31.5503C26.1584 28.5988 26.9275 25.8278 28.2753 23.4285C27.7013 24.5817 27.3785 25.883 27.3785 27.2601C27.3785 31.999 31.202 35.2277 35.9186 35.2277C37.956 35.2277 39.6358 34.8173 41.1037 33.0081C41.2068 32.8701 41.3096 32.7343 41.4121 32.6009L41.7193 32.2079C41.8215 32.0793 41.9237 31.9531 42.0259 31.8294L42.3325 31.4657C44.2761 29.2106 46.2623 27.873 49.0339 27.873C53.582 27.873 57.8673 30.3516 57.269 36.76C57.0576 39.0243 56.3587 41.0875 54.8848 42.5826L54.9054 42.5823C51.8895 45.9679 47.5068 48.0985 42.6287 48.0985Z"
                                          fill="#0047A0"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M42.0538 15.6064C51.1501 15.6064 58.5241 23.0153 58.5241 32.1546C58.5241 35.1062 57.755 37.8772 56.4072 40.2765C56.9812 39.1233 57.3041 37.822 57.3041 36.4449C57.3041 31.706 53.4805 28.4773 48.7639 28.4773C46.7265 28.4773 45.0467 28.8876 43.5788 30.6969C41.2079 33.8719 39.0037 35.832 35.6487 35.832C31.1005 35.832 26.8152 33.3534 27.4135 26.945C27.6249 24.6806 28.3238 22.6175 29.7977 21.1224L29.7772 21.1227C32.793 17.7371 37.1757 15.6064 42.0538 15.6064Z"
                                          fill="#CD2E3A"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M65.0369 17.2104L69.2264 23.4459L66.742 25.1283L62.5525 18.8928L65.0369 17.2104Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M60.1768 9.97656L64.3663 16.2121L61.8818 17.8944L57.6924 11.6589L60.1768 9.97656Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M63.6551 7.62061L72.7044 21.0893L70.2199 22.7716L61.1707 9.30296L63.6551 7.62061Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M71.993 12.4988L76.1825 18.7343L73.698 20.4166L69.5085 14.1811L71.993 12.4988Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M67.1331 5.26636L71.3226 11.5018L68.8381 13.1842L64.6487 6.94871L67.1331 5.26636Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M15.4563 23.4452L24.5055 9.97656L26.99 11.6589L17.9408 25.1276L15.4563 23.4452Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M11.978 21.0893L21.0273 7.62061L23.5117 9.30296L14.4625 22.7716L11.978 21.0893Z"
                                          fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M8.5 18.7353L17.5492 5.2666L20.0337 6.94896L10.9845 20.4176L8.5 18.7353Z"
                                          fill="black"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_45_12018">
                                        <rect width="85" height="64" rx="8" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="text-flag-region">Korea</span>
                        </div>
                    @elseif($locale == 'cn')
                        <div class="content item-flag">
                            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="64" viewBox="0 0 85 64"
                                 fill="none">
                                <g clip-path="url(#clip0_45_12430)">
                                    <path d="M0 0H85V64H0V0Z" fill="#EE1C25"/>
                                    <path d="M10.2 23.6799L15.9374 6.3999L21.6748 23.6799L6.375 13.1199H25.4998L10.2 23.6799Z"
                                          fill="#FFFF00"/>
                                    <path d="M35.0853 6.73099L29.1808 8.0446L33.1193 3.43705L32.733 9.63821L29.4564 4.14832L35.0853 6.73099Z"
                                          fill="#FFFF00"/>
                                    <path d="M41.0444 14.3128L35.0945 13.2246L40.5048 10.5112L37.7531 16.0766L36.8538 9.74058L41.0444 14.3128Z"
                                          fill="#FFFF00"/>
                                    <path d="M40.1759 24.9498L35.1855 21.52L41.2277 21.2578L36.4543 25.2126L38.2072 19.0593L40.1759 24.9498Z"
                                          fill="#FFFF00"/>
                                    <path d="M32.6703 31.8989L29.3866 26.8003L35.0608 28.9012L29.1363 30.6983L33.1205 25.7021L32.6703 31.8989Z"
                                          fill="#FFFF00"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_45_12430">
                                        <rect width="85" height="64" rx="8" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="text-flag-region">China</span>
                        </div>
                    @else
                        <div class="content item-flag">
                            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="64" viewBox="0 0 85 64"
                                 fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M-5.3125 0H90.3125V64H-5.3125V0Z"
                                      fill="#DA251D"/>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M54.1543 47.6248L42.998 39.2873L31.9165 47.6998L36.0254 33.9998L24.9438 25.5373L38.6526 25.4123L42.9109 11.7373L47.2314 25.3748L60.9402 25.3873L49.9209 33.9373L54.1418 47.6373L54.1543 47.6248Z"
                                      fill="#FFFF00"/>
                            </svg>
                            <span class="text-flag-region">Viet Nam</span>
                        </div>
                    @endif
                    <div class="see-all">
                        <a href="#">See All</a>
                    </div>
                </div>
                <div class="list-products d-flex flex-wrap justify-content-between">
                    @php
                        $products = \App\Models\Product::where([['location','=',$locale],['status',\App\Enums\ProductStatus::ACTIVE]])
                                                    ->limit(10)
                                                    ->orderBy('id', 'desc')
                                                    ->get();
                    @endphp
                    @foreach($products as $product)
                        <div class="product-item">
                            @include('frontend.pages.list-product')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @foreach($arrayProducts as $keys => $arrayProduct)
            @if($keys != $locale)
                <div class="section margin-layout-index margin-top-layout container-fluid mt-3">
                    <div class="row list-marketing">
                        <div class="col-md-6 show-marketing">
                            <img src=" {{ asset('images/Rectangle 8.png') }}" alt="">
                            <a href="#" class="text-content">
                                <span>Shop Now</span>
                            </a>
                        </div>
                        <div class="col-md-6 show-marketing">
                            <img src=" {{ asset('images/Rectangle 9.png') }}" alt="">
                            <a href="#" class="text-content">
                                <span>Shop Now</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="section margin-layout-index margin-top-layout container-fluid mt-3">
                    <div class="list-flag">
                        <div class="d-flex justify-content-between align-items-center">
                            @if($keys == 'jp')
                                <div class="content item-flag">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="85" height="64" viewBox="0 0 85 64"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M-5.3125 0H90.3125V64H-5.3125V0Z" fill="white"/>
                                        <path d="M42.5073 51.897C53.4514 51.897 62.3234 42.9903 62.3234 32.0032C62.3234 21.0161 53.4514 12.1094 42.5073 12.1094C31.5631 12.1094 22.6912 21.0161 22.6912 32.0032C22.6912 42.9903 31.5631 51.897 42.5073 51.897Z"
                                              fill="#BC002D"/>
                                    </svg>
                                    <span class="text-flag-region">Japan</span>
                                </div>
                            @elseif($keys == 'kr')
                                <div class="content item-flag">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="85" height="64" viewBox="0 0 85 64"
                                         fill="none">
                                        <g clip-path="url(#clip0_45_12018)">
                                            <rect width="85" height="64" fill="white"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M64.6487 56.756L68.8381 50.5205L71.3226 52.2029L67.1331 58.4384L64.6487 56.756Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M69.5085 49.5236L73.698 43.2881L76.1825 44.9704L71.993 51.2059L69.5085 49.5236Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M61.1707 54.4003L65.3601 48.1648L67.8446 49.8472L63.6551 56.0826L61.1707 54.4003Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M66.0305 47.1679L70.22 40.9324L72.7044 42.6147L68.515 48.8502L66.0305 47.1679Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M57.6924 52.046L61.8818 45.8105L64.3663 47.4929L60.1768 53.7284L57.6924 52.046Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M62.5525 44.8119L66.742 38.5764L69.2264 40.2588L65.0369 46.4943L62.5525 44.8119Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M10.9845 43.2881L20.0337 56.7567L17.5492 58.4391L8.5 44.9704L10.9845 43.2881Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M19.3223 48.1648L23.5118 54.4003L21.0274 56.0826L16.8379 49.8472L19.3223 48.1648Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M14.4625 40.9324L18.6519 47.1679L16.1675 48.8502L11.978 42.6147L14.4625 40.9324Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M17.9408 38.5764L26.99 52.0451L24.5055 53.7274L15.4563 40.2588L17.9408 38.5764Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M42.6287 48.0985C33.5325 48.0985 26.1584 40.6896 26.1584 31.5503C26.1584 28.5988 26.9275 25.8278 28.2753 23.4285C27.7013 24.5817 27.3785 25.883 27.3785 27.2601C27.3785 31.999 31.202 35.2277 35.9186 35.2277C37.956 35.2277 39.6358 34.8173 41.1037 33.0081C41.2068 32.8701 41.3096 32.7343 41.4121 32.6009L41.7193 32.2079C41.8215 32.0793 41.9237 31.9531 42.0259 31.8294L42.3325 31.4657C44.2761 29.2106 46.2623 27.873 49.0339 27.873C53.582 27.873 57.8673 30.3516 57.269 36.76C57.0576 39.0243 56.3587 41.0875 54.8848 42.5826L54.9054 42.5823C51.8895 45.9679 47.5068 48.0985 42.6287 48.0985Z"
                                                  fill="#0047A0"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M42.0538 15.6064C51.1501 15.6064 58.5241 23.0153 58.5241 32.1546C58.5241 35.1062 57.755 37.8772 56.4072 40.2765C56.9812 39.1233 57.3041 37.822 57.3041 36.4449C57.3041 31.706 53.4805 28.4773 48.7639 28.4773C46.7265 28.4773 45.0467 28.8876 43.5788 30.6969C41.2079 33.8719 39.0037 35.832 35.6487 35.832C31.1005 35.832 26.8152 33.3534 27.4135 26.945C27.6249 24.6806 28.3238 22.6175 29.7977 21.1224L29.7772 21.1227C32.793 17.7371 37.1757 15.6064 42.0538 15.6064Z"
                                                  fill="#CD2E3A"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M65.0369 17.2104L69.2264 23.4459L66.742 25.1283L62.5525 18.8928L65.0369 17.2104Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M60.1768 9.97656L64.3663 16.2121L61.8818 17.8944L57.6924 11.6589L60.1768 9.97656Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M63.6551 7.62061L72.7044 21.0893L70.2199 22.7716L61.1707 9.30296L63.6551 7.62061Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M71.993 12.4988L76.1825 18.7343L73.698 20.4166L69.5085 14.1811L71.993 12.4988Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M67.1331 5.26636L71.3226 11.5018L68.8381 13.1842L64.6487 6.94871L67.1331 5.26636Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M15.4563 23.4452L24.5055 9.97656L26.99 11.6589L17.9408 25.1276L15.4563 23.4452Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M11.978 21.0893L21.0273 7.62061L23.5117 9.30296L14.4625 22.7716L11.978 21.0893Z"
                                                  fill="black"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M8.5 18.7353L17.5492 5.2666L20.0337 6.94896L10.9845 20.4176L8.5 18.7353Z"
                                                  fill="black"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_45_12018">
                                                <rect width="85" height="64" rx="8" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="text-flag-region">Korea</span>
                                </div>
                            @elseif($keys == 'cn')
                                <div class="content item-flag">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="85" height="64" viewBox="0 0 85 64"
                                         fill="none">
                                        <g clip-path="url(#clip0_45_12430)">
                                            <path d="M0 0H85V64H0V0Z" fill="#EE1C25"/>
                                            <path d="M10.2 23.6799L15.9374 6.3999L21.6748 23.6799L6.375 13.1199H25.4998L10.2 23.6799Z"
                                                  fill="#FFFF00"/>
                                            <path d="M35.0853 6.73099L29.1808 8.0446L33.1193 3.43705L32.733 9.63821L29.4564 4.14832L35.0853 6.73099Z"
                                                  fill="#FFFF00"/>
                                            <path d="M41.0444 14.3128L35.0945 13.2246L40.5048 10.5112L37.7531 16.0766L36.8538 9.74058L41.0444 14.3128Z"
                                                  fill="#FFFF00"/>
                                            <path d="M40.1759 24.9498L35.1855 21.52L41.2277 21.2578L36.4543 25.2126L38.2072 19.0593L40.1759 24.9498Z"
                                                  fill="#FFFF00"/>
                                            <path d="M32.6703 31.8989L29.3866 26.8003L35.0608 28.9012L29.1363 30.6983L33.1205 25.7021L32.6703 31.8989Z"
                                                  fill="#FFFF00"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_45_12430">
                                                <rect width="85" height="64" rx="8" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="text-flag-region">China</span>
                                </div>
                            @else
                                <div class="content item-flag">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="85" height="64" viewBox="0 0 85 64"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M-5.3125 0H90.3125V64H-5.3125V0Z" fill="#DA251D"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M54.1543 47.6248L42.998 39.2873L31.9165 47.6998L36.0254 33.9998L24.9438 25.5373L38.6526 25.4123L42.9109 11.7373L47.2314 25.3748L60.9402 25.3873L49.9209 33.9373L54.1418 47.6373L54.1543 47.6248Z"
                                              fill="#FFFF00"/>
                                    </svg>
                                    <span class="text-flag-region">Viet Nam</span>
                                </div>
                            @endif
                            <div class="see-all">
                                <a href="#">See All</a>
                            </div>
                        </div>
                        <div class="list-products d-flex flex-wrap">
                            @foreach($arrayProduct as $product)
                                <div class="product-item">
                                    @include('frontend.pages.list-product')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <section class="section-Seven section-description">
            <div class="container">
                <p class="text-description">
                    {{ __('home.long description') }}
                </p>
            </div>
        </section>
        @include('frontend.pages.modal-products')
    </div>
    <script>
        var urla = '{{route('user.wish.lists')}}';
        var token = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('js/frontend/index.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.decrease-input').on('click', function () {
                let dataID = $(this).data('id');
                let min = $(this).data('min');
                let quantity = $('#inputQuantity' + dataID);
                let value = quantity.val();
                if (value > 0) {
                    value = parseFloat(value) - 1;
                    if (value === min) {
                        value = 0;
                    }
                    quantity.val(value);
                }
            })

            $('.increase-input').on('click', function () {
                let dataID = $(this).data('id');
                let quantity = $('#inputQuantity' + dataID);
                let value = quantity.val();
                value = parseFloat(value) + 1;
                quantity.val(value);
            })

            $('.cart-decrease').on('click', function () {
                let dataID = $(this).data('id');
                let min = $(this).data('min');
                let quantity = $(this).siblings();
                let value = quantity.val();
                if (value > min) {
                    value = parseFloat(value) - 1;
                    quantity.val(value);
                    updateCart(dataID, value);
                }
            })

            $('.cart-increase').on('click', function () {
                let dataID = $(this).data('id');
                let quantity = $(this).prev();
                let value = quantity.val();
                value = parseFloat(value) + 1;
                quantity.val(value);
                updateCart(dataID, value);
            })
        })

        async function updateCart(id, quantity) {
            let url = `{{ route('cart.api.update', ['id'=>':id']) }}`;
            url = url.replace(':id', id);
            const data = {
                quantity: quantity,
            };

            await fetch(url, {
                method: 'PUT',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify(data),
            }).then(response => {
                if (response.status == 200) {
                    alert('Change quantity success!');
                }

            }).catch(error => {
                console.log(error);
                alert('Change quantity error!');
            });
        }
    </script>
@endsection

