@extends('frontend.layouts.master')

@section('title', 'Category')

<style>
    .tabs-product-detail{
        background-color: #fff;!important;
    }

    .link-tabs:hover{
        color: #c69500;!important;
    }

    .text-more-tabs:hover{
        color: #c69500;!important;
    }

    .title-search{
        color: #000;
    }

    .title-search:hover{
        color: #c69500;
    }
    .list-menu li a:hover{
        color: #000;
    }

    @media only screen and (min-width: 1200px){

    }

    @media only screen and (min-width: 992px) and (max-width: 1199px){

    }

    @media only screen and (min-width: 768px) and (max-width: 991px) {

    }

    @media only screen and (max-width: 767px) {

    }

    @media only screen and (max-width: 365px) {

    }
</style>

@section('content')
    <div class="container pt-5">
        <div id="header-carousel" class="carousel slide carousel-fade " data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item position-relative active" style="height: 450px;">
                    <img class="position-absolute w-100 h-100 img" src="{{ asset('images//carousel-1.jpg') }}"
                         style="object-fit: cover;">
                </div>
                <div class="carousel-item position-relative" style="height: 450px;">
                    <img class=" img position-absolute w-100 h-100" src="{{ asset('images//carousel-2.jpg') }}"
                         style="object-fit: cover;">
                </div>
                <div class="carousel-item position-relative" style="height: 450px;">
                    <img class= "img position-absolute w-100 h-100" src="{{ asset('images//carousel-3.jpg') }}"
                         style="object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="bg-white mt-3">
            <h3 class="ml-3">{{ __('home.brands') }}</h3>
            <table class="table table-bordered ">

                <tr>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-8.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/cat-2.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/cat-3.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/cat-4.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/cat-1.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-2.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>

                </tr>
                <tr>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-3.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-4.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-1.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-5.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle img">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-6.jpg')}}"
                                    class="w-100"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-7.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                </tr>
            </table>
        </div>


        <div class="container">
            <div class="row">
                <aside class="col-md-4">

                    <div class="card  mb-5">
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true"
                                   class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <span class="title title-search">{{ __('home.product type') }}</span>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_1" style="">
                                <div class="card-body">
                                    <form class="pb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="{{ __('home.search') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-light" type="button"><i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <ul class="list-menu">
                                        <li><a href="#">{{ __('home.people') }}</a></li>
                                        <li><a href="#">{{ __('home.watches') }}</a></li>
                                        <li><a href="#">{{ __('home.cinema') }}</a></li>
                                        <li><a href="#">{{ __('home.clothes') }}</a></li>
                                        <li><a href="#">{{ __('home.home items') }}</a></li>
                                        <li><a href="#">{{ __('home.animals') }}</a></li>
                                    </ul>

                                </div> <!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group  .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true"
                                   class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <span class="title title-search">{{ __('home.brands') }}</span>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_2" style="">
                                <div class="card-body">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked="" class="custom-control-input">
                                        <div class="custom-control-label">Mercedes
                                            <b class="badge badge-pill badge-light float-right">120</b></div>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked="" class="custom-control-input">
                                        <div class="custom-control-label">Toyota
                                            <b class="badge badge-pill badge-light float-right">15</b></div>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked="" class="custom-control-input">
                                        <div class="custom-control-label">Mitsubishi
                                            <b class="badge badge-pill badge-light float-right">35</b></div>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked="" class="custom-control-input">
                                        <div class="custom-control-label">Nissan
                                            <b class="badge badge-pill badge-light float-right">89</b></div>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <div class="custom-control-label">Honda
                                            <b class="badge badge-pill badge-light float-right">30</b></div>
                                    </label>
                                </div> <!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true"
                                   class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <span class="title title-search">{{ __('home.price range') }}</span>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_3" style="">
                                <div class="card-body">
                                    <input type="range" class="custom-range" min="0" max="100" name="">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>{{ __('home.min') }}</label>
                                            <input class="form-control" placeholder="$0" type="number">
                                        </div>
                                        <div class="form-group text-right col-md-6">
                                            <label>{{ __('home.max') }}</label>
                                            <input class="form-control" placeholder="$1,0000" type="number">
                                        </div>
                                    </div> <!-- form-row.// -->
                                    <button class="btn btn-block btn-primary">{{ __('home.apply') }}</button>
                                </div><!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true"
                                   class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <span class="title title-search">{{ __('home.size') }}</span>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_4" style="">
                                <div class="card-body">
                                    <label class="checkbox-btn">
                                        <input type="checkbox">
                                        <span class="btn btn-light"> XS </span>
                                    </label>

                                    <label class="checkbox-btn">
                                        <input type="checkbox">
                                        <span class="btn btn-light"> SM </span>
                                    </label>

                                    <label class="checkbox-btn">
                                        <input type="checkbox">
                                        <span class="btn btn-light"> LG </span>
                                    </label>

                                    <label class="checkbox-btn">
                                        <input type="checkbox">
                                        <span class="btn btn-light"> XXL </span>
                                    </label>
                                </div><!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false"
                                   class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <span class="title title-search">{{ __('home.more filter') }}</span>
                                </a>
                            </header>
                            <div class="filter-content collapse in" id="collapse_5" style="">
                                <div class="card-body">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="myfilter_radio" checked=""
                                               class="custom-control-input">
                                        <div class="custom-control-label">{{ __('home.any condition') }}</div>
                                    </label>

                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                                        <div class="custom-control-label">{{ __('home.brand new') }}</div>
                                    </label>

                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                                        <div class="custom-control-label">{{ __('home.used items') }}</div>
                                    </label>

                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                                        <div class="custom-control-label">{{ __('home.very old') }}</div>
                                    </label>
                                </div><!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group .// -->
                    </div>

                </aside>
                <main class="col-md-8">

                    <header class=" border-bottom mb-4 pb-3 ">
                        <div class="form-inline">
                            <span class="mr-md-auto">{{count($productByLocal9)}} {{ __('home.items found') }}</span>
                            <select class="form-control">
                                <option>{{ __('home.latest items') }}</option>
                                <option>{{ __('home.trending') }}</option>
                                <option>{{ __('home.most popular') }}</option>
                                <option>{{ __('home.cheapest') }}</option>
                            </select>
                        </div>
                    </header>

                    <div class="row py-2">
                        @foreach($productByLocal9 as $product)
                            <div class="col-md-4 rounded product-map">
                                <div class="product-item bg-light rounded ">
                                    <div class="product-img position-relative overflow-hidden rounded">
                                        <img class=" height-img w-100 img" src="{{ $product->thumbnail }}" alt="">
                                    </div>
                                    <div class="text-center py-4 text-limit">
                                        <a class="h6 text-decoration-none text-truncate tabs-product-detail" href="{{route('detail_product.show', $product->id)}}">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5 class="text-danger">${{ $product->price }}</h5><h6 class="text-muted ml-2"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <nav class="mt-4 mb-5 d-flex justify-content-center" aria-label="Page navigation sample">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#!">{{ __('home.previous') }}</a></li>
                            <li class="page-item active"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item"><a class="page-link" href="#!">{{ __('home.next') }}</a></li>
                        </ul>
                    </nav>

                </main>
            </div>
        </div>

    </div>
    <script>
        function responsiveTable(y) {
            let tabs = document.getElementsByClassName('product-map');
            console.log(tabs.length)
            var i;
            for (i=0; i<tabs.length; i++){
                if (y.matches) {
                    tabs[i].classList.remove("col-md-4");
                    tabs[i].classList.add("col-sm-6");
                    console.log('a')
                }
            }
        }
        var y = window.matchMedia("(max-width: 991px)")
        responsiveTable(y);
        x.addListener(responsiveTable)
    </script>
@endsection
