@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Thêm người dùng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Người dùng</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Người dùng</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Hình ảnh người dùng</label>
                                            <input required type="file" name="image" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>Tên</label>
                                            <input required type="text" name="name" class="form-control" placeholder=" Tên">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input required type="email" name="email" class="form-control"
                                                   placeholder=" Email">
                                        </div>
                                        <div class="form-group">
                                            <label>Mật khẩu</label>
                                            <input required type="password" name="password" class="form-control"
                                                   placeholder="Mật khẩu">
                                        </div>

                                        <label>Vai trò</label>
                                        <select required class="form-control select2" style="width: 100%;" name="rolId">
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->rol_name}}</option>
                                            @endforeach
                                        </select>

                                        <div class="form-group">
                                            <label for="">Trạng thái người dùng</label><br>
                                            <input type="checkbox" name="user_status" checked data-bootstrap-switch>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button id="usersButton" type="button" class="btn btn-primary">Tạo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

@endsection

@section('js')

    <script src="/backend/plugins/select2/js/select2.full.min.js"></script>
    <script src="/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });
    </script>

    <script>

        $("#usersButton").click(function () {

            var url = "{{route("user-add")}}";
            var form = new FormData($("form")[0]);

            $.ajax({
                type: "POST",
                url: url,
                data: form,
                processData: false,
                contentType: false,

                success: function (response) {
                    if (response.status=="success"){
                        toastr.success(response.content, response.title);
                    }
                    else{
                        toastr.error(response.content, response.title);
                    }
                },
                error: function () {

                }
            });
        })
    </script>



@endsection

@section('css')
    <link rel="stylesheet" href="/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
