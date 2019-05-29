<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="SemiColonWeb"/>
    <link rel="shortcut icon" href="">
    <!-- Stylesheets
    ============================================= -->
    <link rel="stylesheet" href="/assets/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/style.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/swiper.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/demos/business/business.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/font-icons.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/magnific-popup.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/components/radio-checkbox.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/components/ion.rangeslider.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/components/select2.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/fancybox/dist/jquery.fancybox.min.css" type="text/css"/>

    <link rel="stylesheet" href="/assets/css/responsive.css" type="text/css"/>

    <link rel="stylesheet" href="/assets/css/custom.css?v='{{rand(0, 1000)}}" type="text/css"/>
    @yield('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    {!! \Meta::display([], true) !!}
</head>
<body class="stretched side-push-panel">

<div class="clearfix"></div>
<div id="wrapper" class="clearfix">
    <div class="clearfix"></div>
    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap nopadding" style="z-index: 1;">
            <div class="show_motel mt-5">
                <div class="cart_content">
                    <div class="cart_content_empty">
                        <div class="content">
                            <img src="{{asset('assets/images/empty.svg')}}" alt="">
                            <h4 class="t600 mt-2">Trang bạn vừa nhập không tồn tại</h4>
                            <a href="{{route('index')}}" class="btn to_pay">Quay lại trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- #content end -->

</div><!-- #wrapper end -->

<!-- External JavaScripts
============================================= -->
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="/assets/js/functions.min.js"></script>

</body>
</html>