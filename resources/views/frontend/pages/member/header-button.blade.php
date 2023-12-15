@php
    $getMemberId = \App\Models\MemberRegisterPersonSource::where('email' , Auth::user()->email)->value('member_id');
    $memberId = \App\Models\MemberRegisterPersonSource::where('member_id',$getMemberId)->value('id');
@endphp
<div class="d-flex align-items-center justify-content-center">
    <a href="{{route('member.info')}}" class="btn btn-success mr-3">{{ __('home.info_company') }}</a>
    <a href="{{route('profile.member.person')}}"
       class="btn btn-success mr-3">{{ __('home.Registrator Information') }}</a>
    <a href="{{route('profile.member.represent')}}"
       class="btn btn-success mr-3">{{ __('home.Representative Information') }}</a>
    <a href="{{route('staff.member.info', $memberId)}}" class="btn btn-success">{{ __('home.Staffs Information') }}</a>

</div>

{{--<nav>--}}
{{--    <div class="nav nav-tabs nav-fill d-flex justify-content-between align-items-center"--}}
{{--         id="nav-tab" role="tablist">--}}
{{--        <a class="nav-item link-tabs nav-link active" data-toggle="tab" data-target="#nav-1"--}}
{{--           role="tab" aria-controls="nav-1" aria-selected="true">--}}
{{--            {{ __('home.info_company') }}--}}
{{--        </a>--}}
{{--        <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-2" role="tab"--}}
{{--           aria-controls="nav-2" aria-selected="false">--}}
{{--            {{ __('home.Registrator Information') }}--}}
{{--        </a>--}}
{{--        <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-3"--}}
{{--           role="tab" aria-controls="nav-3" aria-selected="false">--}}
{{--            {{ __('home.Representative Information') }}--}}
{{--        </a>--}}
{{--        <a class="nav-item link-tabs nav-link" data-toggle="tab" data-target="#nav-4" role="tab"--}}
{{--           aria-controls="nav-4" aria-selected="false">--}}
{{--            {{ __('home.Staffs Information') }}--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</nav>--}}
{{--<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">--}}
{{--    <div class="tab-pane fade active show" id="nav-1" role="tabpanel"--}}
{{--         aria-labelledby="nav-contact-tab">--}}
{{--        @include('frontend.pages.member.detail-company')--}}
{{--    </div>--}}
{{--    <div class="tab-pane fade text-center" id="nav-2" role="tabpanel"--}}
{{--         aria-labelledby="nav-contact-tab">--}}
{{--        2222--}}
{{--    </div>--}}
{{--    <div class="tab-pane fade text-center" id="nav-3" role="tabpanel"--}}
{{--         aria-labelledby="nav-contact-tab">--}}
{{--        3333--}}
{{--    </div>--}}
{{--    <div class="tab-pane fade text-center" id="nav-4" role="tabpanel"--}}
{{--         aria-labelledby="nav-contact-tab">--}}
{{--        4444--}}
{{--    </div>--}}
{{--</div>--}}