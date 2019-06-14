@extends('backend.layout.index')
@section('page_title','404')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-yellow"> 404</h2>

                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Trang không tồn tại.</h3>
                    <p>
                        Bấm vào <a href="{{route('admin')}}">đây</a> để quay lại
                    </p>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
        <!-- /.content -->
    </div>
@endsection