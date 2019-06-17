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
            Danh sách báo cáo từ người dùng
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Báo cáo</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách phòng trọ bị báo cáo</h3>
                    </div>

                    <div class="box-body">
                        <!-- /.box-header -->
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                @foreach($columns as $column)
                                    <th class="bg-primary text-center">{{$column}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @if($motels->isNotEmpty())
                                @foreach($motels as $key => $item)
                                    <tr>
                                        <td class="text-center">{{$item->id}}</td>
                                        <td style="width: 500px">
                                            <a href="{{ route('motel.detail', ['cat_id' => $item->category_id, 'rewrite' => $item->slug]) }}"
                                               target="_blank">{{$item->title}}</a>
                                        </td>
                                        <td class="text-center">{{$item->total_report}}</td>
                                        <td class="text-center">
                                            @if($item->status == 1)
                                                <label class="label label-success">Đã phê duyệt</label>
                                            @else
                                                <label class="label label-warning">Chờ phê duyệt</label>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(Auth::guard('admin')->user()->edit == 1)
                                                <div class="btn-group">
                                                    <button type="button"
                                                            class="btn btn-action label label-success dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="{{route('motelroom.active',['id'=>$item->id])}}">
                                                                <i class="fa fa-check-square-o"></i>Phê duyệt</a>
                                                        </li>
                                                        <li><a href="{{route('motelroom.unactive',['id'=>$item->id])}}"><i
                                                                        class="fa fa-eye-slash"></i>Tạm ẩn</a></li>
                                                    </ul>
                                                </div>
                                            @endif

                                            @if(Auth::guard('admin')->user()->delete == 1)
                                                <form action="{{ route('motelroom.destroy', ['id' => $item->id]) }}"
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
                            @else
                                <tr class="text-center">
                                    <td colspan="{{count($columns)}}">Không tìm thấy kết quả nào</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{$motels->appends(Request::only('status'))->appends(Request::only('title'))->links()}}
                        </div>

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
    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#data_table').DataTable({--}}
    {{--"ordering": false,--}}
    {{--"order": false,--}}
    {{--"columnDefs": [--}}
    {{--{ width: 400, targets: 1 }--}}
    {{--],--}}
    {{--"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],--}}
    {{--"language": {--}}
    {{--"lengthMenu": "Hiển thị _MENU_ bản ghi mỗi trang",--}}
    {{--"zeroRecords": "Không tìm thấy sản phẩm nào",--}}
    {{--"info": "Trang _PAGE_ trên _PAGES_",--}}
    {{--"infoEmpty": "Không có bản ghi nào",--}}
    {{--"infoFiltered": "(Tìm thấy _TOTAL_ trong _MAX_ sản phẩm)"--}}
    {{--}--}}
    {{--})--}}
    {{--});--}}
    {{--</script>--}}
@endsection