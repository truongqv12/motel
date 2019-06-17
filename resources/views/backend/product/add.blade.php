@extends('backend.layout.index')
@section('page_title','Thêm mới')
@section('link_css')
    <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mới danh mục
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('motelroom.index')}}">Phòng trọ</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{route('motelroom.store')}}" method="POST" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Thêm mới</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thông tin phòng trọ</label>
                                <select class="form-control select2" style="width: 100%;" name="category_id">
                                    <option value="">|--- Chọn danh mục ---|</option>
                                    @php multiple_lever_category($categories) @endphp;
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Nhập tiêu đề" name="name"
                                           id="name" value="{{ old('name') }}">
                                </div>
                            </div>
                            @if($errors->has('name'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('name') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" readonly class="form-control" placeholder="Slug" name="slug"
                                           id="slug"
                                           value="{{ old('slug') }}">
                                </div>
                            </div>
                            @if($errors->has('slug'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('slug') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" class="form-control" placeholder="Giá sản phẩm" name="price"
                                           value="{{ old('price') }}">
                                </div>
                            </div>
                            @if($errors->has('price'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('price') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" class="form-control" placeholder="Giá khuyến mãi"
                                           name="discount_price"
                                           value="{{ (empty(old('discount_price'))) ? 0 : old('discount_price') }}">
                                </div>
                            </div>
                            @if($errors->has('discount_price'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('discount_price') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" class="form-control" placeholder="Số sản phẩm hiện có"
                                           name="quantity"
                                           value="{{ (empty(old('quantity'))) ? 0 : old('quantity')  }}">
                                </div>
                            </div>
                            @if($errors->has('quantity'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('quantity') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Tác giả</label>
                                <select class="form-control select2" style="width: 100%;" name="author_id">
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}">{{$author->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhà xuất bản</label>
                                <select class="form-control select2" style="width: 100%;" name="publishing_house_id">
                                    @foreach($pubs as $pub)
                                        <option value="{{$pub->id}}">{{$pub->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <div class="show-avatar show-product-img">
                                    <img src="" alt="" id="img">
                                    <input type="file" name="upload_product" id="upload_img" style="display: none">
                                    <a id="browse_file" class="btn btn-success"><i class="fa fa-file-image-o"></i> Chọn
                                        ảnh</a>
                                </div>
                            </div>
                            @if($errors->has('upload_product'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('upload_product') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="active" value="0">
                                        <span class="label label-warning">Ban</span>
                                    </label>
                                    <label>
                                        <input checked type="radio" name="active" value="1">
                                        <span class="label label-success">Active</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hot</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="hot" value="0">
                                        <span class="label label-violet">Không</span>
                                    </label>
                                    <label>
                                        <input checked type="radio" name="hot" value="1">
                                        <span class="label label-danger">Hot</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="center-block max-width-content">
                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                        <button type="reset" class="btn btn-warning ">Làm lại</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <!-- Select2 -->
    <script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        })
    </script>
@endsection