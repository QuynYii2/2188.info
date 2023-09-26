<div class="container-fluid">
    <div class="d-flex">
        <a href="{{route('profile.show')}}" class="btn btn-success mr-3">{{ __('home.info_company') }}</a>
        <a href="{{route('profile.member.person')}}"
           class="btn btn-success mr-3">{{ __('home.Registrator Information') }}</a>
        <a href="{{route('profile.member.represent')}}"
           class="btn btn-success mr-3">{{ __('home.Representative Information') }}</a>
        <a href="#" class="btn btn-success">{{ __('home.Staffs Information') }}</a>
    </div>

    <h3 class="text-center mt-5">{{ __('home.Update information represent member') }}</h3>
    <div class="start-page mb-3">
        <div class="background container pt-3 justify-content-center pb-3">
            <div class="">
                @if($memberPerson->type == \App\Enums\MemberRegisterType::REPRESENT)
                    @include('frontend.pages.registerMember.member-person-repersent')
                @endif
            </div>
        </div>
    </div>
</div>


