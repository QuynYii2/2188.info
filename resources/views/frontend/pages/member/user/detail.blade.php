{{--@extends('frontend.layouts.master')--}}

{{--@section('title', 'Register Member')--}}

{{--@section('content')--}}
{{--    @if($member)--}}
{{--        @php--}}
{{--            $memberItem = \App\Models\Member::find($member->member_id);--}}
{{--            $arrayPermissionMember = null;--}}
{{--            if ($memberItem){--}}
{{--                $listPermissionMember = $memberItem->permission_id;--}}
{{--                if ($listPermissionMember){--}}
{{--                    $arrayPermissionMember = explode(',', $listPermissionMember);--}}
{{--                }--}}
{{--            }--}}
{{--        @endphp--}}
{{--        <link rel="stylesheet" href="{{asset('css/register_member.css')}}">--}}
{{--        <div class="start-page mb-3">--}}
{{--            <div class="background container-fluid pt-3 justify-content-center pb-3">--}}
{{--                <div class="row card">--}}
{{--                    <div class="form-title text-center pt-2">--}}
{{--                        <div class="title">{{ __('home.Payment Register Member') }}</div>--}}
{{--                    </div>--}}
{{--                    <h3 class="text-center">--}}
{{--                        Gia nhập hội viên {{$memberItem->name}}--}}
{{--                    </h3>--}}
{{--                    <div class="mt-5">--}}
{{--                        <div class="row p-5">--}}
{{--                            <br>--}}
{{--                            <h5>Info</h5>--}}
{{--                            <table class="table table-bordered">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Full Name</th>--}}
{{--                                    <th scope="col">Phone Number</th>--}}
{{--                                    <th scope="col">Fax</th>--}}
{{--                                    <th scope="col">Company</th>--}}
{{--                                    <th scope="col">Member</th>--}}
{{--                                    <th scope="col">Address</th>--}}
{{--                                    <th scope="col">Status</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td>{{ ($member->name) }}</td>--}}
{{--                                    <td>{{ ($member->phone) }}</td>--}}
{{--                                    <td>{{ ($member->fax) }}</td>--}}
{{--                                    <td>{{ ($member->code_business) }}</td>--}}
{{--                                    <td>{{ ($member->member) }}</td>--}}
{{--                                    <td>{{ ($member->address) }}</td>--}}
{{--                                    <td>{{ ($member->status) }}</td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                            @php--}}
{{--                                $memberRegisterSource = \App\Models\MemberRegisterPersonSource::where([--}}
{{--                                    ['member_id', $member->id],--}}
{{--                                    ['type', \App\Enums\MemberRegisterType::SOURCE]])->orderBy('created_at', 'desc')->first();--}}
{{--                            @endphp--}}
{{--                            <h5>Account Member Source</h5>--}}
{{--                            <table class="table table-bordered">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Full Name</th>--}}
{{--                                    <th scope="col">Phone Number</th>--}}
{{--                                    <th scope="col">Email</th>--}}
{{--                                    <th scope="col">Status</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td>{{ ($memberRegisterSource->name) }}</td>--}}
{{--                                    <td>{{ ($memberRegisterSource->phone) }}</td>--}}
{{--                                    <td>{{ ($memberRegisterSource->email) }}</td>--}}
{{--                                    <td>{{ ($memberRegisterSource->status) }}</td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                            @php--}}
{{--                                $memberRegisterRepresent = \App\Models\MemberRegisterPersonSource::where([--}}
{{--                                    ['person', $memberRegisterSource->id],--}}
{{--                                    ['type', \App\Enums\MemberRegisterType::REPRESENT]])->orderBy('created_at', 'desc')->first();--}}
{{--                            @endphp--}}
{{--                            <h5>Account Member Represent</h5>--}}
{{--                            <table class="table table-bordered">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Full Name</th>--}}
{{--                                    <th scope="col">Phone Number</th>--}}
{{--                                    <th scope="col">Email</th>--}}
{{--                                    <th scope="col">Status</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td>{{ ($memberRegisterRepresent->name) }}</td>--}}
{{--                                    <td>{{ ($memberRegisterRepresent->phone) }}</td>--}}
{{--                                    <td>{{ ($memberRegisterRepresent->email) }}</td>--}}
{{--                                    <td>{{ ($memberRegisterRepresent->status) }}</td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                            <div class="col-md-6 border">--}}
{{--                                <h5 class="text-center">Quyền lợi hội viên</h5>--}}
{{--                                @if($arrayPermissionMember)--}}
{{--                                    <ol class="text-success">--}}
{{--                                        @foreach($arrayPermissionMember as $permissionMember)--}}
{{--                                            <li>--}}
{{--                                                @php--}}
{{--                                                    $permission = \App\Models\Permission::find($permissionMember);--}}
{{--                                                @endphp--}}
{{--                                                {{$permission->name}}--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ol>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 border">--}}
{{--                                @if($memberItem)--}}
{{--                                    <h5 class="text-center">Mức giá</h5>--}}
{{--                                    PRICE:--}}
{{--                                    <span class="text-danger" style="font-weight: 600; font-size: 36px">--}}
{{--                                    $ {{$memberItem->price}}--}}
{{--                                </span>--}}
{{--                                    <input hidden="" type="text" name="price"--}}
{{--                                           value="{{$memberItem->price}}">--}}
{{--                                    <p class="text-success small">Thanh toan thanh cong</p>--}}
{{--                                @endif--}}
{{--                                @if($member->member != \App\Enums\RegisterMember::POWER_PRODUCTION)--}}
{{--                                    <div class="float-left mt-5">--}}
{{--                                        <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">--}}
{{--                                            {{ __('home.upgrade') }} {{ __('home.Member') }}--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                @else--}}
{{--                                    <div class="float-left mt-5">--}}
{{--                                        <a href="#" disabled="" class="btn btn-secondary">--}}
{{--                                            {{ __('home.upgrade') }} {{ __('home.Member') }}--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                <div class="float-right mt-5">--}}
{{--                                    <a href="{{route('homepage')}}" class="btn btn-success">--}}
{{--                                        Back to home--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Modal -->--}}
{{--        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--             aria-hidden="true">--}}
{{--            <div class="modal-dialog" role="document">--}}
{{--                <form method="POST" action="{{route('member.registered.update')}}">--}}
{{--                    @csrf--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h5 class="modal-title" id="exampleModalLabel">{{ __('home.upgrade') }} {{ __('home.Member') }} </h5>--}}
{{--                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="inputMember">Member</label>--}}
{{--                                <select id="inputMember" name="member" class="form-control">--}}
{{--                                    @if($member)--}}
{{--                                        @if($member->member == \App\Enums\RegisterMember::VENDOR)--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::POWER_VENDOR}}">{{\App\Enums\RegisterMember::POWER_VENDOR}}</option>--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::PRODUCTION}}">{{\App\Enums\RegisterMember::PRODUCTION}}</option>--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::POWER_PRODUCTION}}">{{\App\Enums\RegisterMember::POWER_PRODUCTION}}</option>--}}
{{--                                        @elseif($member->member == \App\Enums\RegisterMember::POWER_VENDOR)--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::PRODUCTION}}">{{\App\Enums\RegisterMember::PRODUCTION}}</option>--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::POWER_PRODUCTION}}">{{\App\Enums\RegisterMember::POWER_PRODUCTION}}</option>--}}
{{--                                        @elseif($member->member == \App\Enums\RegisterMember::PRODUCTION)--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::POWER_PRODUCTION}}">{{\App\Enums\RegisterMember::POWER_PRODUCTION}}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::VENDOR}}">{{\App\Enums\RegisterMember::VENDOR}}</option>--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::POWER_VENDOR}}">{{\App\Enums\RegisterMember::POWER_VENDOR}}</option>--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::PRODUCTION}}">{{\App\Enums\RegisterMember::PRODUCTION}}</option>--}}
{{--                                            <option value="{{\App\Enums\RegisterMember::POWER_PRODUCTION}}">{{\App\Enums\RegisterMember::POWER_PRODUCTION}}</option>--}}
{{--                                        @endif--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Close')}}</button>--}}
{{--                            <button type="submit" class="btn btn-primary">{{ __('home.update') }}</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--@endsection--}}