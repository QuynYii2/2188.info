@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <h5 class="mt-2 mb-2">San pham duoc xem nhieu nhat</h5>
        <div class="mb-3">
            <form action="{{route('seller.products.views.filter')}}" method="post">
                @csrf
                <div class="form-row">
                    @if($isAdmin)
                        <div class="form-group col-md-4">
                            <label for="user_seller">UserSeller</label>
                            <select id="user_seller" name="user_seller" class="form-control">
                                <option value="0">Choosing seller name...</option>
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
                            <option value="no">Choosing sort views</option>
                            <option value="asc">From low to high</option>
                            <option value="desc">From high to low</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('seller.products.views')}}" class="btn btn-secondary">Reset</a>
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                @if($isAdmin)
                    <th scope="col">SellerName</th>
                @endif
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Views</th>
                <th scope="col">Location</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$trans->translateText($product->name)}}</td>
                    <td>{{$trans->translateText($product->category->name)}}</td>
                    @if($isAdmin)
                        <td>{{$trans->translateText($product->user->name)}}</td>
                    @endif
                    <td>{{$product->qty}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->views}}</td>
                    <td>{{$product->location}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection