@extends('frontend.layouts.master')
@section('title', 'Partner Register Members')
@section('content')
    @php
        $memberPer = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->first();
        $mentor = \App\Models\User::where('email', $memberPer->email)->first();
    @endphp
    <div class="container-fluid">
        <h3 class="text-center">{{ __('home.해외 B2B 도매상 명단') }}</h3>
        <div class=" d-flex justify-content-between align-items-center p-3">
            <div>
                <a href="{{route('stand.register.member.index', $company->id)}}"
                   class="btn btn-primary mr-2">{{ __('home.상품 전시장') }}</a>
                <a href="{{route('partner.register.member.index')}}"
                   class="btn btn-warning">{{ __('home.Partner List') }}</a>
            </div>
            <div>
                <a href="{{route('chat.message.received')}}" class="btn btn-primary mr-2">{{ __('home.Message received') }}</a>
                <a href="{{route('chat.message.sent')}}" class="btn btn-primary mr-2">{{ __('home.Message sent') }}</a>
                <a href="#" class="btn btn-primary mr-2" data-toggle="modal"
                   data-target="#exampleModal">{{ __('home.Purchase') }}</a>
                <a href="#" class="btn btn-primary mr-2" data-toggle="modal"
                   data-target="#exampleModalBuyBulk">{{ __('home.Foreign wholesale order') }}</a>
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
                <th scope="col">{{ __('home.Day trading') }}</th>
                <th scope="col">{{ __('home.Membership classification') }}</th>
                <th scope="col">{{ __('home.Status') }}</th>
                <th scope="col">{{ __('home.Customer level') }}</th>
            </tr>
            </thead>
            <tbody>
            @if(!$memberList->isEmpty())
                @foreach($memberList as $memberItem)
                    <tr>
                        <td scope="row">{{$memberItem->number_business}}</td>
                        <td>
                            {{$locale}}
                        </td>
                        <td>{{$memberItem->name}}</td>
                        <td>{{$memberItem->address}}</td>
                        <td>{{ \Carbon\Carbon::parse($memberItem->created_at)->format('d/m/Y') }}</td>
                        <td>{{$memberItem->member}}</td>
                        <td>
                            @php
                                $isValid = false;
                                $companyItem = \App\Models\MemberPartner::where([
                                    ['company_id_source', $memberItem->id],
                                    ['company_id_follow', $company->id],
                                    ['status', \App\Enums\MemberPartnerStatus::ACTIVE],
                                ])->first();
                            @endphp

                            @if(!$companyItem)
                                <form method="post" action="{{route('stands.register.member')}}">
                                    @csrf
                                    <input type="text" name="company_id_source"
                                           value="{{$memberItem->id}} "
                                           hidden>
                                    <button class="btn btn-primary" id="btnFollow" type="submit">
                                        {{ __('home.Follow') }}
                                    </button>
                                </form>
                            @else
                                <form method="post" action="{{ route('stands.unregister.member', $memberItem->id) }}">
                                    @csrf
                                    <input type="text" name="company_id_source"
                                           value="{{ $memberItem->id }}" hidden>
                                    <button class="btn btn-danger" id="btnUnfollow" type="submit">
                                        {{ __('home.Unfollow') }}
                                    </button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <i class="fa-solid fa-trophy"></i>
                            <i class="fa-solid fa-trophy"></i>
                            <i class="fa-solid fa-trophy"></i>
                        </td>

                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
        <div class="modal-dialog modal-dialog-centered" role="document">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection