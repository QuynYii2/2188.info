@extends('frontend.layouts.master')
@section('title', 'Buy Coin')
@section('content')
    <div style="background-color: #f7f7f7">
        <div class="container-fluid mb-2">
            <div class="category" >{{ __('home.buy coin') }}</div>
            <div class="row mt-3">
                <div class="row p-3">
                    <div class="col-12 col-lg-5" style="width: 100%" >
                        <div class="row mt-4" >
                            <div class="mb-3 ml-3">
                                <h5 class="text-center">Enter the coin you want to buy</h5>
                            </div>
                            <form class="form-inline" method="post" action="{{route('buy.coin.create')}}">
                                @csrf
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="number-price" class="sr-only">Number</label>
                                    <input type="number" class="form-control" name="price" id="number-price"
                                           placeholder="Number">
                                </div>
                                <button type="submit" class="btn btn-danger mb-2">Buy</button>
                            </form>
                        </div>
                        <div class="left-side mt-4" style="width: 100%" >
                            <img class="img" src="{{asset('images/bitcoin-07520220.jpg')}}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-7">
                        <!-- Carousel wrapper -->
                        <div
                                id="carouselMultiItemExample"
                                class="carousel slide carousel-dark text-center"
                                data-mdb-ride="carousel">
                            <!-- Inner -->
                            <div class="carousel-inner py-4">
                                <!-- Single item -->
                                <div class="carousel-item active">
                                    <div class="container">
                                        <div class="row">
                                            @foreach($comboCoin as $coin)
                                                <div class="col-lg-4 p-2 mb-2">
                                                    <form method="post" action="{{route('buy.coin.create')}}">
                                                        @csrf
                                                        <div class="card p-2">
                                                            <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/181.webp"
                                                                 class="card-img-top img"
                                                                 alt="Waterfall"/>
                                                            <div class="card-body">
                                                                <h4 class="text-center text-nowrap"><span class="mr-1" id="number-coin-{{$coin}}">1</span>coin</h4>
                                                                <h5 class="card-title text-danger">${{$coin}}</h5>
                                                                <input type="text" class="d-none" id="input-coin-{{$coin}}" name="quantity" value="1">
                                                                <input type="text" class="d-none" name="price" value="{{$coin}}">
                                                                <button type="submit" class="btn btn-success">Buy now</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Inner -->
                        </div>
                        <!-- Carousel wrapper -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
