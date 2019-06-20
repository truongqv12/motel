@extends('frontend.layout.profile')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="">Tổng quan</a></li>
    </ol>
@endsection

@section('profile_content')
    <div class="postcontent col_last clearfix profile_right">
        <h3 class="text-uppercase t500 text-center">Thông tin cá nhân</h3>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! Session::get('success') !!}
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! Session::get('error') !!}
            </div>
        @endif
        <div class="tabs tabs-bb clearfix" id="tab-profile">

            <ul class="tab-nav clearfix">
                <li><a href="#tabs-1">Hồ sơ</a></li>
                <li><a href="#tabs-2">Đổi mật khẩu</a></li>
            </ul>

            <div class="tab-container">
                <div class="tab-content clearfix" id="tabs-1">
                    <div class="tab_profile">
                        <div class="col_two_third">
                            <form class="" method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                <div class="form-group input_with_label">
                                    <div class="input_with_label_left">
                                        <label class="">Email</label>
                                    </div>
                                    <div class="input_with_label_right">
                                        <input type="text" class="form-control" style="background-color: #e9ecef"
                                               name=""
                                               value="{{$profile->email}}" placeholder="" disabled>
                                    </div>
                                </div>
                                <div class="form-group input_with_label">
                                    <div class="input_with_label_left">
                                        <label class="">Số điện thoại</label>
                                    </div>
                                    <div class="input_with_label_right">
                                        <input type="text" class="form-control" name=""
                                               style="background-color: #e9ecef" disabled
                                               value="{{$profile->phone}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group input_with_label">
                                    <div class="input_with_label_left">
                                        <label class="">Địa chỉ</label>
                                    </div>
                                    <div class="input_with_label_right">
                                        <input type="text" class="form-control" name="address"
                                               value="{{$profile->address}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group input_with_label">
                                    <div class="input_with_label_left">
                                        <label class="">Giới tính</label>
                                    </div>

                                    <div class="input_with_label_right">
                                        <div class="radio_inline">
                                            <div class="radio_inline_item">
                                                <input id="radio-7" class="radio-style" name="gender" value="1"
                                                       type="radio" {{($profile->gender == 1) ? 'checked' : ''}}>
                                                <label for="radio-7" class="radio-style-2-label radio-small">Nam</label>
                                            </div>
                                            <div class="radio_inline_item">
                                                <input id="radio-8" class="radio-style" name="gender" value="0"
                                                       type="radio" {{($profile->gender == 0) ? 'checked' : ''}}>
                                                <label for="radio-8" class="radio-style-2-label radio-small">Nữ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-content clearfix" id="tabs-2">
                    <div class="tab_profile">
                        <div class="col_two_third">
                            <form class="" method="POST" action="{{ route('profile.update.pass') }}">
                                @csrf
                                <div class="form-group input_with_label">
                                    <div class="input_with_label_left">
                                        <label class="">Mật khẩu cũ</label>
                                    </div>
                                    <div class="input_with_label_right">
                                        <input type="password" class="form-control" name="password_old" value="" placeholder="">
                                    </div>
                                    <div class="help-block error_title">
                                        @if($errors->has('password_old'))
                                            * {!! $errors->first('password_old') !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group input_with_label">
                                    <div class="input_with_label_left">
                                        <label class="">Mật khẩu mới</label>
                                    </div>
                                    <div class="input_with_label_right">
                                        <input type="password" class="form-control" name="password_new" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="help-block error_title text-center mb-3">
                                    @if($errors->has('password_new'))
                                        * {!! $errors->first('password_new') !!}
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection