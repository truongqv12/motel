<!--
 * Created by PhpStorm.
 * User: Truong
 * Date: 8/7/2018
 * Time: 9:22 AM
 */ -->
@extends('backend.layout.index')
@section('page_title','Dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thống kê
            <small>Trang quản lý</small>
        </h1>

        <!-- breadcrumb start -->
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>

        <!-- breadcrumb end -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="callout callout-danger">
            <h4>Chào mừng đến với trang quản trị</h4>

            <p>Mọi thông tin đều được thống kê tại đây</p>
            </div>
        <!-- Default box -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $motels_active }}</h3>

                        <p>Phòng trọ đã duyệt</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-home"></i>
                    </div>
                    <a href="{{route('motelroom.index').'?status=1'}}" class="small-box-footer">Danh sách <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $users }}</h3>

                        <p>Người dùng đã đăng ký</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                    <a href="{{ route('users.index') }}" class="small-box-footer">Danh sách <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $reports }}</h3>

                        <p>Báo cáo nội dung</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-list"></i>
                    </div>
                    <a href="{{ route('motelroom.report') }}" class="small-box-footer">Danh sách <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $motels_hide }}</h3>

                        <p>Phòng trọ đang chờ duyệt</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-home-outline"></i>
                    </div>
                    <a href="{{route('motelroom.index').'?status=0'}}" class="small-box-footer">Danh sách <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection