@extends('frontend.layout.master')

@section('content')
    <div class="container clearfix">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $category->get('name') }}</a></li>
        </ol>
    </div>
    <div class="posts_body">
        <div class="container" style="max-width: 1140px !important">

            <?php if ($posts) : ?>
            <?php foreach ($posts['data'] as $item) : ?>
            <div class="post_item col_full">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="entry-image post_item_img">
                            <a href="<?= $item->get('image') ?>" data-lightbox="image">
                                <img class="image_fade" src="{{ $item->get('image')  }}"
                                     alt="{{ $item->get('title')  }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="post_item_text">
                            <div class="vertical-middle">
                                <a href="{{ $item->get('url') }}" class="post_title t600">{{ $item->get('title') }}</a>
                                <span class="post_date"><?= $item->get('created_at')->format('d/m/Y') ?></span>
                                <p class="post_teaser"><?= $item->get('teaser') ?></p>
                                <a href="{{ $item->get('url') }}"
                                   class="view_more t600"> Xem thêm </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php /*<a href="<?= $item->link ?>" class="view_more t600"><?= trans('label.view_more') ?></a> */ ?>
            </div>
            <?php endforeach; ?>
            <div class="clearfix"></div>
            <div class="search_pagination bottommargin">
                <nav aria-label="Page navigation example">
                    <?php
                    echo show_paginate([
                        'vars' => [
                            'lastPage'    => $posts->get('meta')->get('pagination')->get('total_pages'),
                            'currentPage' => $posts->get('meta')->get('pagination')->get('current_page')
                        ]
                    ], $_GET);
                    ?>
                </nav>
            </div>
            <?php endif; ?>
        </div>
    </div>



@endsection

@section('script')

@endsection