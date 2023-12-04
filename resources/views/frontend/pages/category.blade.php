@extends('frontend.layouts.master')

@section('title', 'Category')

@section('content')
    <style>
        .img-category-banner {
            height: 350px;
            object-fit: cover;
        }

        .category-name-banner {
            font-size: 64px;
            font-weight: 600;
        }

        .card-title1 {
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            transition: transform 0.3s ease-out;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            -webkit-line-clamp: 2;
            min-height: 50px;
            white-space: normal;
        }

        .image-product {
            height: 250px;
            object-fit: cover;
        }

        .price-sale {
            font-size: 18px;
            font-weight: 600;
            color: #DD0B00;
        }

        .price-search {
            font-size: 18px;
            font-weight: 800;
        }

        .price-input {
            width: 100%;
            display: flex;
            margin: 30px 0 35px;
        }

        .price-input .field {
            display: flex;
            width: 100%;
            height: 45px;
            align-items: center;
        }

        .field input {
            width: 100%;
            height: 100%;
            outline: none;
            font-size: 19px;
            margin-left: 12px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #999;
            -moz-appearance: textfield;
        }

        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .price-input .separator {
            width: 130px;
            display: flex;
            font-size: 19px;
            align-items: center;
            justify-content: center;
        }

        .slider {
            height: 5px;
            position: relative;
            background: #ddd;
            border-radius: 5px;
        }

        .input-min, .input-max {
            color: #929292;
        }

        .slider .progress {
            height: 100%;
            left: 25%;
            right: 25%;
            position: absolute;
            border-radius: 5px;
            background: #F47621;
        }

        .range-input {
            top: 35px;
            position: relative;
        }

        .range-input input {
            position: absolute;
            width: 100%;
            height: 5px;
            top: -40px;
            background: none;
            pointer-events: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input[type=range]::-webkit-slider-thumb {
            height: 17px;
            width: 17px;
            border-radius: 50%;
            background: #F47621;
            pointer-events: auto;
            -webkit-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        input[type=range]::-moz-range-thumb {
            height: 17px;
            width: 17px;
            border: none;
            border-radius: 50%;
            background: #F47621;
            pointer-events: auto;
            -moz-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }
    </style>
    @php
        $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
    @endphp
    <div id="body-content " style="background-color: #f5f5f5">
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
        <div class="container pb-5">
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
