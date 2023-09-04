@foreach($listMessage as $message)
    @php
        $userFrom = \App\Models\User::find($message->from_user_id);
        $userTo = \App\Models\User::find($message->to_user_id);
    @endphp
    {!! $message->chat_message !!}
    <p class="small">{{ __('home.received-by') }}
        <span>{{$userTo->name}}</span>, {{ __('home.posted-by') }}
        <span>{{$userFrom->name}}</span>, {{ __('home.posted-by') }}
        <span>{{$message->created_at}}</span>, {{ __('home.time') }}
        <span>{{$message->message_status}}  {{ __('home.Status') }}
    </p>
@endforeach