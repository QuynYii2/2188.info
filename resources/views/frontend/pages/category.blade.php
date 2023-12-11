@extends('frontend.layouts.master')

@section('title', 'Category')

@section('content')
    @php
        $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
    @endphp
    <div id="body-content" style="background-color: #F3F3F3">
        <div class="category-banner">
            <img class="img-category-banner" src="{{ asset('storage/'. $category->thumbnail)  }}"
                 alt="">
            <div class="category-name category-name-banner">
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
            </div>
        </div>
        <div class="show-category pb-5">
            <div class="category-header align-items-center mt-4 mb-3 container-fluid d-flex justify-content-between">
                <div class="breadcrumbs_filter">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Category</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
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
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row category-page">
                <div class="col-xl-3 col-md-3 col-6">
                    <div class="section-First-category bg-white">
                        <div class="accordion" id="accordionExample">
                            <div class="show-accordion" id="headingOne" data-toggle="collapse"
                                 data-target="#collapseOne" aria-expanded="true"
                                 aria-controls="collapseOne">
                                    <span class="text-left">
                                        <div class="show-list-category">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-2" width="16" height="17"
                                                 viewBox="0 0 16 17"
                                                 fill="none">
                                                <path d="M2 8.5H10M2 4.5H14M2 12.5H14" stroke="black" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>All Categories</span>
                                            <i id="iconUp" class="fa-solid fa-chevron-up float-right mt-3"></i>
                                            <i id="iconDown"
                                               class="fa-solid fa-chevron-down d-none float-right mt-3"></i>
                                        </div>
                                    </span>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordionExample">
                                <ul class="m-auto all-category">
                                    @foreach($categories as $category)
                                        <li class="category-item">
                                            <a href="{{ route('category.show', $category->id) }}"
                                               class="category-item-name">
                                                {{($category->{'name' . $langDisplay->getLangDisplay()})}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="border-radius mt-3 bg-white">
                        <div class="d-flex p-3">
                            <div class="wrapper">
                                <div class="price-search">
                                    {{ __('home.Price') }}
                                </div>
                                <div class="price-input">
                                    <div class="field">
                                        <input type="number" id="inputProductMin"
                                               class="rangePrice input-min" value="0">
                                    </div>
                                    <div class="separator">-</div>
                                    <div class="field">
                                        <input type="number" id="inputProductMax"
                                               class="rangePrice input-max" value="0">
                                    </div>
                                </div>
                                <div class="slider">
                                    <div class="progress"></div>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="rangePrice range-min" min="0"
                                           max="100000" value="25000" step="100">
                                    <input type="range" class="rangePrice range-max" min="0"
                                           max="100000" value="75000" step="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-md-9 col-6">
                    <div class="row">
                        @foreach($listProduct as $product)
                            <div class="col-md-4 mb-3 product-item">
                                @include('frontend.pages.list-product')
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button class="btn btn-outline-secondary">{{ __('home.Show More') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.range-min').on('change', function () {
                let price = $(this).val();
                $('#inputProductMin').val(price)
            })

            $('.range-max').on('change', function () {
                let price = $(this).val();
                $('#inputProductMax').val(price)
            })

            $('#headingOne').on('click', function () {
                checkClass();
            })
        })

        function checkClass() {
            let hasClass = $("#collapseOne").hasClass("show");
            let isShow = $(".show-accordion.collapsed").length;

            if (!isShow) {
                $('#iconUp').removeClass('d-none');
                $('#iconDown').addClass('d-none');
            } else {
                $('#iconDown').removeClass('d-none');
                $('#iconUp').addClass('d-none');
            }
        }
    </script>
@endsection
