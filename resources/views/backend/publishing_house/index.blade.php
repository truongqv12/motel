@extends('backend.layout.index')
@section('page_title','Administration')

@section('custom_css')
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản lý tác giả
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tác giả</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách nhà xuất bản</h3>
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
                            @foreach($pubs as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->product()->count()}}</td>
                                    <td>
                                        @if($item->active == 1)
                                            <label class="label label-success">Active</label>
                                        @else
                                            <label class="label label-danger">Đợi duyệt</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::guard('admin')->user()->edit == 1)
                                            <a href="{{route('publishing_house.edit',['id' => $item->id])}}"
                                               class="btn btn-action label label-success">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        @endif

                                        @if(Auth::guard('admin')->user()->delete == 1 && $item->product()->count() == 0)
                                            <form action="{{ route('publishing_house.destroy', ['id' => $item->id]) }}"
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
                "ordering": false
            })
        })
    </script>
@endsection