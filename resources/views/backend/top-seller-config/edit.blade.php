@extends('backend.layouts.master')
@section('title', 'Create Top Seller')
@section('content')
    <h5 class="text-center mt-3 mb-4">{{ __('home.Create marketing') }}</h5>
    <div class="card p-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#exampleModal">{{ __('home.Preview') }}
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 70vw">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Preview') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img style="width: 100%"
                             src="{{asset('images/z4629273739159_20f1e3ae8cdfc03ea6413d0fe4affab5 (1).jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <select class="form-select mb-4" aria-label="Default select example" id="selectMarketing">
            <option id="marketing_product" value="1">Product</option>
        </select>

        <form id="marketing_product_form" class="marketing_product" action="{{route('seller.config.create')}}"
              method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="local">Choosing location...</label>
                <select class="form-control" name="local" id="local">
                    @php
                        $locations = \App\Models\SetupMarketing::all();
                    @endphp
                    @foreach($locations as $location)
                        <option value="{{$location->id}}">
                            {{$location->stt}} - {{$location->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="text" hidden class="form-control" id="moneyLocal" name="moneyLocal" value="100">
            <label for="select_url">Select products</label>
            <div class="list-product_show">
                @php
                    $products = \Illuminate\Support\Facades\DB::table('products')->get();
                @endphp
                @foreach($products as $product)
                    <div class=" ">
                        <label class="image-checkbox d-flex align-items-center">
                            <input class="inputCheckbox" type="checkbox" name="arrayProduct[]" value="{{$product->id}}"/>
                            <div class="check_url">
                                <img src="{{ asset('storage/'.$product->thumbnail) }}" class="img img-100">
                            </div>
                            <a href="{{route('detail_product.show', $product->id)}}">{{ ($product->name) }}</a>
                        </label>
                    </div>
                @endforeach
            </div>
            <input type="text" hidden class="form-control" id="moneyLocal" name="moneyLocal" value="100">
            <button class="btn btn-primary" type="submit">{{ __('home.Create') }}</button>
        </form>
    </div>
@endsection

