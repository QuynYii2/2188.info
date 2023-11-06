@extends('frontend.layouts.master')

@section('title', 'Home page')
@section('content')

    <!-- Shop Start -->
    <div class="container-fluid mt-3">
        <div class="row px-xl-5">
            @if(count($promotionIDs)>0) @endif
            @for($i = 0; $i<count($promotionIDs); $i++)
                <div class="col-md-2 mt-3 border">
                    <h5 class="text-center">
                        @php
                            $array = explode('-', $promotionIDs[$i]);
                            $user = \App\Models\User::find($array[1]);
                        @endphp
                        {{$user->name}}
                    </h5>
                </div>
                <!-- Shop Product Start -->
                @php
                    $newpromotion = \App\Models\Promotion::where('id', $array[0])->first();
                    $listIDproducts = $newpromotion->apply;
                    $arrayIDProducts = explode(',', $listIDproducts);
                @endphp
                <div class="col-md-10">
                    <div class="row">
                        @for($i = 0; $i<count($arrayIDProducts); $i++)
                            @php
                                $product = \App\Models\Product::find($arrayIDProducts[$i]);
                            @endphp
                            <div class="col-md-3">
                                <div class="product-item bg-light mb-4">
                                    @php
                                        $thumbnail = checkThumbnail($product->thumbnail);
                                    @endphp
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img img-fluid w-100"
                                             src="{{ $thumbnail }}"
                                             alt="">
                                    </div>
                                    <div class="text-center py-4">
                                        <div class="h6 text-decoration-none text-truncate" data-toggle="modal"
                                             data-target="#exampleModal{{$product->id}}">{{($product->name)}}</div>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5 id="price-percent">
                                                {{$product->price - $product->price * $newpromotion->percent / 100}}
                                            </h5>
                                            <h6 class="text-muted ml-2">
                                                <del>
                                                    {{$product->price}}
                                                    <span class="text-danger">({{$newpromotion->percent}}%)</span>
                                                </del>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('cart.add.promotion', ['product'=>$product, 'percent'=>$newpromotion->percent]) }}"
                                              method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Product</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card tabs-product row" id="id-tabs-product">
                                                    <div class="product-imgs col-md-12 py-1" id="product">
                                                        <div class="img-display ">
                                                            @php
                                                                $thumbnail = checkThumbnail($product->thumbnail);
                                                            @endphp
                                                            <div class="img-showcase d-flex flex-row bd-highlight">
                                                                <img id="img-default" class="img w-100"
                                                                     src="{{ $thumbnail }}"
                                                                     alt="image" width="360px" height="250px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content col-md-12 py-1" style="z-index: 88;">
                                                        @csrf
                                                        <h2 class="product-title">{{($product->name)}}</h2>
                                                        <small class="text-warning">{{($product->category->name)}}</small>
                                                        <div class="product-price d-flex" style="gap: 3rem">
                                                            <p class="last-price">{{ __('home.old price') }}:
                                                                <span>
                                                                    $ {{$product->price - $product->price * $newpromotion->percent / 100}}
                                                                </span>
                                                            </p>
                                                            <p class="new-price">{{ __('home.new price') }}:
                                                                <span>${{$product->price}}
                                                                    (<span>
                                                                        {{$newpromotion->percent}}%
                                                                    </span>)
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            @php
                                                                $attributes = DB::table('product_attribute')->where([['product_id', $product->id], ['status', \App\Enums\AttributeProductStatus::ACTIVE]])->get();
                                                            @endphp
                                                            @foreach($attributes as $attribute)
                                                                @php
                                                                    $att = \App\Models\Attribute::find($attribute->attribute_id);
                                                                    $properties_id = $attribute->value;
                                                                    $arrayAtt = array();
                                                                    $arrayAtt = explode(',', $properties_id);
                                                                @endphp
                                                                <div class="col-sm-6 col-6">
                                                                    <label for="{{$att->name}}">{{($att->name)}}</label>
                                                                    <select id="{{$att->name}}" name="{{($att->name)}}"
                                                                            class="form-control">
                                                                        @foreach($arrayAtt as $data)
                                                                            @php
                                                                                $property = \App\Models\Properties::find($data);
                                                                            @endphp
                                                                            <option value="{{$data}}">{{($property->name)}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <div class="count__wrapper count__wrapper--ml mt-3">
                                                            <label for="qty">{{ __('home.quantity') }}</label>
                                                            <input class="product-qty input" type="number"
                                                                   name="quantity" min="1"
                                                                   style="width: 55px"
                                                                   value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('home.buy now') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <!-- Shop Product End -->
            @endfor
        </div>
    </div>
@endsection
