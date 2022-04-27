@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Chỉnh sửa </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Information</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <form method="post">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tiêu đề</label>
                                        <input type="text" name="title"  value="{{$blog->title}}" class="form-control" placeholder="Tiêu đề">
                                    </div>
                                    <div class="form-group" >
                                        <label for="exampleInputEmail1">Mô tả ngắn gọn</label>
                                        <input type="text" name="value"  value="{{$blog->value}}" class="form-control" placeholder="Mô tả ngắn gọn">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button id="blogsButton" type="button" class="btn btn-primary">Tạo</button>
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
    <script src="/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script>

        $("#blogsButton").click(function () {
            var url = "{{route("information-edit",$blog->id)}}";
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
