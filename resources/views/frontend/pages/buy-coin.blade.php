@extends('frontend.layouts.master')

@section('title', 'Buy Coin')

@section('content')

    <div class="container-lg mt-5 mb-3" style=" background-color: #f7f7f7">
        <h2>{{ __('home.buy coin') }}</h2>
        <div class="row mt-3">
            <div class="row p-3">
                <div class="col-12 col-lg-6">
                    <div class="left-side ">
                        <img class="img" src="{{asset('images/imgaes-coin.jpg')}}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
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
                                            <div class="col-lg-4">
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
                                                            <button type="submit" class="btn btn-primary">Buy now</button>
                                                        </div>
                                                    </div>
                                            </form>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-3 ml-3">
                                            <h5 class="text-center">If you want to buy coin, please enter the number
                                                coins</h5>
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
    <script>
        function checkCoin(value, size) {
            var coins = document.getElementById('number-coin-' + value)
            var inputValue = document.getElementById('input-coin-' + value)
            var number = parseInt(value) * 10 + parseInt(value)+ parseInt(size);
            coins.innerText = number;
            inputValue.value = number;
        }

        function next() {
            var i = 0;
            var array = [10, 50, 100, 200, 500, 1000];
            for (i; i < 6; i++) {
                checkCoin(array[i], i);
            }
        }
        next();
    </script>
@endsection
