@extends('frontend.layouts.master')

@section('title', 'List Message Sent')

@section('content')
    <h3 class="text-center">{{ __('home.Message sent') }}</h3>
    @if($company)
        @php
            $user = null;
            $companyPerson = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->first();
            $oldUser = \App\Models\User::where('email', $companyPerson->email)->first();
        @endphp
        <div class="container mb-2">
            <h3 class="text-center">{{ __('home.Member booth') }}{{$company->member}}</h3>
            <h3 class="text-left">{{ __('home.Member') }}{{$company->member}}</h3>
            @include('frontend.pages.member.header_member')
            <div class="row m-0">
                <div class="col-md-6 border">
                    <div class="row">
                        <div class="col-md-12 border" style="border-right: 1px solid white!important;">
                            <div class="mt-2">
                                <h5 class="mb-3">
                                    {{ ($company->name) }}
                                </h5>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <div class="mb-3 size"><b>{{ __('home.Company code') }}
                                            : </b> {{ ($company->code_business) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <div class="mb-3 size"><b>{{ __('home.Elite enterprise') }}
                                            : </b> {{ ($company->member) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <div class="mb-3 size"><b>{{ __('home.Membership classification') }}
                                            : </b> {{ ($company->member) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <div class="mb-3 size"><b>{{ __('home.Customer rating score') }}: </b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 border">
                    <div class="row">
                        <div class="col-md-12 border" style="border-left: 1px solid white!important;">
                            <div class="mt-2">
                                <h5 class="mb-3">{{ __('home.Specified products') }}</h5>
                            </div>
                        </div>
                        @php
                            $listCategory = $company->category_id;
                            $arrayCategory = explode(',', $listCategory);
                        @endphp
                        <div class="col-12">
                            <div class="row">
                                @foreach($arrayCategory as $itemArrayCategory)
                                    @php
                                        $category = \App\Models\Category::find($itemArrayCategory);
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="mt-2 d-flex">
                                            <a href="{{route('category.show', $category->id)}}" class="mb-3 size">
                                                @if(locationHelper() == 'kr')
                                                    {{ ($category->name_ko) }}
                                                @elseif(locationHelper() == 'cn')
                                                    {{ ($category->name_zh) }}
                                                @elseif(locationHelper() == 'jp')
                                                    {{ ($category->name_ja) }}
                                                @elseif(locationHelper() == 'vi')
                                                    {{ ($category->name_vi) }}
                                                @else
                                                    {{ ($category->name_en) }}
                                                @endif
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!$listMessage->isEmpty())
            <div class="row">
                <div class="col-md-3">
                    <div class="card-body">
                                @foreach($listMessage as $message)
                                    @php
                                        $user = \App\Models\User::find($message->to_user_id);
                                    @endphp
                                    <div class="card-item-message card-item mb-3" data-message="{{$message}}"
                                         data-user="{{$user}}" style="cursor: pointer">
                                        <img src="{{ asset('storage/'.$user->image) }}" alt="" width="60px"
                                             height="60xp">
                                        <h5 class="card-title">
                                            {{$user->name}}
                                            <hr>
                                        </h5>
                                    </div>
                                @endforeach
                        </div>
                    {{--        {{ $listMessage->links() }}--}}
                </div>
                    @php
                        $user = \App\Models\User::find($listMessage[0]->to_user_id);
                    @endphp
                    <div class="col-md-9">
                        <div class="card">
                            <h5 id="chat_user" class="text-center">{{$user->name}}</h5>
                            <h5 id="chat_message">

                            </h5>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">{{ __('home.chat') }}</button>
                        </div>
                    </div>
            </div>
            @else
                <div class="text-center mt-4">
                    {{ __('home.No sent messages') }}
                </div>
            @endif
        </div>
    @endif
    <script>
        $(document).ready(function () {
            $('.card-item-message').on('click', function () {
                let message = $(this).data('message');
                let user = $(this).data('user');
                $('#chat_user').html( user['name'] );
                $('#chat_message').html( message['chat_message'] );
                renderMessage({{auth()->user()->id}}, message['to_user_id']);
            })
        })

        function renderMessage(from, to) {
            let url = '/chat-message'
            fetch(url + '/' + from + '/' + to, {
                method: 'GET',
            })
                .then(response => {
                    if (response.status == 200) {
                        return response.text();
                    }
                })
                .then((response) => {
                    console.log('ádadad')
                    $('#chat_message').empty().append(response);
                })
                .catch(error => console.log(error));
        }

        function renderDefault() {
            let listMessage = $('.card-item-message');
            let messageDefault = $(listMessage[0]).data('message');
            renderMessage({{auth()->user()->id}}, messageDefault['to_user_id']);
        }

        renderDefault();
    </script>
@endsection