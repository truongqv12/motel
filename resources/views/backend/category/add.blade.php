@extends('backend.layout.index')
@section('page_title','Thêm mới')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mới danh mục
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('category.index')}}">Danh mục</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{route('category.store')}}" method="POST" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" hidden name="cat_type" value="{{(Request::input('type'))}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Thông tin cơ bản</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                <select class="form-control select2" style="width: 100%;" name="cat_parent_id" title="">
                                    <option value="0" selected="selected">Danh mục cha</option>
                                    @if ($categories)
                                        @foreach($categories as $item)
                                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach;
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập tên danh mục</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Nhập tên danh mục" id="name"
                                           name="cat_name" value="{{ old('cat_name') }}">
                                </div>
                            </div>
                            @if($errors->has('cat_name'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('cat_name') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" readonly class="form-control" placeholder="Rewrite" id="slug"
                                           name="cat_rewrite" value="{{ old('cat_rewrite') }}">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="center-block max-width-content">
                                <button type="submit" class="btn btn-primary">Tạo mới</button>
                                <button type="reset" class="btn btn-warning ">Làm lại</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Thông tin thêm</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="cat_active" value="0">
                                        <span class="label label-danger">Ban</span>
                                    </label>
                                    <label>
                                        <input checked type="radio" name="cat_active" value="1">
                                        <span class="label label-success">Active</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">SEO title :</label>
                                <input class="form-control" type="text" title="SEO title" id="cat_seo_title"
                                       name="cat_seo_title" value="{{ old('cat_seo_title') }}" maxlength="255">
                            </div>
                            <div class="form-group">
                                <label for="">SEO keywords :</label>
                                <input class="form-control" type="text" title="Mô tả" id="cat_seo_keyword"
                                       name="cat_seo_keyword" value="{{ old('cat_seo_keyword') }}" maxlength="255">
                            </div>
                            <div class="form-group">
                                <label for="">SEO description :</label>
                                <textarea class="form-control" placeholder="Mô tả" id="cat_seo_description"
                                          name="cat_seo_description"
                                          style="resize: none; height:100px">{{ old('cat_seo_description') }}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('script')
@endsection