@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Question</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Question</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">danh sách</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Kết quả</th>
                                {{--                                <th>Mô tả ngắn</th>--}}
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs  as $blog)
                                <tr>
                                    <td>{{$blog->title}}</td>
                                    {{--                                    <td>{{$blog->blog_content}}</td>--}}
                                    <td>{{$blog->value}}</td>
                                    <td>
                                        <a href="{{route('information-edit',$blog->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                        <button class="btn btn-danger" onclick="deleteBlogs(this,'{{$blog->id}}')"><i class="fas fa-trash-alt"></i>&nbsp;Xóa</button>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
    </div>

@endsection

@section('js')

    <script src="/js/sweetalert2.js"></script>
    <script src="/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>

    //blog delete
    <script>
        function deleteBlogs(r, id) {
            var list = r.parentNode.parentNode.rowIndex;
            swal({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: "Sau khi bạn xóa nó, nó sẽ không được tái chế!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Hủy bỏ',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, Xóa!'
            }).then((result) => {
                if (result.value) {
                    $.ajax
                    ({
                        type: "Post",
                        url: '{{route('information')}}',
                        data: {
                            'id': id,
                            'delete': 'delete'
                        },
                        beforeSubmit: function () {
                            swal({
                                title: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i> <span class="sr-only">Loading...</span>',
                                text: 'Đang xóa, vui lòng đợi...',
                                showConfirmButton: false
                            })
                        },
                        success: function (response) {
                            if (response.status == 'success') {
                                document.getElementById('example1').deleteRow(list);
                                toastr.success(response.content, response.title);
                            } else {
                                toastr.error(response.content, response.title);
                            }
                        }

                    })
                } else {
                }
            })
        }
    </script>

    //blog status
    <script>

    </script>

@endsection

@section('css')

@endsection
