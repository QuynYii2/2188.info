@extends('frontend.layouts.master')
@section('title', 'Trust Register Members')
@section('content')

    <div class="container-fluid">
        <h3 class="text-center">{{ __('home.List of customers') }}</h3>
        <div class="d-flex justify-content-between align-items-center p-3">
            <div>
                <a href="{{route('trust.register.member.index')}}" class="btn btn-warning">{{ __('home.Partner List') }}</a>
            </div>
            <div>
                <a href="{{route('chat.message.received')}}" class="btn btn-primary mr-2">{{ __('home.Message received') }}</a>
                <a href="{{route('chat.message.sent')}}" style="" class="btn btn-primary mr-2">{{ __('home.Message sent') }}</a>
                <a href="#" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">{{ __('home.Purchase') }}</a>
                <a href="#" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModalBuyBulk">{{ __('home.Foreign wholesale order') }}</a>
            </div>
        </div>
        @include('frontend.pages.member.tabs_info')
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">{{ __('home.Customer code') }}</th>
                <th scope="col">{{ __('home.Nation') }}</th>
                <th scope="col">{{ __('home.Company Name') }}</th>
                <th scope="col">{{ __('home.Area') }}</th>
                <th scope="col">{{ __('home.Area') }}</th>
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
                    @if($locale)
                        @if($user)
                            @if($user->region == $locale)
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
                        @endif
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Chọn quốc gia mua hàng') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="https://shipgo.biz/kr">
                            <img width="80px" height="80px" src="{{ asset('images/korea.png') }}" alt="">
                        </a>
                        <a href="https://shipgo.biz/jp">
                            <img width="80px" height="80px" src="{{ asset('images/japan.webp') }}" alt="">
                        </a>
                        <a href="https://shipgo.biz/cn">
                            <img width="80px" height="80px" src="{{ asset('images/china.webp') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalBuyBulk" role="dialog" aria-labelledby="exampleModalBuyBulk"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Chọn quốc gia mua hàng') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{route('trust.register.member.locale', 'kr')}}">
                            <img width="80px" height="80px" src="{{ asset('images/korea.png') }}" alt="">
                        </a>
                        <a href="{{route('trust.register.member.locale', 'jp')}}">
                            <img width="80px" height="80px" src="{{ asset('images/japan.webp') }}" alt="">
                        </a>
                        <a href="{{route('trust.register.member.locale', 'cn')}}">
                            <img width="80px" height="80px" src="{{ asset('images/china.webp') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection