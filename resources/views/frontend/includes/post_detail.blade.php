@extends('frontend.layout.master')

@section('content')
    <div class="container clearfix">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $detail->get('title') }}</a></li>
        </ol>
    </div>
    <div class="container clearfix ">
        <div class="postcontent nobottommargin clearfix post_detail">
            <div class="single-post nobottommargin">
                <div class="entry clearfix">
                    <div class="entry-title">
                        <h2><?php echo $detail->get('title'); ?></h2>
                    </div><!-- .entry-title end -->
                    <div class="clearfix mt-2 mb-3 d-flex">
                        <div id="fb-root"></div>

                        <!-- Your share button code -->
                        <div class="fb-share-button"
                             data-href="{{ url()->current() }}"
                             data-layout="button_count">
                        </div>
                        <!-- Your like button code -->
                        <div class="fb-like"
                             data-href="{{ url()->current() }}"
                             data-layout="button_count"
                             data-action="like"
                             data-show-faces="true">
                        </div>
                    </div><!-- Post Single - Share End -->
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> <?php echo $detail->get('created_at')->format('d/m/Y'); ?>
                        </li>
                    </ul><!-- .entry-meta end -->
                    <!-- Post Single - Share
                                         ============================================= -->
                <?php /*<div class="entry-image">
                    <a href="#"><img src="<?= $detail->image; ?>" alt="Blog Single"></a>
                </div><!-- .entry-image end --> */ ?>

                <!-- Entry Content
                ============================================= -->
                    <div class="entry-content notopmargin">

                        <p>
                            <?php echo $detail->get('teaser'); ?>
                        </p>

                        <div class="post_detail_content">
                            <?php echo $detail->get('content'); ?>
                        </div>

                        <div class="clear"></div>

                    </div>
                </div><!-- .entry end -->

            </div>
        </div>

        <div class="sidebar nobottommargin col_last clearfix">
            <div class="sidebar-widgets-wrap post-right-sidebar">
                @include('frontend.includes.posts_right_listing',['title'=>'Bài viết liên quan', 'items'=>$posts_same])
                @include('frontend.includes.posts_right_listing',['title'=>'Bài viết mới','items'=>$posts_new])
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            console.log('ready');
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        })
    </script>
@endsection