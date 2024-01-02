@php
    $memberPer = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->first();
    $mentor = \App\Models\User::where('email', $memberPer->email)->first();
@endphp
<style>
    td, th, tr, table {
        border: none !important;
        text-align: start;
    }

    td {
        color: #000;
        font-size: 12px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }

    th {
        color: #929292;

        font-size: 12px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
</style>
<div class="start-page mb-3">
    <div class="background container-fluid pt-3 justify-content-center pb-3">
        <div class="">
            <div class="title-staff-member">
                {{ __('home.Employee registed staff') }}
            </div>
            <div class="d-flex justify-content-end mb-4">
                <a type="button" class="btn-add_staff" data-toggle="modal"
                   data-target="#modalRegisterMore">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <path d="M12.5 2C9.88 2 7.75 4.13 7.75 6.75C7.75 9.32 9.76 11.4 12.38 11.49C12.46 11.48 12.54 11.48 12.6 11.49C12.62 11.49 12.63 11.49 12.65 11.49C12.66 11.49 12.66 11.49 12.67 11.49C15.23 11.4 17.24 9.32 17.25 6.75C17.25 4.13 15.12 2 12.5 2Z"
                              fill="white"/>
                        <path d="M17.58 14.1499C14.79 12.2899 10.24 12.2899 7.42996 14.1499C6.15996 14.9999 5.45996 16.1499 5.45996 17.3799C5.45996 18.6099 6.15996 19.7499 7.41996 20.5899C8.81996 21.5299 10.66 21.9999 12.5 21.9999C14.34 21.9999 16.18 21.5299 17.58 20.5899C18.84 19.7399 19.54 18.5999 19.54 17.3599C19.53 16.1299 18.84 14.9899 17.58 14.1499ZM14.5 18.1299H13.25V19.3799C13.25 19.7899 12.91 20.1299 12.5 20.1299C12.09 20.1299 11.75 19.7899 11.75 19.3799V18.1299H10.5C10.09 18.1299 9.74996 17.7899 9.74996 17.3799C9.74996 16.9699 10.09 16.6299 10.5 16.6299H11.75V15.3799C11.75 14.9699 12.09 14.6299 12.5 14.6299C12.91 14.6299 13.25 14.9699 13.25 15.3799V16.6299H14.5C14.91 16.6299 15.25 16.9699 15.25 17.3799C15.25 17.7899 14.91 18.1299 14.5 18.1299Z"
                              fill="white"/>
                    </svg>
                    {{ __('home.More staff') }}
                </a>
            </div>

            <table class="table element-bordered text-center" id="tableMemberShip">
                <tbody>
                <tr>
                    <th rowspan="2" scope="col">{{ __('home.Responsibility') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.Position') }}</th>
                    <th scope="col">{{ __('home.Name English') }}</th>
                    <th scope="col">{{ __('home.Name Korea') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.ID') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.Phone Number') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.email') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.SNS Account') }}</th>
                </tr>
                <tr>

                </tr>
                @php
                    if ($memberSource){
                      $user1 = \App\Models\User::where('email', $memberSource->email)->first();
                    }
                    $staffs = null;
                    if ($memberRepresent && $memberSource){
                        $user2 = \App\Models\User::where('email', $memberRepresent->email)->first();
                        $staffs = \App\Models\StaffUsers::where('parent_user_id', $user1->id)->orWhere('parent_user_id', $user2->id)->get();
                    }
                @endphp
                @if($staffUsers)
                    @if($staffUsers->isNotEmpty())
                        @foreach($staffUsers as $staff)
                            <tr>
                                <td>{{$staff->phu_trach}}</td>
                                <td>{{$staff->chuc_vu}}</td>
                                @php
                                    $infoStaff = \App\Models\User::where('id',$staff->user_id)->first();
                                @endphp
                                <td>{{$infoStaff->nickname}}</td>
                                <td>{{$infoStaff->name}}</td>
                                <td>{{$infoStaff->rental_code}}</td>
                                <td>{{$infoStaff->phone}}</td>
                                <td>{{$infoStaff->email}}</td>
                                <td>{{$infoStaff->social_media}}</td>
                            </tr>
                        @endforeach

                    @endif
                @endif
                </tbody>
            </table>
            <div class=" mt-3 ml-1">
                <div class="">

                </div>
                <div id="buttonRegisterMembership">

                </div>
                <!-- Modal -->
                <div class="modal fade" id="modalRegisterMore" tabindex="-1" role="dialog"
                     aria-labelledby="modalRegisterMoreLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="modalRegisterMoreLabel">{{ __('home.Sign up for more') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="{{ route('create.staff.register', $userRepresent->id) }}"
                                          method="post"
                                          enctype="multipart/form-data"
                                          class="form-horizontal row" role="form">
                                        @csrf
                                        @if (session('success_update_product'))
                                            <div class="alert alert-success">
                                                {{ session('error_create_product') }}
                                            </div>
                                        @endif
                                        <div class="col-12 rm-pd-on-mobile">
                                            <div class="form-group">
                                                <div class="name">{{ __('home.Position') }}</div>
                                                <input type="text" class="form-control" name="chuc_vu" id="chuc_vu"
                                                       placeholder={{ __('home.Position') }} required>

                                            </div>
                                            <div class="form-group">
                                                <div class="name">{{ __('home.full name') }}</div>
                                                <input type="text" class="form-control" name="name" id="name"
                                                       placeholder={{ __('home.Nhập Họ tên') }} required>
                                            </div>
                                            <div class="form-group">
                                                <div class="name">{{ __('home.phone number') }}</div>
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                       placeholder="{{ __('home.Nhập số điện thoại') }}"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <div class="name">{{ __('home.social network id') }}</div>
                                                <input type="text" class="form-control" name="social_media"
                                                       id="social_media"
                                                       placeholder={{ __('home.Nhập id mxh') }} required>
                                            </div>

                                            <input type="text" hidden name="type_account" id="type_account"
                                                   value="seller">
                                        </div>
                                        <div class="col-12 rm-pd-on-mobile">
                                            <div class="form-group">
                                                <div class="name">{{ __('home.Responsibility') }}</div>
                                                <input type="text" class="form-control" name="phu_trach"
                                                       id="phu_trach"
                                                       placeholder={{ __('home.Responsibility') }} required>
                                            </div>
                                            <div class="form-group">
                                                <div class="name">영 문</div>
                                                <input type="text" class="form-control" name="nickname"
                                                       id="nickname"
                                                       placeholder={{ __('home.Nhập biệt danh') }} required>
                                            </div>
                                            <div class="form-group">
                                                <div class="name">{{ __('home.email') }}</div>
                                                <input type="text" class="form-control" name="email" id="email"
                                                       placeholder={{ __('home.Nhập email') }} required>
                                            </div>
                                            <div class="form-group">
                                                <div class="name">{{ __('home.Password') }}</div>
                                                <input type="password" class="form-control" name="password"
                                                       id="password"
                                                       placeholder={{ __('home.Nhập mật khẩu') }} required>
                                            </div>
                                        </div>


                                        <input id="input-form-create-attribute" name="attribute_property"
                                               type="text" hidden>
                                        <div class="form-group col-12 ">
                                            <div class="row justify-content-end">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('home.Close') }}</button>
                                                <button type="submit"
                                                        class="btn btn-success">{{ __('home.Gửi') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        if (localStorage.getItem("register_membership")) {
            let html = '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalRegisterMembership">{{ __('home.Employee registration') }}</button>';
            $('#buttonRegisterMembership').empty().append(html);
        }
    })
</script>