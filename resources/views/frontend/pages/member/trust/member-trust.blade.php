@extends('frontend.layouts.master')
@section('title', 'Trust Register Members')
@section('content')
    <div class="container">
        <h3 class="text-center">{{ __('home.List of customers') }}</h3>
        @include('frontend.pages.member.header_member')
        @include('frontend.pages.member.tabs_info')
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">{{ __('home.Customer code') }}</th>
                <th scope="col">{{ __('home.Nation') }}</th>
                <th scope="col">{{ __('home.Company Name') }}</th>
                <th scope="col">{{ __('home.Area') }}</th>
                <th scope="col">{{ __('home.Day trading') }}</th>
                <th scope="col">{{ __('home.Transaction value') }}</th>
                <th scope="col">{{ __('home.Customer level') }}</th>
            </tr>
            </thead>
            <tbody>
            @if(!$companies->isEmpty())
                @foreach($companies as $memberItem)
                    @php
                        $user = \App\Models\User::find($memberItem->user_id);
                    @endphp
                    @if($user)
                        <tr>
                            <td scope="row">{{$memberItem->id}}</td>
                            <td>{{$user->region}}</td>
                            <td>{{$memberItem->name}}</td>
                            <td>{{$memberItem->address}}</td>
                            <td>{{ \Carbon\Carbon::parse($memberItem->created_at)->format('d/m/Y') }}</td>
                            <td>{{$memberItem->price * $memberItem->quantity}}</td>
                            <td>
                                @php
                                    $ranks = null;
                                    $rankSetup = \App\Models\RankSetUpSeller::where('user_id', $user->id)->first();
                                    if ($rankSetup){
                                         $orderItems = DB::table('order_items')
                                            ->join('orders', 'orders.id', '=', 'order_items.order_id')
                                            ->join('products', 'products.id', '=', 'order_items.product_id')
                                            ->where([
                                                ['orders.user_id', '=', $user->id],
                                                ['products.user_id', $user->id]
                                            ])
                                            ->select('order_items.*', 'products.user_id')
                                            ->get();
                                        $total = 0;
                                        foreach ($orderItems as $orderItem) {
                                            $total = $total + $orderItem->price * $orderItem->quantity;
                                        }
                                        $listRank = $rankSetup->setup;
                                        $arrayRank = explode(',', $listRank);
                                        for($i = 0; $i<4; $i++){
                                             $detailRank = $arrayRank[$i];
                                             $arrayDetailRank = explode(':', $detailRank);
                                             $value = (int)$arrayDetailRank[1];
                                             if ($total > $value) {
                                                 $ranks = $arrayDetailRank[0];
                                             }
                                        }
                                        $ranks = str_replace(' ', '', $ranks);
                                    }
                                @endphp
                                @if($ranks == \App\Enums\RankSetupSeller::DIAMOND)
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                @elseif($ranks == \App\Enums\RankSetupSeller::GOLD)
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                @elseif($ranks == \App\Enums\RankSetupSeller::SILVER)
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                @elseif($ranks == \App\Enums\RankSetupSeller::COPPER)
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                @else
                                    <i class="fa-solid fa-trophy"></i>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection