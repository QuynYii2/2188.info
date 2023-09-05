@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <div class="container">
        <h3 class="text-center">Đăng kí nhân viên</h3>
        <div class="container mt-3">
            <h5 class="">
                Thứ tự đăng ký:
            </h5>
            <br>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Phân loại hội viên</li>
                    <li class="breadcrumb-item">Đồng ý điều khoản</li>
                    <li class="breadcrumb-item"> Đăng ký công ty</li>
                    <li class="breadcrumb-item">Đăng ký người đăng ký</li>
                    <li class="breadcrumb-item">Đăng ký người đại diện</li>
                    <li class="breadcrumb-item active">Danh sách người quản lý</li>
                </ol>
            </nav>
            <h5 class="text-center mt-3">Danh sách người quản lý đã đăng kí</h5>
            <table class="table border">
                <thead>
                <tr>
                    <th scope="col">Phụ trách</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Tên English</th>
                    <th scope="col">Tên hiện tại</th>
                    <th scope="col">ID</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Email</th>
                    <th scope="col">SNS</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Người đại diện</td>
                    <td>{{$memberRepresent->staff}}</td>
                    <td>{{$memberRepresent->name_en}}</td>
                    <td>{{$memberRepresent->name}}</td>
                    <td>{{$memberRepresent->code}}</td>
                    <td>{{$memberRepresent->phone}}</td>
                    <td>{{$memberRepresent->email}}</td>
                    <td>{{$memberRepresent->sns_account}}</td>
                </tr>
                <tr>
                    <td>Người đăng ký</td>
                    <td>{{$memberSource->staff}}</td>
                    <td>{{$memberSource->name_en}}</td>
                    <td>{{$memberSource->name}}</td>
                    <td>{{$memberSource->code}}</td>
                    <td>{{$memberSource->phone}}</td>
                    <td>{{$memberSource->email}}</td>
                    <td>{{$memberSource->sns_account}}</td>
                </tr>
                </tbody>
            </table>
            <div class="row mt-3 border ml-1">
                <div class="col-md-4">

                </div>
                <div class="col-md-4" id="buttonRegisterMembership">

                </div>
                <!-- Modal -->
                <div class="modal fade" id="modalRegisterMembership" tabindex="-1" role="dialog"
                     aria-labelledby="modalRegisterMembershipLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalRegisterMembershipLabel">Đăng ký nhân viên</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegisterMore">
                        Đăng ký thêm
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modalRegisterMore" tabindex="-1" role="dialog"
                     aria-labelledby="modalRegisterMoreLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalRegisterMoreLabel">Đăng ký thêm</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('show.register.member.congratulation', $memberRepresent->id)}}"
               class="btn btn-success mt-3 mb-5">Xác nhận</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            if (localStorage.getItem("register_membership")) {
                let html = '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalRegisterMembership">Đăng ký nhân viên</button>';
                $('#buttonRegisterMembership').empty().append(html);
            }
        })
    </script>
@endsection