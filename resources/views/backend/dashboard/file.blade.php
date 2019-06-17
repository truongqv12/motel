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
            Quản lý file
        </h1>

        <!-- breadcrumb start -->
        <ol class="breadcrumb">
            <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Quản lý file</li>
        </ol>

        <!-- breadcrumb end -->
    </section>

    <!-- Main content -->
    <section class="content">
        <iframe style="width: 100%; height: 80vh;" src="/admin/laravel-filemanager"></iframe>
    </section>
    <!-- /.content -->
@endsection