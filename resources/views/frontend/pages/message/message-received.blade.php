@extends('frontend.layouts.master')

@section('title', 'List Message Received')

@section('content')
    <h3 class="text-center">Tin nhắn đã nhận</h3>
    @if($company)
        @php
            $user = null;
        @endphp
        <div class="container mb-2">
            <h3 class="text-center">{{ __('home.Member booth') }}{{$company->member}}</h3>
            <h3 class="text-left">{{ __('home.Member') }}{{$company->member}}</h3>
            <div class="d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('stand.register.member.index', $company->id) }}"
                   class="btn btn-primary">{{ __('home.Booth') }}</a>
                <a href="{{route('partner.register.member.index')}}"
                   class="btn btn-warning">{{ __('home.Partner List') }}</a>
                <a href="{{route('chat.message.received')}}"
                   class="btn btn-primary">{{ __('home.Message received') }}</a>
                <a href="{{route('chat.message.sent')}}" class="btn btn-warning">{{ __('home.Message sent') }}</a>
                <a href="#" class="btn btn-primary" data-toggle="modal"
                   data-target="#exampleModalDemo">{{ __('home.Purchase') }}</a>
                <a href="#" class="btn btn-warning" data-toggle="modal"
                   data-target="#exampleModalBuyBulk">{{ __('home.Foreign wholesale order') }}</a>
            </div>
            <div class="row m-0">
                <div class="col-md-6 border">
                    <div class="row">
                        <div class="col-md-12 border">
                            <div class="mb-3">
                                @if(locationHelper() == 'kr')
                                    {{ ($company->name_ko) }}
                                @elseif(locationHelper() == 'cn')
                                    {{ ($company->name_zh) }}
                                @elseif(locationHelper() == 'jp')
                                    {{ ($company->name_ja) }}
                                @elseif(locationHelper() == 'vi')
                                    {{ ($company->name_vi) }}
                                @else
                                    {{ ($company->name_en) }}
                                @endif
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
                        <div class="col-md-12 border">
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="width: 18rem;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">Message</div>
                            <div class="">
                                <a href="{{route('chat.message.show')}}" class="btn btn-primary">Chat Now</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(!$listMessage->isEmpty())
                                @foreach($listMessage as $message)
                                    @php
                                        $user = \App\Models\User::find($message->from_user_id);
                                    @endphp
                                    <div class="card-item-message card-item mb-3" data-message="{{$message}}"
                                         data-user="{{$user}}" style="cursor: pointer">
                                        <img src="{{ asset('storage/'.$user->image) }}" alt="" width="60px"
                                             height="60xp">
                                        <h5 class="card-title">{{$user->name}}</h5>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{--        {{ $listMessage->links() }}--}}
                </div>
                @if(!$listMessage->isEmpty())
                    @php
                        $user = \App\Models\User::find($listMessage[0]->from_user_id);
                    @endphp
                    <div class="col-md-6">
                        <div class="card">
                            <h5 id="chat_user" class="text-center">{{$user->name}}</h5>
                            <h5 id="chat_message">

                            </h5>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Chat</button>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    @endif
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('frontend.pages.message.chat-detail')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.card-item-message').on('click', function () {
                let message = $(this).data('message');
                let user = $(this).data('user');
                $('#chat_user').html(user['name']);
                $('#chat_message').html(message['chat_message']);
                renderMessage(message['from_user_id'], {{auth()->user()->id}});
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
                    $('#chat_message').empty().append(response);
                })
                .catch(error => console.log(error));
        }

        function renderDefault() {
            let listMessage = $('.card-item-message');
            let messageDefault = $(listMessage[0]).data('message');
            renderMessage(messageDefault['from_user_id'], {{auth()->user()->id}});
        }

        renderDefault();
    </script>
@endsection
