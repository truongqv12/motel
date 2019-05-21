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
            Quản lý banner
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">banner</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách banner</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                @foreach($columns as $column)
                                    <th>{{$column}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($banners as $ban)
                                <tr>
                                    <td>{{$ban->id}}</td>
                                    <td>{{$ban->title}}</td>
                                    <td>{{$ban->slug}}</td>
                                    <td><img src="{{(preg_match('/http/', $ban->image)) ? $ban->image : asset('storage/uploads/user/' . $ban->image) }}" alt=""
                                             style="width: 300px; height: 100px"
                                             title="{{$ban->title}}"></td>
                                    <td>{{$ban->link}}</td>
                                    <td>
                                        @if($ban->active == 1)
                                            <label class="label label-success">Activated</label>
                                        @else
                                            <label class="label label-danger">Đợi duyệt</label>
                                        @endif
                                    </td>

                                    <td>
                                        @if(Auth::guard('admin')->user()->edit == 1)
                                            <a href="{{route('banner.edit',['id' => $ban->id])}}"
                                               class="btn btn-action label label-success"><i
                                                        class="fa fa-pencil"></i></a>
                                        @endif

                                        @if(Auth::guard('admin')->user()->delete == 1)
                                            <form action="{{ route('banner.destroy', ['id' => $ban->id]) }}"
                                                  method="post" class="inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa')"
                                                        class="btn btn-action label label-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                @foreach($columns as $column)
                                    <th>{{$column}}</th>
                                @endforeach
                            </tr>
                            </tfoot>
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
                "order": [[0, "desc"]]
            })
        })
    </script>
@endsection