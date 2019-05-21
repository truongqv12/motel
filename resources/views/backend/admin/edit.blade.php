@extends('backend.layout.index')
@section('page_title','Sửa')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa tài khoản quản trị
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('administration.index')}}">administration</a></li>
            <li class="active">edit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('administration.update',['id' => $admin['id']]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT')}}
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Sửa tài khoản</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thông tin tài khoản</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Nhập họ và tên" name="name"
                                           id="name" value="{{ $admin['name'] }}">
                                </div>
                            </div>
                            @if($errors->has('name'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('name') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Nhập email" name="email"
                                           id="email" value="{{ $admin['email'] }}">
                                </div>
                            </div>
                            @if($errors->has('email'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('email') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Tên đăng nhập" name="loginname"
                                           value="{{ $admin['loginname'] }}" readonly>
                                </div>
                            </div>
                            @if($errors->has('loginname'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('loginname') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <!-- Minimal style -->
                            <div class="form-group">
                                <label>Quyền</label>
                                <table class="table table-bordered table-responsive text-center">
                                    <thead>
                                    <tr>
                                        <th class="bg-primary">Thêm</th>
                                        <th class="bg-primary">Sửa</th>
                                        <th class="bg-primary">Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" id=""
                                                           name="add" {{ ($admin['add'] == 1) ? 'checked' : '' }}>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" id=""
                                                           name="edit" {{ ($admin['edit'] == 1) ? 'checked' : '' }}>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" id=""
                                                           name="delete" {{ ($admin['delete'] == 1) ? 'checked' : '' }}>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="center-block max-width-content">
                        <a href="{{route('administration.index')}}" class="btn btn-lg btn-primary"
                           style="margin-right: 10px">Quay lại</a>
                        <button type="submit" class="btn btn-lg btn-warning">Sửa <i class="fa fa-pencil-square-o"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('script')

@endsection