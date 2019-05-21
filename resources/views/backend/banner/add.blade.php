@extends('backend.layout.index')
@section('page_title','Thêm mới')
@section('link_css')
    <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mới banner
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('banner.index')}}">Banner</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{route('banner.store')}}" method="POST" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Thêm mới</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thông tin banner</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="title"
                                           id="name" value="{{ old('title') }}">
                                </div>
                            </div>
                            @if($errors->has('title'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('title') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">#</span>
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
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Nhập link banner" name="link"
                                           value="{{ (empty(old('link')) ? '#' : old('link'))  }}">
                                </div>
                            </div>
                            @if($errors->has('link'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('link') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="active" value="0">
                                        <span class="label label-danger">Ban</span>
                                    </label>
                                    <label>
                                        <input checked type="radio" name="active" value="1">
                                        <span class="label label-success">Activated</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ảnh Banner</label>
                                <div class="show-avatar">
                                    <img src="" alt="" id="img" style="width: 300px; height: 100px;">
                                    <input type="file" name="upload_avatar" id="upload_img" style="display: none">
                                    <a id="browse_file" class="btn btn-success">
                                        <i class="fa fa-file-image-o"></i>
                                        Chọn banner
                                    </a>
                                </div>
                            </div>
                            @if($errors->has('upload_avatar'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('upload_avatar') !!}
                                </div>
                            @endif
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
    <!-- InputMask -->
    <script src="{{asset('backend/plugins/input-mask/jquery.inputmask.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
            $('[data-mask]').inputmask();
        })
    </script>
@endsection