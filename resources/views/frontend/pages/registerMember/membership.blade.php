@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <div class="container-fluid">
        <h3 class="text-center">Đăng kí nhân viên</h3>
        <div class="mt-3">
            <h5>
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
                @if($memberRepresent)
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
                @endif
                @if($memberSource)
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
                @endif
                </tbody>
            </table>
            <div class=" mt-3 ml-1">
                <div class="">

                </div>
                <div id="buttonRegisterMembership">

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
                            <form>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Password</label>
                                            <input type="password" class="form-control" id="inputPassword4">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Address</label>
                                        <input type="text" class="form-control" id="inputAddress"
                                               placeholder="1234 Main St">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress2">Address 2</label>
                                        <input type="text" class="form-control" id="inputAddress2"
                                               placeholder="Apartment, studio, or floor">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputCity">City</label>
                                            <input type="text" class="form-control" id="inputCity">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">State</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputZip">Zip</label>
                                            <input type="text" class="form-control" id="inputZip">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="">
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
                            <form>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Password</label>
                                            <input type="password" class="form-control" id="inputPassword4">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Address</label>
                                        <input type="text" class="form-control" id="inputAddress"
                                               placeholder="1234 Main St">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress2">Address 2</label>
                                        <input type="text" class="form-control" id="inputAddress2"
                                               placeholder="Apartment, studio, or floor">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputCity">City</label>
                                            <input type="text" class="form-control" id="inputCity">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">State</label>
                                            <select id="inputState" class="form-control">
                                                <option selected>Choose...</option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputZip">Zip</label>
                                            <input type="text" class="form-control" id="inputZip">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
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