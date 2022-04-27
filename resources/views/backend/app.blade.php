<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>

    <link rel="icon" href="">
    <link rel="stylesheet" href="/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/backend/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/backend/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/backend/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/backend/plugins/toastr/toastr.min.css">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield("css")
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{\Illuminate\Support\Facades\Auth::user()->avatar}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('index')}}" class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Trang chủ
                            </p>
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('files')}}" class="nav-link {{ request()->is('admin/files') ? 'active' : '' }}">--}}
{{--                            <i class="nav-icon fas fa-folder-open"></i>--}}
{{--                            <p>--}}
{{--                                Quản lý tập tin--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item has-treeview  {{ request()->is('admin/blogs','admin/blogs/blog-add','admin/blogs/blog-edit/*','admin/blogs/blog-category','admin/blogs/blog-category-add','admin/blogs/blog-category-edit/*') ? 'menu-open' : '' }}">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fab fa-blogger-b"></i>
                            <p>
                                Sản phẩm
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('blogs')}}" class="nav-link {{ request()->is('admin/blogs') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Danh sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('blog-add')}}" class="nav-link {{ request()->is('admin/blogs/blog-add') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm vào</p>
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('blog-category')}}" class="nav-link {{ request()->is('admin/blogs/blog-category') ? 'active' : '' }}">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Thể loại</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('blog-category-add')}}" class="nav-link {{ request()->is('admin/blogs/blog-category-add') ? 'active' : '' }}">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Them Thể loại</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{\Illuminate\Support\Facades\Auth::user()->rolId == 1 ? ' ' : 'd-none'}} {{ request()->is('admin/question','admin/question/add','admin/question/edit/*') ? 'menu-open' : '' }}">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-pager"></i>
                            <p>
                                Question
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('question')}}" class="nav-link {{ request()->is('admin/question') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Question danh sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('question-add')}}" class="nav-link {{ request()->is('admin/question/add') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tạo</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{\Illuminate\Support\Facades\Auth::user()->rolId == 1 ? ' ' : 'd-none'}} {{ request()->is('admin/information','admin/information/add','admin/information/edit/*') ? 'menu-open' : '' }}">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Information
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('information')}}" class="nav-link {{ request()->is('admin/information') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Information danh sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('information-add')}}" class="nav-link {{ request()->is('admin/information/add') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tạo</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{\Illuminate\Support\Facades\Auth::user()->rolId == 1 ? ' ' : 'd-none'}} {{ request()->is('admin/rate','admin/rate/add','admin/rate/edit/*') ? 'menu-open' : '' }}">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-compass"></i>
                            <p>
                                Rate
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('rate')}}" class="nav-link {{ request()->is('admin/rate') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rate danh sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('rate-add')}}" class="nav-link {{ request()->is('admin/rate/add') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tạo</p>
                                </a>
                            </li>
                        </ul>
                    </li>
{{--                    <li class="nav-item has-treeview {{\Illuminate\Support\Facades\Auth::user()->rolId == 1 ? ' ' : 'd-none'}} {{ request()->is('admin/pages','admin/pages/page-add','admin/pages/page-edit/*') ? 'menu-open' : '' }}">--}}
{{--                        <a href="#" class="nav-link ">--}}
{{--                            <i class="nav-icon fas fa-pager"></i>--}}
{{--                            <p>--}}
{{--                                Page--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('pages')}}" class="nav-link {{ request()->is('admin/pages') ? 'active' : '' }}">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Các trang</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('page-add')}}" class="nav-link {{ request()->is('admin/pages/page-add') ? 'active' : '' }}">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Thêm trang</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    <li class="nav-item has-treeview {{\Illuminate\Support\Facades\Auth::user()->rolId == 1 ? ' ' : 'd-none'}} {{ request()->is('admin/sliders','admin/sliders/slider-add','admin/sliders/slider-edit/*') ? 'menu-open' : '' }}">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-images"></i>
                            <p>
                                Slider
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('sliders')}}" class="nav-link {{ request()->is('admin/sliders') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Slider danh sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('slider-add')}}" class="nav-link {{ request()->is('admin/sliders/slider-add') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tạo</p>
                                </a>
                            </li>
                        </ul>
                    </li>

{{--                    <li class="nav-item has-treeview {{\Illuminate\Support\Facades\Auth::user()->rolId == 1 ? ' ' : 'd-none'}} {{ request()->is('admin/menus','admin/menus/menu-add','admin/menus/menu-edit/*') ? 'menu-open' : '' }}">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-compass"></i>--}}
{{--                            <p>--}}
{{--                                Menu--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('menus')}}" class="nav-link {{ request()->is('admin/menus') ? 'active' : '' }}">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Danh sách</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('menu-add')}}" class="nav-link {{ request()->is('admin/menus/menu-add') ? 'active' : '' }}">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Thêm </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item has-treeview {{\Illuminate\Support\Facades\Auth::user()->rolId == 1 ? ' ' : 'd-none'}} {{ request()->is('admin/users','admin/users/user-add','admin/users/user-edit/*') ? 'menu-open' : '' }}">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-users"></i>--}}
{{--                            <p>--}}
{{--                                Người dùng--}}
{{--                                <i class="fas fa-angle-left right"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('users')}}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Danh sách người dùng</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('user-add')}}" class="nav-link {{ request()->is('admin/users/user-add') ? 'active' : '' }}">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Tạo người dùng</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{\Illuminate\Support\Facades\Auth::user()->rolId == 1 ? ' ' : 'd-none'}}">--}}
{{--                        <a href="{{route('settings')}}" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">--}}
{{--                            <i class="nav-icon fas fa-cogs"></i>--}}
{{--                            <p>--}}
{{--                                Cài đặt Trang web--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item">
                        <a href="{{route('backend-logout')}}" class="nav-link ">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Đăng xuất
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    @yield("content")

    <aside class="control-sidebar control-sidebar-dark">
    </aside>

    <footer class="main-footer">
        <strong>Copyright &copy; 2020 <a href="http://karabayyazilim.com"></a>.</strong>
        All rights reserved.
    </footer>
</div>

<script src="/backend/plugins/jquery/jquery.min.js"></script>
<script src="/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script src="/backend/dist/js/adminlte.js"></script>
<script src="/backend/dist/js/demo.js"></script>
<script src="/backend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/backend/plugins/raphael/raphael.min.js"></script>
<script src="/backend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/backend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<script src="/backend/plugins/chart.js/Chart.min.js"></script>
<script src="/backend/dist/js/pages/dashboard2.js"></script>
<script src="/backend/plugins/toastr/toastr.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>

<script src="/backend/plugins/datatables/jquery.dataTables.js"></script>
<script src="/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
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



@yield("js")
</body>
</html>
