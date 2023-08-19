@extends('frontend.layouts.master')
@section('title', 'Trust Register Members')
@section('content')
    <div class="container-fluid">
        <h3 class="text-center">Danh sách khách hàng</h3>
        <div class="border d-flex justify-content-between align-items-center bg-warning p-5">
            <h5>{{$company->name}}</h5>
            <div class="">
                <span>ID</span>: {{$company->id}}
            </div>
            <div class="">
                <span>Phân loại hội viên</span>: {{$company->member}}
            </div>
            <div class="">
                <span>Cấp bậc hội viên</span>: {{$company->member}}
            </div>
            <div class="">
                <span>Đánh giá của khách hàng</span>
            </div>
        </div>
        @php
            $listCategory = $company->category_id;
            $arrayCategory  = explode(',', $listCategory);
        @endphp
        <div class="row">
            <div class="col-md-4 border ml-3">
                <div class="row text-center">
                    @foreach($arrayCategory as $itemCategory)
                        @php
                            $category = \App\Models\Category::find($itemCategory);
                        @endphp
                        <div class="col-md-6">
                            {{$category->name}}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-8 border mr-3">

            </div>
        </div>
        <div class="border d-flex justify-content-between align-items-center p-5">
            <a href="{{route('trust.register.member.index')}}" class="btn btn-warning">Danh sách khách hàng</a>
            <a href="#" class="btn btn-primary">Tin nhắn đã nhận</a>
            <a href="#" class="btn btn-warning">Tin nhắn đã gửi</a>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Mua hàng</a>
            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalBuyBulk">Đặt sỉ nước
                ngoài</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Mã khách hàng</th>
                <th scope="col">Quốc gia</th>
                <th scope="col">Tên công ty</th>
                <th scope="col">Khu vực</th>
                <th scope="col">Ngày giao dịch</th>
                <th scope="col">Giá trị giao dịch</th>
                <th scope="col">Cấp bậc khách hàng</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Chọn quốc gia mua hàng</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel">Chọn quốc gia mua hàng</h5>
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