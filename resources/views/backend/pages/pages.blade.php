@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Các trang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Trang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách trang</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Tiêu đề trang</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{$page->page_name}}</td>
                                    <td>{{$page->created_at}}</td>
                                    <td>
                                        <a href="{{route('page-edit',$page->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Chỉnh sửa</a>

                                        <button class="btn btn-danger" onclick="deletePages(this,'{{$page->id}}','{{$page->page_image}}')"><i class="fas fa-trash-alt"></i>&nbsp;Xóa
                                        </button>

                                        @if($page->page_status == 'on')
                                            <button class="btn btn-success" onclick="pageStatus(this,'{{$page->id}}','off')"><i class="fas fa-eye-slash"></i>off</button>
                                        @else
                                            <button class="btn btn-success" onclick="pageStatus(this,'{{$page->id}}','on')"><i class="fas fa-eye"></i>on</button>
                                        @endif

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

    //page delete
    <script>
        function deletePages(r, id, page_image) {
            var list = r.parentNode.parentNode.rowIndex;
            swal({
                title: 'Silmek istediğinize emin misiniz?',
                text: "Sildiğinizde geri dönüşümü olmayacaktır!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'İptal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, Sil!'
            }).then((result) => {
                if (result.value) {
                    $.ajax
                    ({
                        type: "Post",
                        url: '{{route('pages')}}',
                        data: {
                            'id': id,
                            'page_image': page_image,
                            'delete': 'delete'
                        },
                        beforeSubmit: function () {
                            swal({
                                title: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i> <span class="sr-only">Loading...</span>',
                                text: 'Siliniyor lütfen bekleyiniz...',
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

    //page status
    <script>
        function pageStatus(r, id, page_status) {
            $.ajax
            ({
                type: "Post",
                url: '{{route('pages')}}',
                data: {
                    'id': id,
                    'page_status': page_status
                },
                success: function (response) {
                    if (response.status == 'success') {
                        toastr.success(response.content, response.title);
                        setInterval(function(){
                            window.location.reload();
                        },5000);
                    } else {
                        toastr.error(response.content, response.title);
                        setInterval(function(){
                            window.location.reload();
                        },5000);
                    }
                }

            })

        }
    </script>

@endsection

@section('css')

@endsection
