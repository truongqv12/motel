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
    <link rel="stylesheet" href="/assets/css/font-icons.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/magnific-popup.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/components/radio-checkbox.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/components/ion.rangeslider.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/components/select2.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/fancybox/dist/jquery.fancybox.min.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/icheck/skins/square/green.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/responsive.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/toastr.min.css" type="text/css"/>

    <link rel="stylesheet" href="/assets/css/custom.css?v='{{rand(0, 1000)}}" type="text/css"/>
    @yield('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    {!! \Meta::display([], true) !!}
</head>
<body class="stretched side-push-panel no-transition {{ ($errors->has('email') || $errors->has('password') || Session::has('error_login')) ? 'side-panel-open' : '' }}">
@include('frontend.includes.header')
<div class="clearfix"></div>
<div id="wrapper" class="clearfix">
    <div class="clearfix"></div>
    @yield('search_box')
    <div class="clearfix"></div>
    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap nopadding">
            @yield('content')
        </div>

    </section><!-- #content end -->

</div><!-- #wrapper end -->
@include('frontend.includes.footer')
<!-- External JavaScripts
============================================= -->
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="/assets/js/functions.min.js"></script>
<script src="/assets/js/components/bs-switches.js"></script>
<script src="/assets/js/components/rangeslider.min.js"></script>
<script src="/assets/js/components/select2.min.js"></script>
<script src="/assets/fancybox/dist/jquery.fancybox.min.js"></script>
<script src="/assets/icheck/icheck.min.js"></script>
<script src="/assets/js/header.js"></script>
<script src="/assets/js/home.js"></script>
<script>

    $(window).on('load', function () {
        var slideImg = $('.slider_top_item');
        slideImg.height(slideImg.width() / 1.7);
        window.addEventListener("scroll", function (event) {
            jQuery('#header').removeClass('sticky-header'); // Down Scroll
        });
    });

</script>
@yield('script')
</body>
</html>