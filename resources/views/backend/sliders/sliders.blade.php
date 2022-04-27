@extends('backend.app')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Slider</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Slider</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Slider danh sách</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Slider Image</th>
                                <th>Slider Tiêu đề</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td><img width="170" src="{{$slider->slider_image}}" height="100"></td>
                                    <td>{{$slider->slider_name}}</td>
                                    <td>{{$slider->created_at}}</td>
                                    <td>
                                        <a href="{{route('slider-edit',$slider->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                        <button class="btn btn-danger" onclick="deleteSlider(this,'{{$slider->id}}')"><i class="fas fa-trash-alt"></i>&nbsp;Xóa</button>

                                        @if($slider->slider_status == 'on')
                                            <button class="btn btn-success" onclick="sliderStatus(this,'{{$slider->id}}','off')"><i class="fas fa-eye-slash"></i>off</button>
                                        @else
                                            <button class="btn btn-success" onclick="sliderStatus(this,'{{$slider->id}}','on')"><i class="fas fa-eye"></i>on</button>
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

    //slider delete
    <script>
        function deleteSlider(r, id) {
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
                        url: '{{route('sliders')}}',
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

    //slider status
    <script>
        function sliderStatus(r, id, slider_status) {
            $.ajax
            ({
                type: "Post",
                url: '{{route('sliders')}}',
                data: {
                    'id': id,
                    'slider_status': slider_status
                },
                success: function (response) {
                    if (response.status == 'success') {
                        toastr.success(response.content, response.title);
                        setInterval(function(){
                            window.location.reload();
                        },1000);
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
