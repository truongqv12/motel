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

                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> <?php echo $detail->get('created_at')->format('d/m/Y'); ?>
                        </li>
                    </ul><!-- .entry-meta end -->

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

                        <!-- Post Single - Share
                        ============================================= -->
                        <div class="si-share noborder clearfix">
                            <span>Chia sẻ bài viết:</span>

                        </div><!-- Post Single - Share End -->

                    </div>
                </div><!-- .entry end -->

            </div>
        </div>

        <div class="sidebar nobottommargin col_last clearfix">
            <div class="sidebar-widgets-wrap post-right-sidebar">
                @yield('right_contents')
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection