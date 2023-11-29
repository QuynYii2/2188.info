@extends('frontend.layouts.master')
@section('title', 'Partner Register Members')
@section('content')
    @php
        $memberPer = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->first();
        $mentor = \App\Models\User::where('email', $memberPer->email)->first();
    @endphp
    <div class="container">
        <style>
            .hidden {
                display: none !important;
            }
        </style>
        <h3 class="text-center">{{ __('home.Partner List') }}</h3>
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
                <th scope="col">{{ __('home.Membership classification') }}</th>
                <th scope="col">{{ __('home.Status') }}</th>
                <th scope="col">{{ __('home.Customer level') }}</th>
            </tr>
            </thead>
            <tbody>
            @if(!$memberList->isEmpty())
                @foreach($memberList as $memberItem)
                    <tr>
                        <td scope="row">
                            @if($memberItem->number_business != 'default number business')
                                @if($memberItem->number_business != 'item_is_null')
                                    {{$memberItem->number_business}}
                                @endif
                            @endif
                        </td>
                        <td>
                            {{$locale}}
                        </td>
                        <td>
                            <span data-toggle="modal" data-target="#modelDetail_{{$memberItem->id}}"
                                  style="cursor: pointer" class="btn btn-outline-secondary">{{$memberItem->name}}</span>
                            <div class="modal fade" id="modelDetail_{{$memberItem->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel_{{$memberItem->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-member">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="exampleModalLabel_{{$memberItem->id}}">{{ __('home.Company Name') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th>{{ __('home.Independent Customs Clearance') }}</th>
                                                    <td colspan="3">{{ __('home.General Customs Clearance') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('home.Company Name') }}</th>
                                                    <td>{{$memberItem->name}}</td>
                                                    <th>{{ __('home.Member') }}</th>
                                                    <td>{{$memberItem->member}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('home.Name company English') }}</th>
                                                    <td>{{$memberItem->name_en}}</td>
                                                    <th>{{ __('home.Day register') }}</th>
                                                    <td>{{$memberItem->datetime_register}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('home.address') }}</th>
                                                    <td colspan="3">{{$memberItem->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('home.Phone Number') }}</th>
                                                    <td>{{$memberItem->phone}}</td>
                                                    <th>{{ __('home.Business license') }}</th>
                                                    <td>{{$memberItem->number_business}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('home.email') }}</th>
                                                    <td>{{$memberItem->email}}</td>
                                                    <th>{{ __('home.Category') }}</th>
                                                    <td>
                                                        @php
                                                            $arrayCategory = explode(',',  $memberItem->category_id);
                                                            $categories = \App\Models\Category::whereIn('id', $arrayCategory)->get();
                                                        @endphp
                                                        @foreach($categories as $category)
                                                            @if(locationHelper() == 'kr')
                                                                {{ $category->name_ko }},
                                                            @elseif(locationHelper() == 'cn')
                                                                {{$category->name_zh}},
                                                            @elseif(locationHelper() == 'jp')
                                                                {{$category->name_ja}},
                                                            @elseif(locationHelper() == 'vi')
                                                                {{$category->name_vi}},
                                                            @else
                                                                {{$category->name_en}},
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('home.Fax') }}</th>
                                                    <td>{{$memberItem->fax}}</td>
                                                    <th>{{ __('home.Home') }}</th>
                                                    <td>{{$memberItem->homepage}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('home.Number clearance') }}</th>
                                                    <td colspan="3">{{$memberItem->number_clearance}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('stand.register.member.index', $memberItem->id) }}"
                                               class="btn btn-primary">{{ __('home.Shop') }}</a>
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('home.Close') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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
        {{ $memberList->links() }}
    </div>
@endsection