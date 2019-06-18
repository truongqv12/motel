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
            Bài viết
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Bài viết</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách bài viết</h3>
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
                            @foreach($posts as $key => $item)
                                <tr>
                                    <td>{{$item->pos_id}}</td>
                                    <td>{{$item->category['cat_name']}}</td>
                                    <td>
                                        <img src="{{(preg_match('/http/', $item->pos_image)) ? $item->pos_image : asset('/upload/photos/' . $item->pos_image) }}"
                                             alt="" style="width: 60px; height: 90px"
                                             title="{{$item->pos_title}}">
                                    </td>
                                    <td style="font-weight: 600">{{$item->pos_title}}</td>
                                    <td><a href="{{ route('news.detail', ['rewrite' => $item->pos_rewrite]) }}">link</a>
                                    </td>
                                    <td>{{$item->pos_teaser}}</td>
                                    <td>
                                        @if($item->pos_active == 1)
                                            <label class="label label-success">Active</label>
                                        @else
                                            <label class="label label-warning">Đợi duyệt</label>
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->created_at}}
                                    </td>
                                    <td>
                                        {{$item->updated_at}}
                                    </td>
                                    <td>
                                        @if(Auth::guard('admin')->user()->edit == 1)
                                            <a href="{{route('posts.edit',['id' => $item->pos_id])}}"
                                               class="btn btn-action label label-success">
                                                <i class="fa fa-pencil"></i></a>
                                        @endif

                                        @if(Auth::guard('admin')->user()->delete == 1)
                                            <form action="{{ route('posts.destroy', ['id' => $item->pos_id]) }}"
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
                "order": false,
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi mỗi trang",
                    "zeroRecords": "Không tìm thấy sản phẩm nào",
                    "info": "Trang _PAGE_ trên _PAGES_",
                    "infoEmpty": "Không có bản ghi nào",
                    "infoFiltered": "(Tìm thấy _TOTAL_ trong _MAX_ sản phẩm)"
                }
            })
        });
    </script>
@endsection