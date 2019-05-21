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
            Quản lý sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sản phẩm</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách sản phẩm</h3>
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
                            @foreach($products as $key => $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td class="text-uppercase">{{$item->name}}</td>
                                    <td>{{format_money($item->price)}}</td>
                                    <td>{{format_money($item->discount_price)}}</td>
                                    <td>
                                        <img src="{{(preg_match('/http/', $item->image)) ? $item->image : asset('storage/uploads/product/' . $item->image) }}"
                                             alt="" style="width: 60px; height: 90px"
                                             title="{{$item->name}}">
                                    </td>
                                    <td>{{$item->quantity}}</td>
                                    <td>
                                        @if($item->hot == 1)
                                            <label class="label label-danger">Hot</label>
                                        @endif
                                    </td>
                                    <td>{{$item->category->name}}</td>
                                    <td>{{$item->author->name}}</td>
                                    <td>
                                        @if($item->active == 1)
                                            <label class="label label-success">Active</label>
                                        @else
                                            <label class="label label-warning">Đợi duyệt</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::guard('admin')->user()->edit == 1)
                                            <a href="{{route('products.edit',['id' => $item->id])}}"
                                               class="btn btn-action label label-success"><i
                                                        class="fa fa-pencil"></i></a>
                                        @endif

                                        @if(Auth::guard('admin')->user()->delete == 1)
                                            <form action="{{ route('products.destroy', ['id' => $item->id]) }}"
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
                "orderMulti": false,
                "order": [[ 0, 'desc' ], [ 1, 'false' ]],
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
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