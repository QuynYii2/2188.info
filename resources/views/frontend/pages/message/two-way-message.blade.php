@foreach($listMessage as $message)
    @php
        $userFrom = \App\Models\User::find($message->from_user_id);
        $userTo = \App\Models\User::find($message->to_user_id);
    @endphp
    {!! $message->chat_message !!}
    <p class="small">{{ __('home.received-by') }}
        <span>{{$userTo->name}} : <b>{{ __('home.posted-by') }}</b> </span>
        <span>{{$userFrom->name}} : <b> {{ __('home.posted-by') }} </b></span>
        <span>{{$message->created_at}} : <b> {{ __('home.time') }} </b></span>
        <span>{{$message->message_status}} : <b> {{ __('home.Status') }} </b></span>
    </p>
@endforeach