@extends('frontend.layouts.master')
@section('title', 'Partner Register Members')
@section('content')
    @php
        $mentor = \App\Models\User::find($company->user_id);
    @endphp
    <div class="container-fluid">
        <h3 class="text-center">Danh sách đối tác</h3>
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
        <div class="border d-flex justify-content-between align-items-center p-3">
            <a href="{{route('stand.register.member.index', $company->id)}}" class="btn btn-primary">Gian hàng</a>
            <a href="{{route('partner.register.member.index')}}" class="btn btn-warning">Danh sách đối tác</a>
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
                <th scope="col">Số lượng</th>
                <th scope="col">Phân loại hội viên</th>
                <th scope="col">Cấp bậc khách hàng</th>
            </tr>
            </thead>
            <tbody>
            @if(!$memberList->isEmpty())
                @foreach($memberList as $memberItem)
                    @php
                        $memberPartner = \App\Models\MemberRegisterInfo::find($memberItem->company_id_follow);
                        $user = \App\Models\User::find($memberPartner->user_id);
                        $locale = session()->get('region');
                    @endphp
                    @if($locale)
                        @if($user->region == $locale)
                            <tr>
                                <td scope="row">{{$memberPartner->id}}</td>
                                <td>
                                    {{$mentor->region}}
                                </td>
                                <td>{{$memberPartner->name}}</td>
                                <td>{{$memberPartner->address}}</td>
                                <td>{{ \Carbon\Carbon::parse($memberItem->created_at)->format('d/m/Y') }}</td>
                                <td>{{$memberItem->price * $memberItem->quantity}}</td>
                                <td>{{$memberItem->quantity}}</td>
                                <td>{{$memberPartner->member}}</td>
                                <td>
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                    <i class="fa-solid fa-trophy"></i>
                                </td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td scope="row">{{$memberPartner->id}}</td>
                            <td>
                                {{$mentor->region}}
                            </td>
                            <td>{{$memberPartner->name}}</td>
                            <td>{{$memberPartner->address}}</td>
                            <td>{{ \Carbon\Carbon::parse($memberItem->created_at)->format('d/m/Y') }}</td>
                            <td>{{$memberItem->price * $memberItem->quantity}}</td>
                            <td>{{$memberItem->quantity}}</td>
                            <td>{{$memberPartner->member}}</td>
                            <td>
                                @php
                                    $ranks = null;
                                    $rankSetup = \App\Models\RankSetUpSeller::where('user_id', $mentor->id)->first();
                                    if ($rankSetup){
                                         $orderItems = DB::table('order_items')
                                            ->join('orders', 'orders.id', '=', 'order_items.order_id')
                                            ->join('products', 'products.id', '=', 'order_items.product_id')
                                            ->where([
                                                ['orders.user_id', '=', $user->id],
                                                ['products.user_id', $mentor->id]
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
                        <a href="{{route('parent.register.member.locale', 'kr')}}">
                            <img width="80px" height="80px" src="{{ asset('images/korea.png') }}" alt="">
                        </a>
                        <a href="{{route('parent.register.member.locale', 'jp')}}">
                            <img width="80px" height="80px" src="{{ asset('images/japan.webp') }}" alt="">
                        </a>
                        <a href="{{route('parent.register.member.locale', 'cn')}}">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection