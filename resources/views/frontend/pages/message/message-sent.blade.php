@extends('frontend.layouts.master')

@section('title', 'List Message Sent')

@section('content')
    <h3 class="text-center">Tin nhắn đã gửi</h3>
    <div class="container mb-2">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">Message</div>
                    <div class="">
                        <a href="{{route('chat.message.show')}}" class="btn btn-primary">Chat Now</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(!$listMessage->isEmpty())
                    @foreach($listMessage as $message)
                        <div class="border">
                            @php
                                $user = \App\Models\User::find($message->to_user_id);
                            @endphp
                            <img src="{{ asset('storage/'.$user->image) }}" alt="" width="60px" height="60xp">
                            <h5 class="card-title">
                                <a href="{{route('chat.message.show')}}"> {{$user->name}}</a>
                            </h5>
                            <p class="card-text">{!! $message->chat_message !!}</p>
                            <p>Đã gửi tới:
                                <span class="text-body">{{$user->name}}</span>, Vào lúc:
                                <span>{{$message->created_at}}</span>, Trạng thái:
                                <span>{{$message->message_status}}
                            </p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        {{--        {{ $listMessage->links() }}--}}
    </div>
@endsection