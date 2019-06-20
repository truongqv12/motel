@extends('frontend.auth.layout')

@section('content')
    <div class="login_container"
         style=" background: url('{{setting('home_banner')}}') center center no-repeat; background-size: cover;">
    </div>
    <div class="card card_register divcenter noradius noborder allmargin modal-padding"

         style="max-width: 600px; background-color: rgba(255,255,255,0.93);">
        <div class="card-body nopadding">
            <div class="title">
                <h3>Đăng ký</h3>
            </div>
            <div class="help-block show_err">
                @if($errors->has('name'))
                    * {!! $errors->first('name') !!}
                @endif
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
            <form id="register-form" name="login-form" class="nobottommargin" method="post"
                  action="{{route('signup.post')}}"
                  onsubmit="return validateRegisterForm('register-form')">
                {{ csrf_field() }}
                <div class="col_half">
                    <div class="col_full">
                        <label for="">* Họ tên:</label>
                        <input type="text" name="name" value="{{ old('name') }}" title="" placeholder="Nhập họ và tên"
                               class="form-control not-dark login-form-username"/>
                    </div>
                    <div class="col_full">
                        <label for="">* Email:</label>
                        <input type="text" name="email" value="{{ old('email') }}" title="" placeholder="Nhập email"
                               class="form-control login-form-email"/>
                    </div>

                    <div class="col_full">
                        <label for="">* SĐT:</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" title=""
                               placeholder="Nhập số điện thoại"
                               class="form-control login-form-phone"/>
                    </div>
                </div>
                <div class="col_half col_last">
                    <div class="col_full">
                        <label for="">* Mật khẩu:</label>
                        <input type="password" name="password" value="" placeholder="Mật khẩu"
                               class="form-control not-dark login-form-password"/>
                    </div>

                    <div class="col_full">
                        <label for="">* Nhập lại mật khẩu:</label>
                        <input type="password" name="password_confirmation" value="" placeholder="Nhập lại mật khẩu"
                               class="form-control not-dark login-form-password-confirm"/>
                    </div>

                </div>
                <div class="col_full nobottommargin text-center">
                    <button class="btn btn-success" name="submit"
                            value="login">Đăng ký
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection