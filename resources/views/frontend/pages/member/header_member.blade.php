<div class="">
    @php
        $getMemberId = \App\Models\MemberRegisterPersonSource::where('email' , Auth::user()->email)->value('member_id');
        $memberId = \App\Models\MemberRegisterPersonSource::where('member_id',$getMemberId)->value('id');
    @endphp
    @if($getMemberId == $company->id)
        <div  class="d-flex justify-content-between align-items-center p-3">
            <div>
                <a href="{{ route('stand.register.member.index', $company->id) }}"
                   class="btn btn-warning mr-2 d-inline-block">{{ __('home.Booth') }}</a>
                <a href="{{route('partner.register.member.index')}}"
                   class="btn btn-primary d-inline-block">{{ __('home.Partner List') }}</a>
                @if(getTypeMember()->member == 'LOGISTIC')
                    <a href="{{ route('seller.products.index') }}"
                       class="btn btn-primary d-inline-block">{{ __('home.manager_products') }}</a>
                @endif
            </div>
            <div>
                <a href="{{route('chat.message.received')}}"
                   class="btn btn-primary mr-2 d-inline-block">{{ __('home.Message received') }}</a>
                <a href="{{route('chat.message.sent')}}"
                   class="btn btn-primary mr-2 d-inline-block">{{ __('home.Message sent') }}</a>
            </div>
            <div>
                <a href="#" class="btn btn-primary mr-2" data-toggle="modal"
                   data-target="#exampleModalDemo">{{ __('home.Purchase') }}</a>
                <a href="#" class="btn btn-primary mr-2" data-toggle="modal"
                   data-target="#exampleModalBuyBulk">{{ __('home.Foreign wholesale order') }}</a>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center p-3">
            <div>
                <a href="{{ route('member.info') }}" class="btn btn-success mr-3">{{ __('home.info_company') }}</a>
                <a href="{{route('profile.member.person')}}" class="btn btn-success mr-3">{{ __('home.Registrator Information') }}</a>
                <a href="{{route('profile.member.represent')}}" class="btn btn-success mr-3">{{ __('home.Representative Information') }}</a>
                <a href="{{route('staff.member.info', $memberId)}}" class="btn btn-success mr-3">{{ __('home.Staffs Information') }}</a>
            </div>
            <div>
                <a href="{{route('checkout.show')}}" class="btn btn-success">{{ __('home.Check out now') }}</a>
                <a href="{{route('homepage')}}" class="btn btn-success">{{ __('home.Home') }}</a>
            </div>

        </div>
    @endif

</div>

<div class="modal fade" id="exampleModalDemo" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
        <div class="modal-content p-4" style="width: auto">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Chọn quốc gia mua hàng') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="https://shipgo.biz/kr">
                        <img width="80px" height="80px" src="{{ asset('images/korea.png') }}" alt=""
                             style="border: 1px solid; margin: 20px">
                    </a>
                    <a href="https://shipgo.biz/jp">
                        <img width="80px" height="80px" src="{{ asset('images/japan.webp') }}" alt=""
                             style="border: 1px solid; margin: 20px">
                    </a>
                    <a href="https://shipgo.biz/cn">
                        <img width="80px" height="80px" src="{{ asset('images/china.webp') }}" alt=""
                             style="border: 1px solid; margin: 20px">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalBuyBulk" role="dialog" aria-labelledby="exampleModalBuyBulk"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
        <div class="modal-content p-4" style="width: auto">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Chọn quốc gia mua hàng') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{route('parent.register.member.locale', 'kr')}}">
                            <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                 src="{{ asset('images/korea.png') }}"
                                 alt="">
                        </a>
                        <a href="{{route('parent.register.member.locale', 'jp')}}">
                            <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                 src="{{ asset('images/japan.webp') }}"
                                 alt="">
                        </a>
                        <a href="{{route('parent.register.member.locale', 'cn')}}">
                            <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                 src="{{ asset('images/china.webp') }}"
                                 alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>