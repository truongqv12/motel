@extends('frontend.auth.layout')

@section('content')
    <div class="login_container"
         style=" background: url('{{asset('assets/images/banner-login.png')}}') center center no-repeat; background-size: cover;">
    </div>
    <div class="card card_login divcenter noradius noborder allmargin modal-padding"

         style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
        <div class="card-body nopadding">
            <div class="title">
                <h3>Đăng nhập</h3>
            </div>
            <div class="help-block show_err">
                @if($errors->has('email'))
                    * {!! $errors->first('email') !!}
                @endif
                @if($errors->has('password'))
                    * {!! $errors->first('password') !!}
                @endif
                @if(Session::has('error_login'))
                    * {!! Session::get('error_login') !!}
                @endif
            </div>
            <form id="login-form" name="login-form" class="nobottommargin" action="{{route('login.post')}}"
                  method="post" onsubmit="return validateLoginForm('login-form')">
                {{ csrf_field() }}
                <div class="col_full">
                    <label for="">Email:</label>
                    <input type="text" name="email" value="{{ old('email') }}" title=""
                           class="form-control login-form-email"/>
                </div>

                <div class="col_full">
                    <label for="">Mạt khẩu:</label>
                    <input type="password" name="password" value="" title=""
                           class="form-control login-form-password"/>
                </div>

                <div class="col_full ">
                    <button class="btn btn-success" name="submit" value="login">Đăng nhập</button>
                </div>
                <div class="coll_full nobottommargin">
                    <a href="" class="">Quên mật khẩu</a>
                    <div class="line line-sm"></div>
                    <a href="{{route('signup')}}" class="btn btn-primary">Đăng ký</a>
                </div>
            </form>

        </div>
    </div>
@endsection