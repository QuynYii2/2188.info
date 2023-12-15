<div class="container-fluid">
{{--    @include('frontend.pages.member.header-button')--}}

    <h3 class="text-center mt-5">{{ __('home.Update information register member') }}</h3>
    <div class="start-page mb-3">
        <div class="background pt-3 justify-content-center pb-3">
            <div class="">
                @if($memberPersonSource->type == \App\Enums\MemberRegisterType::SOURCE)
                    @include('frontend.pages.registerMember.member-person')
                @endif
            </div>
        </div>
    </div>
</div>


