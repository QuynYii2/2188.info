@extends('frontend.layouts.master')

@section('title', 'Products')
@section('content')
    <div class="container-fluid" id="productsLanguage">
        <div class="card">
            <div class="card card-products">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="language d-flex justify-content-between align-items-center">
                            @if($locale == 'vi' || $locale == null)
                                <img class="img border" width="80px" height="60px"
                                     src="{{ asset('images/vietnam.webp') }}" alt="VietNam">
                                <h5 class="country">Viet Nam</h5>
                            @elseif($locale == 'kr')
                                <img class="img border" width="80px" height="60px" src="{{ asset('images/korea.png') }}"
                                     alt="Korea">
                                <h5 class="country">Korea</h5>
                            @elseif($locale == 'cn')
                                <img class="img border" width="80px" height="60px"
                                     src="{{ asset('images/china.webp') }}" alt="China">
                                <h5 class="country">China</h5>
                            @else
                                <img class="img border" width="80px" height="60px"
                                     src="{{ asset('images/japan.webp') }}" alt="Japan">
                                <h5 class="country">Japan</h5>
                            @endif
                        </div>
                        <div class="directional">
                            <a href="{{route('homepage')}}" class="btn btn-primary p-3">
                                Back To Home
                            </a>
                            <select class="language_drop btn btn-warning p-3 ml-3" name="countries"
                                    onchange="location = this.value;">
                                @if($locale == 'vi' || $locale == null)
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'vi']) }}'
                                            data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi">
                                        <a class="text-body mr-3">Việt Nam</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'kr']) }}'
                                            data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr">
                                        <a class="text-body mr-3">Korea</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'jp']) }}'
                                            data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                            data-title="Japan">
                                        <a class="text-body mr-3">Japan</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'cn']) }}'
                                            data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn">
                                        <a class="text-body mr-3">China</a>
                                    </option>
                                @endif
                                @if($locale == 'kr')
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'kr']) }}'
                                            data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                            data-title="Korea">
                                        <a class="text-body mr-3">Korea</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'vi']) }}'
                                            data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                            data-title="VietNam">
                                        <a class="text-body mr-3">Việt Nam</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'jp']) }}'
                                            data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                            data-title="Japan">
                                        <a class="text-body mr-3">Japan</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'cn']) }}'
                                            data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                            data-title="China">
                                        <a class="text-body mr-3">China</a>
                                    </option>
                                @endif
                                @if($locale == 'jp')
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'jp']) }}'
                                            data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                            data-title="Japan">
                                        <a class="text-body mr-3">Japan</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'kr']) }}'
                                            data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                            data-title="Korea">
                                        <a class="text-body mr-3">Korea</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'vi']) }}'
                                            data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                            data-title="VietNam">
                                        <a class="text-body mr-3">Việt Nam</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'cn']) }}'
                                            data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                            data-title="China">
                                        <a class="text-body mr-3">China</a>
                                    </option>
                                @endif
                                @if($locale == 'cn')
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'cn']) }}'
                                            data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                            data-title="China">
                                        <a class="text-body mr-3">China</a>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'kr']) }}'
                                            data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                            data-title="Korea">
                                        <a class="text-body mr-3">Korea</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'vi']) }}'
                                            data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                            data-title="VietNam">
                                        <a class="text-body mr-3">Việt Nam</a>
                                    </option>
                                    <option class="img"
                                            value='{{ route('list.products.show.location', ['locale' => 'jp']) }}'
                                            data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                            data-title="Japan">
                                        <a class="text-body mr-3">Japan</a>
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-title border row">
                        <div class="col-md-4 border list-categories">
                            <h3 class="text-center">
                                Danh mục
                            </h3>
                            <div class="row categories-show text-center">
                                @if($arrayCategoryIDs)
                                    @foreach($arrayCategoryIDs as $categoryID)
                                        @php
                                            $category = \App\Models\Category::find($categoryID);
                                        @endphp
                                        @if($category)
                                            <div class="col-md-4">
                                                <a href="{{route('category.show', $categoryID)}}" class="">
                                                    {{ ($category->name) }}
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8 border list-shops">
                            <h3 class="text-center">
                                Hội viên vendor
                            </h3>
                            <div class="row shops-show text-center">
                                @if($arrayShopsIDs)
                                    @foreach($arrayShopsIDs as $shopsID)
                                        <div class="col-md-4">
                                            <a href="{{route('list.products.shop.show', $shopsID)}}" class="">
                                                @php
                                                    $shop = \App\Models\User::find($shopsID);
                                                @endphp
                                                {{ ($shop->name) }}
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="border row navbar">
                        <div class="col-md-8 border d-flex justify-content-between">
                            <a href="#">
                                Triển lãm trưng bày sản phẩm
                            </a>
                            <a href="#">
                                Người giao dịch chỉ định
                            </a>
                            <a href="#">
                                Người giao dịch mới
                            </a>
                        </div>
                        <div class="col-md-4 border d-flex justify-content-between">
                            <a href="#">
                                Tài liệu sản phẩm
                            </a>
                            <a href="#">
                                Tài liệu mới
                            </a>
                        </div>
                    </div>
                    <div class="row border">
                        @if($products != null)
                            @foreach($products as $items)
                                @foreach($items as $product)
                                    @php
                                        $attributes = DB::table('product_attribute')->where([['product_id', $product->id], ['status', \App\Enums\AttributeProductStatus::ACTIVE]])->get();
                                    @endphp
                                    <div class="col-md-8" id="left-col">
                                        <div class="card tabs-product row" id="id-tabs-product">
                                            <div class="product-imgs col-md-12 py-1" id="product">
                                                <div class="img-display ">
                                                    <div class="img-showcase d-flex flex-row bd-highlight">
                                                        <img id="img-default" class="img w-100"
                                                             src="{{ asset('storage/' . $product->thumbnail) }}"
                                                             alt="image" width="360px" height="250px"
                                                             data-toggle="modal"
                                                             data-target="#seeImageProduct">
                                                        <input id="img-rollback" value="{{$product->thumbnail}}"
                                                               hidden=""
                                                               disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content col-md-12 py-1">
                                                <h2 class="product-title">
                                                    <a href="{{route('detail_product.show', $product->id)}}}">{{ ($product->name) }}</a>
                                                </h2>
                                                <small class="text-warning">{{ ($product->category->name) }}</small>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                    <span>4.7(21)</span>
                                                </div>
                                                <div class="product-price d-flex">
                                                    <p class="last-price">{{ __('home.old price') }}:
                                                        <span>${{$product->price + ($product->price*5/100)}}</span></p>
                                                    <p class="new-price">{{ __('home.new price') }}:
                                                        <span>${{$product->price}} (<span>5%</span>)</span></p>
                                                </div>
                                                <div class="">
                                                    <input id="product_id" hidden value="{{$product->id}}">
                                                </div>
                                                <div class="row">
                                                    @foreach($attributes as $attribute)
                                                        @php
                                                            $att = \App\Models\Attribute::find($attribute->attribute_id);
                                                            $properties_id = $attribute->value;
                                                            $arrayAtt = array();
                                                            $arrayAtt = explode(',', $properties_id);
                                                        @endphp
                                                        <div class="col-sm-6 col-6">
                                                            <label for="{{$att->name}}">{{ ($att->name) }}</label>
                                                            <select id="{{$att->name}}" name="{{$att->name}}"
                                                                    class="form-control">
                                                                @foreach($arrayAtt as $data)
                                                                    @php
                                                                        $property = \App\Models\Properties::find($data);
                                                                    @endphp
                                                                    <option value="{{$data}}">{{ ($property->name) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="count__wrapper count__wrapper--ml mt-3">
                                                    @if($product->qty && $product->qty > 0)
                                                        <label for="qty">Còn lại: {{ ($product->qty) }}</label>
                                                    @else
                                                        <p class="text-danger">Hết hàng</p>
                                                    @endif
                                                </div>
                                                <div class="count__wrapper count__wrapper--ml mt-3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection