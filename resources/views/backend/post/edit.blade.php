@extends('backend.layout.index')
@section('page_title','Sửa')
@section('link_css')
    <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa bài viết
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('posts.index')}}">Bài viết</a></li>
            <li class="active">edit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('posts.update',['id' => $post->pos_id]) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT')}}
            <input type="hidden" value="{{$post->pos_id}}" name="pos_id">

            <div class="box-body">
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
                                                <option value="{{$item['id']}}" {{ ($post->pos_category_id == $item['id']) ? 'selected' : '' }}>{{$item['name']}}</option>
                                            @endforeach;
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>* Tiêu đề</label>
                                    <input type="text" class="form-control" placeholder="Nhập tiêu đề bài viết"
                                           id="name" name="pos_title" value="{{ $post->pos_title }}">
                                </div>
                                @if($errors->has('pos_title'))
                                    <div class="help-block text-red">
                                        * {!! $errors->first('pos_title') !!}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <textarea type="text" class="form-control" name="pos_teaser"
                                              style="resize: none; height:100px">{{ $post->pos_teaser }} </textarea>
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
                                            <input type="radio" name="pos_active" value="0">
                                            <span class="label label-danger">Hide</span>
                                        </label>
                                        <label>
                                            <input checked type="radio" name="pos_active" value="1">
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
                                    <input type="file" class="form-control" name="upload_image">
                                    @if($errors->has('upload_image'))
                                        <div class="help-block text-red">
                                            * {!! $errors->first('upload_image') !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">SEO title :</label>
                                    <input class="form-control" type="text" id="pos_seo_title"
                                           name="pos_seo_title" value="{{ $post->pos_seo_title }}" maxlength="255">
                                </div>
                                <div class="form-group">
                                    <label for="">SEO keywords :</label>
                                    <input class="form-control" type="text" id="pos_seo_keyword"
                                           name="pos_seo_keyword" value="{{ $post->pos_seo_keyword }}" maxlength="255">
                                </div>
                                <div class="form-group">
                                    <label for="">SEO description :</label>
                                    <textarea class="form-control" id="pos_seo_description"
                                              name="pos_seo_description"
                                              style="resize: none; height:100px">{{ $post->pos_seo_description }}</textarea>
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
                                @if($errors->has('pos_content'))
                                    <div class="help-block text-red">
                                        * {!! $errors->first('pos_content') !!}
                                    </div>
                                @endif
                                <div class="form-group">
                                <textarea class="form-control" id="pos_content" style="height:100px"
                                          name="pos_content">{{ $post->pos_content }}</textarea>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="center-block max-width-content">
                    <a href="{{route('posts.index')}}" class="btn btn-lg btn-primary"
                       style="margin-right: 10px">Back</a>
                    <button type="submit" class="btn btn-lg btn-warning">Sửa <i class="fa fa-pencil-square-o"></i>
                    </button>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
            // filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
            extraPlugins: 'justify,image2',
            // filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('pos_content', options);
    </script>
@endsection