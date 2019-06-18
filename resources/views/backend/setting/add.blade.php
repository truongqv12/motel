@extends('backend.layout.index')
@section('page_title','Thêm mới')
@section('link_css')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mới tác giả
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('setting.index')}}">Setting</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{route('setting.store')}}" method="POST" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Thêm mới</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label>* Mô tả</label>
                        <input type="text" class="form-control" placeholder="Nhập mô tả" name="label"
                               id="" value="{{ old('label') }}">

                    </div>
                    @if($errors->has('label'))
                        <div class="help-block text-red">
                            * {!! $errors->first('label') !!}
                        </div>
                    @endif
                    <div class="form-group">
                        <label>* Mã</label>
                        <input type="text" class="form-control" placeholder="Nhập mã setting" name="key"
                               id="" value="{{ old('key') }}">
                    </div>
                    <div class="form-group">
                        <label>* Loại</label>
                        <select class="form-control select2" name="swe_type" title="" id="swe_type">
                            <option value="plain_text">Văn bản</option>
                            <option value="image">Ảnh</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>* Giá trị</label>
                        <textarea name="swe_value_plain_text" id="swe_value_plain_text" class="swe_value_plain_text"></textarea>
                        <div class="swe_value_image" id="swe_value_image" style="display: none">
                            <input class="form-control" type="file" title="" id="" name="swe_value_image" size=""
                                   style="display: inline-block;">
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
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
            // filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
            extraPlugins : 'justify,image2',
            // filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('swe_value_plain_text', options);

        $('#swe_type').change(function () {
            var type = $(this).val();
            if (type === 'image') {
                $('#cke_swe_value_plain_text').hide();
                $('#swe_value_plain_text').hide();
                $('#swe_value_image').show();
            } else if (type === 'plain_text') {
                $('#cke_swe_value_plain_text').show();
                $('#swe_value_plain_text').show();
                $('#swe_value_image').hide();
            }
        });
    </script>
@endsection