@extends('frontend.layout.master')

@section('content')
    <div class="profile_content">
        <div class="container clearfix">
            @yield('breadcrumb')

            @yield('profile_content')

            <div id="profile_nav" class="sidebar nomargin profile_nav clearfix">
                <ul class="">
                    <li class="">
                        <a href="<?= url('profile') ?>"
                           class="<?= (url()->current() == route('profile')) ? 'active' : '' ?>">
                            <i class="icon-user"></i> Tổng quan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection