@extends('frontend.layout.master')

@section('content')
    <div class="profile_content">
        <div class="container clearfix">
            @yield('breadcrumb')

            @yield('profile_content')

            <div id="profile_nav" class="sidebar nomargin profile_nav clearfix">
                <ul class="">
                    <li class="">
                        <a href="<?= route('profile') ?>"
                           class="<?= (url()->current() == route('profile')) ? 'active' : '' ?>">
                            <i class="icon-user"></i> Tổng quan</a>
                    </li>
                    <li class="">
                        <a href="<?= route('profile.motel_post') ?>"
                           class="<?= (url()->current() == route('profile.motel_post')) ? 'active' : '' ?>">
                            <i class="icon-home"></i> Tin đã đăng</a>
                    </li>
                    <li class="">
                        <a href="{{route('profile.motel_save')}}"
                           class="<?= (url()->current() == route('profile.motel_save')) ? 'active' : '' ?>">
                            <i class="icon-book"></i> Tin đã lưu</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection