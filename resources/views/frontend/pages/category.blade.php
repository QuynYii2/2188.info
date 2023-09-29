@extends('frontend.layouts.master')

@section('title', 'Category')

@section('content')
    @php
        $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
    @endphp
    <div id="body-content">
        <div class="category-banner">
            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/category-banner-top-layout-2.jpg"
                 alt="">
            <div class="category-name">
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
        <section class="section container-fluid">
            <div class="swiper CategoriesOne category-item">
                <div class="swiper-wrapper">
                    @php
                        $listCate = DB::table('categories')->where('parent_id', null)->get();
                    @endphp
                    @foreach($childCategories as $cate)
                        <div class="swiper-slide">
                            <a href="{{ route('category.show', $cate->id) }}">
                                <div class="img">
                                    <img src="{{ asset('storage/' . $cate->thumbnail) }}"
                                         alt="">
                                </div>
                                <div class="text">
                                    {{($cate->{'name' . $langDisplay->getLangDisplay()})}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <input id="url" type="text" hidden value="{{asset('/add-to-cart')}}">
        <div class="category-header align-items-center mt-4 mb-3 container-fluid d-flex justify-content-between">
            <div class="breadcrumbs_filter">
                {!! getBreadcrumbs('category', $category) !!}
                <div class="category-header--right">
                    <div class="show-item mr-4 align-items-center">
                        <span class="mr-3">{{ __('home.Show') }}</span>
                        <select class="drop btn dropdown-toggle" id="count-per-page" aria-label="Default select example">
                            <option selected value="10">{{ __('home.10 products per page') }}</option>
                            <option value="20">{{ __('home.20 products per page') }}</option>
                            <option value="30">{{ __('home.30 products per page') }}</option>
                            <option value="40">{{ __('home.40 products per page') }}</option>
                            <option value="50">{{ __('home.50 products per page') }}</option>
                        </select>
                    </div>
                    <div class="SortBy align-items-center mr-4">
                        <span class="mr-3">{{ __('home.Sort By') }}</span>
                        <select class="drop btn dropdown-toggle" id="sort-by" aria-label="Default select example">
                            <option value="created_at desc" selected>{{ __('home.Newest Items') }}</option>
                            <option value="name asc">{{ __('home.Name: A to Z') }}</option>
                            <option value="name desc">{{ __('home.Name: Z to A') }}</option>
                            <option value="price asc">{{ __('home.Price: Ascending') }}</option>
                            <option value="price desc">{{ __('home.Price: Descending') }}</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="category-body container-fluid">
            <div class="row" id="renderProduct">
                @foreach($listProduct as $product)
                    <div class="col-xl-2 col-md-3 col-6 section mb-4">
                        @include('frontend.pages.list-product')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('frontend.pages.modal-products')

    <script>
        var urla = '/category/filter/'
        var token = '{{ csrf_token() }}'
    </script>

    <script src="{{asset('js/frontend/pages/category.js')}}"></script>
@endsection
