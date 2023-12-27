<link rel="stylesheet" href="{{asset('css/register_member.css')}}">
<link href="{{asset('css/voucher.css')}}" rel="stylesheet">
<div class="container-fluid">
    @if(!isset($isAdminUpdate))
        <h3 class="text-center mt-5">{{ __('home.Congratulations, you have registered as a member') }} {{$company->member}}</h3>
    @endif
    <div class="start-page mb-3">
        <div class="background pt-3 justify-content-center pb-3">
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