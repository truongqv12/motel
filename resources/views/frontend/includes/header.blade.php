<!--login form-->
@if(!Auth::check())
    <div id="side-panel">

        <div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="icon-line-cross"></i></a>
        </div>

        <div class="side-panel-wrap">

            <div class="widget clearfix">

                <h4 class="t600 text-uppercase text-uppercase topmargin">Đăng nhập</h4>
                <div class="line line-sm"></div>
                <form id="login-form-header" class="nobottommargin" action="{{ route('login.post') }}"
                      method="POST" onsubmit="return validateLoginForm('login-form-header')">
                    {{ csrf_field() }}

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

                    <div class="col_full">
                        <label class="t400">Email:</label>
                        <input type="text" name="email" value="{{ old('email') }}" title=""
                               class="form-control login-form-email"/>
                    </div>

                    <div class="col_full">
                        <label class="t400">Mật khẩu:</label>
                        <input type="password" name="password" value="" title=""
                               class="form-control login-form-password"/>
                    </div>

                    <div class="col_full">
                        <input type="hidden" name="redirect_link" value="">
                        <button class="button button-rounded t400 nomargin" id="login-form-submit" name="submit"
                                value="login">Đăng nhập
                        </button>
                    </div>
                    <div class="col_full nobottommargin">
                        <a href="<?= url('lost_password') ?>" class="">Quên mật khẩu</a>
                    </div>
                    <div class="line line-sm"></div>
                    <div class="col_full nobottommargin">
                        <a href="<?= url('register') ?>"
                           class="button button-rounded button-purple text-uppercase">Tạo tài khoản</a>
                    </div>
                </form>

            </div>

        </div>

    </div>
@endif
<!-- Top Bar
============================================= -->
<div id="top-bar" class="" style="z-index : 199">

    <div class="container clearfix">

        <div class="col_half fright col_last nobottommargin">
            <div id="top-bar-nav" class="">
                <ul>
                    @if(Auth::check())
                        <li>
                            <a href="" class="select_user_toggle"><span class="icon-user4"></span>
                                <span class="t200 text-lowercase">{{ Auth::user()->name }}</span></a>
                            <ul class="select_user_box">
                                <li>
                                    <a href="">
                                        <i class="icon-user"></i> Tài khoản
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= route('logout') ?>">
                                        <i class="icon-lock"></i> Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="" class="side-panel-trigger"><span class="icon-user4"></span></a></li>
                    @endif

                </ul>
            </div><!-- #top-social end -->

        </div>

    </div>

</div><!-- #top-bar end -->

<!-- Header
============================================= -->
<header id="header" class="transparent-header">

    <div id="header-wrap">

        <div class="container clearfix">

            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            <!-- Logo
            ============================================= -->
            <div id="logo">
                <a href="/" class="standard-logo"><img
                            src="{{ asset('assets/images/logo.png') }}" alt="Carpost"></a>
                <a href="/" class="retina-logo"><img
                            src="{{ asset('assets/images/logo.png') }}" alt="Carpost"></a>
            </div><!-- #logo end -->

            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu" class="not-dark">

                <ul>
                    <li class="mega_menu">
                        <a href="/" class="main_menu_href">
                            <div>Trang chủ</div>
                        </a>
                    </li>
                    @foreach($categories ?: [] as $item)
                        <li class="mega_menu">
                            <a href="{{$item->get('url')}}" class="main_menu_href">
                                <div>{{$item->get('name')}}</div>
                            </a>
                        </li>
                    @endforeach
                    <li class="mega_menu">
                        <a href="/" class="main_menu_href">
                            <div>Tin tức</div>
                        </a>
                        <ul class="mega_menu_box">
                            @foreach($cats_post ?: [] as $item)
                                <li>
                                    <a href="{{$item->get('url')}}">
                                        <div>{{$item->get('name')}}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="mega_menu">
                        <a href="{{route('map.index')}}" class="main_menu_href">
                            <div>Bản đồ</div>
                        </a>
                    </li>
                </ul>
            </nav><!-- #primary-menu end -->
        </div>
    </div>
</header><!-- #header end -->
