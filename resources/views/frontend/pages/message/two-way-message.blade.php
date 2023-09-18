@foreach($listMessage as $message)
    @php
        $userFrom = \App\Models\User::find($message->from_user_id);
        $userTo = \App\Models\User::find($message->to_user_id);
    @endphp
    {!! $message->chat_message !!}
    <p class="small mt-3">
        <span class="d-flex">{{ __('home.posted-by') }} :<b> {{$userTo->name}}</b> </span>
        <span class="d-flex">{{ __('home.received-by') }} :<b>  {{$userFrom->name}} </b></span>
        <span class="d-flex">{{ __('home.time') }} :<b>  {{$message->created_at}} </b></span>
        <span class="d-flex">{{ __('home.Status') }} :<b>  {{$message->message_status}} </b></span>
    </p>
@endforeach