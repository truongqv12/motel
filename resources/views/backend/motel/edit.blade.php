@extends('backend.layout.index')
@section('page_title','Sửa')
@section('link_css')
    <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('products.index')}}">Sản phẩm</a></li>
            <li class="active">edit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('products.update',['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT')}}
            <input type="hidden" value="{{$product->id}}" name="id">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Sửa sản phẩm</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thông tin sản phẩm</label>
                                <select class="form-control select2" style="width: 100%;" name="category_id">
                                    <option value="0">Danh mục</option>
                                    @php multiple_lever_category($categories,0,'',$product->category_id) @endphp;
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="name"
                                           id="name" value="{{ $product->name }}">
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
                                           value="{{ $product->slug }}">
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
                                           value="{{ $product->price }}">
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
                                           value="{{ $product->discount_price }}">
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
                                           value="{{ $product->quantity }}">
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
                                        <option value="{{$author->id}}" {{($product->author_id == $author->id) ? 'selected' : ''}}>{{$author->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhà xuất bản</label>
                                <select class="form-control select2" style="width: 100%;" name="publishing_house_id">
                                    @foreach($pubs as $pub)
                                        <option value="{{$pub->id}}" {{($product->publishing_house_id == $pub->id) ? 'selected' : ''}}>{{$pub->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <div class="show-avatar show-product-img">
                                    <img src="{{(preg_match('/http/', $product->image)) ? $product->image : asset('storage/uploads/product/' . $product->image) }}"
                                         alt="" id="img">
                                    <input type="file" name="upload_product" id="upload_img" style="display: none">
                                    <a id="browse_file" class="btn btn-success">
                                        <i class="fa fa-file-image-o"></i>
                                        Chọn ảnh
                                    </a>
                                </div>
                            </div>
                            @if($errors->has('upload_product'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('upload_product') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Hot</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio"
                                               name="hot" value="0" {{ ($product->hot == 0) ? 'checked' : '' }}>
                                        <span class="label label-violet">Không</span>
                                    </label>
                                    <label>
                                        <input type="radio"
                                               name="hot" value="1" {{ ($product->hot == 1) ? 'checked' : '' }}>
                                        <span class="label label-danger">Hot</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio"
                                               name="active" value="0" {{ ($product->active == 0) ? 'checked' : '' }}>
                                        <span class="label label-warning">Ban</span>
                                    </label>
                                    <label>
                                        <input type="radio"
                                               name="active" value="1" {{ ($product->active == 1) ? 'checked' : '' }}>
                                        <span class="label label-success">Active</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="center-block max-width-content">
                        <a href="{{route('products.index')}}" class="btn btn-lg btn-primary"
                           style="margin-right: 10px">Back</a>
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