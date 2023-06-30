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
                <h5>{{ __('home.my voucher') }}</h5>
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
    </div>
@endsection
