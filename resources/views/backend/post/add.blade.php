@extends('backend.layout.index')
@section('page_title','Thêm mới')
@section('link_css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tạo bài viết
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('products.index')}}">Bài viết</a></li>
            <li class="active">add</li>
        </ol>
    </section>

    <section class="content">

        <form action="{{route('category.store')}}" method="POST" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Thông tin cơ bản</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control select2" name="pos_category_id" title="">
                                    @if ($categories)
                                        @foreach($categories as $item)
                                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach;
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>* Tiêu đề</label>
                                <input type="text" class="form-control" placeholder="Nhập tên danh mục" id="name"
                                       name="pos_title" value="{{ old('pos_title') }}">
                            </div>
                            @if($errors->has('pos_title'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('pos_title') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Mô tả ngắn</label>
                                <textarea type="text" class="form-control" name="pos_teaser"
                                          style="resize: none; height:100px">
                                    {{ old('pos_teaser') }} </textarea>
                            </div>
                            @if($errors->has('pos_teaser'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('pos_teaser') !!}
                                </div>
                            @endif
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
                                <label>Ảnh đại diện</label>
                                <input type="file" class="form-control"
                                       name="post_image" value="{{ old('pos_teaser') }}">
                            </div>
                            <div class="form-group">
                                <label for="">SEO title :</label>
                                <input class="form-control" type="text" id="pos_seo_title"
                                       name="pos_seo_title" value="{{ old('pos_seo_title') }}" maxlength="255">
                            </div>
                            <div class="form-group">
                                <label for="">SEO keywords :</label>
                                <input class="form-control" type="text" id="pos_seo_keyword"
                                       name="pos_seo_keyword" value="{{ old('pos_seo_keyword') }}" maxlength="255">
                            </div>
                            <div class="form-group">
                                <label for="">SEO description :</label>
                                <textarea class="form-control" id="pos_seo_description"
                                          name="pos_seo_description"
                                          style="resize: none; height:100px">{{ old('pos_seo_description') }}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Nội dung :</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <textarea class="form-control" id="pos_content" style="height:100px"
                                          name="pos_content">{{ old('pos_content') }}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Tạo mới</button>
                    <button type="reset" class="btn btn-warning ">Làm lại</button>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('script')
    <script>
        CKEDITOR.replace('pos_content');
    </script>
@endsection