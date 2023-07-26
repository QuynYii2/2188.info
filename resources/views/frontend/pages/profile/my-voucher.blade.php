@extends('frontend.layouts.profile')

@section('title', 'My Voucher')

<style>
    .link-tabs {
        background-color: #f7f7f7 !important;
    }

    .link-tabs:hover {
        color: #c69500;
    !important;
    }
</style>

@section('sub-content')
    <div class="row mt-2 bg-white rounded">

        <div class="col-md-12 ">
            <div class="row rounded pt-1 ml-5">
                <h5>Voucher</h5>
            </div>
            <div class="border-bottom"></div>
            <div class="container">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Voucher Name</th>
                        <th scope="col">Voucher Code</th>
                        <th scope="col">Voucher Percent</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Voucher Apply Products</th>
                        <th scope="col">Voucher EndDate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @dd($listVouchers)
                    @foreach($voucherItems as $voucherItem)
                        @php
                            $voucher = \App\Models\Voucher::find($voucherItem->voucher_id)
                        @endphp
                        <tr>
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$voucher->name}}</td>
                            <td>{{$voucher->code}}</td>
                            <td>{{$voucher->percent}}</td>
                            <td>{{$voucherItem->quantity}}</td>
                            <td>
                                @php
                                    $listIDs = $voucher->apply;
                                    $arrayIds = explode(',', $listIDs);
                                    $arrayName = null;
                                    for ($i = 0; $i<count($arrayIds); $i++){
                                        $product = \App\Models\Product::find($arrayIds[$i]);
                                        $arrayName[] = $product->name;
                                    }
                                    $listName = implode(', ', $arrayName);
                                @endphp
                                {{$listName}}
                            </td>
                            <td>{{$voucher->endDate}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        //
{{--        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />--}}
{{--        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">--}}

{{--        <div class="container mt-5">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-10 ml-auto col-xl-6 mr-auto">--}}
{{--                    <p class="category">Tabs with Icons on Card</p>--}}
{{--                    <!-- Nav tabs -->--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header">--}}
{{--                            <ul class="nav nav-tabs justify-content-center" role="tablist">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">--}}
{{--                                        <i class="now-ui-icons objects_umbrella-13"></i> Tất cả--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">--}}
{{--                                        <i class="now-ui-icons shopping_cart-simple"></i> Shoppe--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" data-toggle="tab" href="#messages" role="tab">--}}
{{--                                        <i class="now-ui-icons shopping_shop"></i> Shop--}}
{{--                                    </a>--}}
{{--                                </li>--}}

{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <!-- Tab panes -->--}}
{{--                            <div class="tab-content text-center">--}}
{{--                                <div class="tab-pane active" id="home" role="tabpanel">--}}
{{--                                    <p>$listVouchers</p>--}}
{{--                                </div>--}}
{{--                                <div class="tab-pane" id="profile" role="tabpanel">--}}
{{--                                    <p> $voucherWithAdmin </p>--}}
{{--                                </div>--}}
{{--                                <div class="tab-pane" id="messages" role="tabpanel">--}}
{{--                                    <p>$voucherWithSellers</p>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
@endsection
