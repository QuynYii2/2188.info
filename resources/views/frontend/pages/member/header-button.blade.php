@php
    $getMemberId = \App\Models\MemberRegisterPersonSource::where('email' , Auth::user()->email)->value('member_id');
    $memberId = \App\Models\MemberRegisterPersonSource::where('member_id',$getMemberId)->value('id');
@endphp
<div class="d-flex">
    <a href="{{route('profile.show')}}" class="btn btn-success mr-3">{{ __('home.info_company') }}</a>
    <a href="{{route('profile.member.person')}}" class="btn btn-success mr-3">{{ __('home.Registrator Information') }}</a>
    <a href="{{route('profile.member.represent')}}" class="btn btn-success mr-3">{{ __('home.Representative Information') }}</a>
    <a href="{{route('staff.member.info', $memberId)}}" class="btn btn-success">{{ __('home.Staffs Information') }}</a>
</div>