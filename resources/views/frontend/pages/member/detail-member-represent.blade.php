<div class="container-fluid">
{{--    @include('frontend.pages.member.header-button')--}}

    <h3 class="text-center mt-5">{{ __('home.Update information represent member') }}</h3>
    <div class="start-page mb-3">
        <div class="background pt-3 justify-content-center pb-3">
            <div class="">
                @if($memberPerson->type == \App\Enums\MemberRegisterType::REPRESENT && $memberPerson->email == Auth::user()->email)
                    @include('frontend.pages.registerMember.member-person-repersent')
                @endif
            </div>
        </div>
    </div>
</div>


