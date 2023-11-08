@extends('backend.layouts.master')
@section('title')
    {{ __('home.Sản phẩm được xem nhiều nhất') }}
@endsection
@section('content')
    <div class="container">
        <h5 class="mt-2 mb-2">{{ __('home.Sản phẩm được xem nhiều nhất') }}</h5>
        <div class="mb-3">
            <form action="{{route('seller.products.views.filter')}}" method="post">
                @csrf
                <div class="form-row">
                    @if($isAdmin)
                        <div class="form-group col-md-4">
                            <label for="user_seller">UserSeller</label>
                            <select id="user_seller" name="user_seller" class="form-control">
                                <option value="0">{{ __('home.choosing seller name...') }}</option>
                                @for($i = 0; $i<count($listUserId); $i++)
                                   @php
                                       $user = \App\Models\User::find($listUserId[$i])
                                   @endphp
                                    <option value="{{$listUserId[$i]}}">{{$user->name}}</option>
                                @endfor
                            </select>
                        </div>
                    @endif
{{--                    <div class="form-group col-md-4">--}}
{{--                        <label for="location">Location</label>--}}
{{--                        <select id="location" name="location" class="form-control">--}}
{{--                            <option>Choosing location...</option>--}}
{{--                            <option></option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <div class="form-group col-md-4">
                        <label for="views">Views</label>
                        <select id="views" name="views" class="form-control">
                            <option value="no">{{ __('home.choosing sort views') }}</option>
                            <option value="asc">{{ __('home.From low to high') }}</option>
                            <option value="desc">{{ __('home.From high to low') }}</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('home.submit') }}</button>
                <a href="{{route('seller.products.views')}}" class="btn btn-secondary">Reset</a>
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('home.Product Name') }}</th>
                <th scope="col">{{ __('home.category') }}</th>
                @if($isAdmin)
                    <th scope="col">{{ __('home.sellerName') }}</th>
                @endif
                <th scope="col">{{ __('home.quantity') }}</th>
                <th scope="col">{{ __('home.PRICE') }}</th>
                <th scope="col">{{ __('home.views') }}</th>
                <th scope="col">{{ __('home.location') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>
                        @if(locationHelper() == 'kr')
                            <div class="item-text">{{ $product->name_ko }}</div>
                        @elseif(locationHelper() == 'cn')
                            <div class="item-text">{{$product->name_zh}}</div>
                        @elseif(locationHelper() == 'jp')
                            <div class="item-text">{{$product->name_ja}}</div>
                        @elseif(locationHelper() == 'vi')
                            <div class="item-text">{{$product->name_vi}}</div>
                        @else
                            <div class="item-text">{{$product->name_en}}</div>
                        @endif
                    </td>
                    <td>
                        @php
                            $ld = new \App\Http\Controllers\TranslateController();
                        @endphp
                        {{ $ld->translateText($product->category->name, locationPermissionHelper()) }}
                       </td>
                    @if($isAdmin)
                        <td>

                            {{($product->user->name)}}</td>
                    @endif
                    <td>{{$product->qty}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->views}}</td>
                    <td>{{$product->location}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection