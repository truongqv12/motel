<!--/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 8/7/2018
 * Time: 9:19 AM
 */-->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('backend/images/avatar04.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::guard('admin')->user()->fullname}}</p>
                <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree" data-animation-speed="300">
            <li class="active">
                <a href="{{route('admin')}}"><i class="fa fa-dashboard"></i><span>Thống kê</span></a>
            </li>
            <li class="treeview">
                <a href="javascript:void(0)"><i class="fa fa-newspaper-o"></i><span>Bài viết</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('category.index').'?type=POST'}}">
                            <i class="fa fa-caret-right"></i> Danh mục</a></li>
                    <li><a href="{{route('category.create').'?type=POST'}}">
                            <i class="fa fa-caret-right"></i> Thêm mới danh mục</a></li>
                    <li><a href="{{route('posts.index')}}"><i class="fa fa-caret-right"></i> Danh sách</a></li>
                    <li><a href="{{route('posts.create')}}"><i class="fa fa-caret-right"></i> Thêm mới</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="javascript:void(0)"><i class="fa fa-home"></i><span>Phòng Trọ</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('category.index').'?type=MOTEL'}}">
                            <i class="fa fa-caret-right"></i> Danh mục</a></li>
                    <li><a href="{{route('category.create').'?type=MOTEL'}}">
                            <i class="fa fa-caret-right"></i> Thêm mới danh mục</a></li>
                    <li><a href="{{route('motelroom.index')}}"><i class="fa fa-caret-right"></i> Danh sách</a></li>
                    <li><a href="{{ route('motelroom.report') }}"><i class="fa fa-caret-right"></i> Báo cáo nội dung</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="javascript:void(0)"><i class="fa fa-cogs"></i><span>Cài đặt</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('setting.index') }}"><i class="fa fa-caret-right"></i> Danh sách</a></li>
                    <li><a href="{{ route('setting.create') }}"><i class="fa fa-caret-right"></i> Thêm mới</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="javascript:void(0)"><i class="fa fa-users"></i><span>Tài khoản khách hàng</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('users.index')}}"><i class="fa fa-caret-right"></i> Danh sách</a></li>
                    <li><a href="{{route('users.create')}}"><i class="fa fa-caret-right"></i> Thêm mới</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="javascript:void(0)"><i class="fa fa-user"></i><span>Tài khoản quản trị</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('administration.index')}}"><i class="fa fa-caret-right"></i> Danh sách</a></li>
                    <li><a href="{{route('administration.create')}}"><i class="fa fa-caret-right"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="{{route('admin.file')}}"><i class="fa fa-folder"></i><span>File Manager</span></a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>