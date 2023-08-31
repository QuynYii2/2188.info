@foreach($listMessage as $message)
    @php
        $userFrom = \App\Models\User::find($message->from_user_id);
        $userTo = \App\Models\User::find($message->to_user_id);
    @endphp
    {!! $message->chat_message !!}
    <p class="small">Đã nhận từ:
        <span>{{$userTo->name}}</span>, Đuợc gửi bởi:
        <span>{{$userFrom->name}}</span>, Thời gian:
        <span>{{$message->created_at}}</span>, Trạng thái:
        <span>{{$message->message_status}}
    </p>
@endforeach