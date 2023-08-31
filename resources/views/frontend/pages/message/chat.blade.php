@extends('frontend.layouts.master')

@section('title', 'Chat')

@section('content')
    @include('frontend.pages.message.chat-detail')
@endsection
{{--<script>--}}
{{--   $(document).ready(function () {--}}
{{--      $('#message_area').on('change', function () {--}}
{{--         if ($(this).text() == '' || $(this).text() == null){--}}
{{--            console.log('disabled')--}}
{{--            $('#send_button').attr('disabled', 'disabled');--}}
{{--         } else {--}}
{{--            console.log('un disabled')--}}
{{--            $('#send_button').removeAttr('disabled');--}}
{{--         }--}}
{{--      })--}}
{{--   })--}}
{{--</script>--}}
