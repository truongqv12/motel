@extends('backend.layout.index')
@section('page_title','Administration')

@section('custom_css')
    <style>
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản lý Admin
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">administration</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách tài khoản quản trị</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                @foreach($columns as $column)
                                    <th class="bg-primary">{{$column}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @if ($admins)
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>{{$admin->username}}</td>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>
                                            @if(Auth::guard()->user()->edit == 1)
                                                <a href="{{route('administration.edit',['id' => $admin['id']])}}"
                                                   class="btn btn-action label label-success"><i
                                                            class="fa fa-pencil"></i></a>
                                            @endif

                                            @if(Auth::guard()->user()->delete == 1)
                                                <form action="{{ route('administration.destroy', ['id' => $admin['id']]) }}"
                                                      method="post" class="inline">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit"
                                                            onclick="return confirm('Bạn có chắc muốn xóa')"
                                                            class="btn btn-action label label-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection

@section('script')

    <script>
        $(function () {
            $('#data_table').DataTable({
                "ordering": false,
                "order": false
            })
        })
    </script>
@endsection