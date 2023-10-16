<link rel="stylesheet" href="{{asset('css/register_member.css')}}">
<link href="{{asset('css/voucher.css')}}" rel="stylesheet">

<div class="container-fluid">
    <div class="d-flex">
        <a href="{{route('profile.show')}}" class="btn btn-success mr-3">{{ __('home.info_company') }}</a>
        <a href="{{route('profile.member.person')}}" class="btn btn-success mr-3">{{ __('home.Registrator Information') }}</a>
        <a href="{{route('profile.member.represent')}}" class="btn btn-success mr-3">{{ __('home.Representative Information') }}</a>
        <a href="#" class="btn btn-success">{{ __('home.Staffs Information') }}</a>
    </div>

    <h3 class="text-center mt-5">{{ __('home.Congratulations, you have registered as a member') }} {{$company->member}}</h3>
    <div class="start-page mb-3">
        <div class="background pt-3 justify-content-center pb-3">
            <div class="form-title text-center solid-3x pt-2 pb-3 bg-member-green">
                <div class="title text-primary"
                     style="font-size: 35px; font-weight: 600">{{ __('home.Sign up company information') }}</div>
            </div>
            <div class="">
                @if($company->member == \App\Enums\RegisterMember::BUYER)
                    @include('frontend.pages.registerMember.buyer')
                @else
                    @include('frontend.pages.registerMember.more-member-other')
                @endif
                <h2 id="result"></h2>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-address" tabindex="-1" aria-labelledby="modal-addressLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.address') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 65vh; overflow-y: auto">
                    @include('frontend.pages.registerMember.regionAddress')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Close') }}</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="handleSelectRegion()">{{ __('home.save changes') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var urlGetLocation = `{{ route('location.nation.get') }}`;
    var token = `{{ csrf_token() }}`;
    var urlGetState = `{{ route('location.state.get', ['id' => ':id']) }}`;
    var urlGetCity = `{{ route('location.city.get', ['id' => ':id', 'code' => ':code']) }}`;

</script>
<script src="{{ asset('js/frontend/pages/member/detail-company.js') }}"></script>