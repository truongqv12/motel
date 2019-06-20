@extends('frontend.layout.master')

@section('content')
    <div class="container clearfix">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="">Ở ghép</a></li>
        </ol>
    </div>
    <div class="show_motel">
        <div class="container">
            <div class="title fancy-title title-dotted-border title-center">
                <h2>Danh sách phòng</h2>
            </div>
            <div class="row">
                @foreach($motels->get('data') ?: [] as $item)
                    <div class="col-md-4 mb-4">
                        <!-- Post Article -->
                        <article class="ipost room-item">
                            <div class="entry-image mb-3">
                                <a href="{{$item->get('url')}}">
                                    <img class="img-fit" src="{{$item->get('avatar')}}"
                                         onerror="this.onerror=null; this.src='/assets/images/no_img_room.png'"
                                         alt="{{$item->get('title')}}"></a>
                            </div>
                            <div class="entry-title">
                                <h3><a href="{{$item->get('url')}}">{{$item->get('title')}}</a></h3>
                            </div>
                            <div class="clearfix"></div>
                            <ul class="entry-meta">
                                <?php /*<li><span>Đăng bởi</span>
                                    <a href="javascript:;">{{($item->get('user')) ? $item->get('user')->get('name') :'admin' }}</a>
                                </li> */ ?>
                                <li><i class="icon-time"></i><a
                                            href="javascript:;">{{ $item->get('created_at')->format('d/m/Y H:i')}}</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                            <div class="entry-content mt-0">
                                <div class="room-info">
                                    <div class="info-item d-flex justify-content-between align-items-center">
                                        <span><i class="far fa-stop-circle"></i> Diện tích: <b>{{$item->get('area')}}
                                                m<sup>2</sup></b></span>
                                        <span class="pull-right">
                                        <i class="icon-eye"></i> Lượt xem: <strong>{{$item->get('total_view')}}</strong></span>
                                    </div>
                                    <div class="info-item"><i class="icon-map-marker"></i> Địa
                                        chỉ: {{$item->get('address')}}
                                    </div>
                                    <div class="info-item room-price"><i class="icon-money"></i> Giá thuê:
                                        <strong>{{$item->get('price')}}</strong></div>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="search_pagination bottommargin">
        <nav aria-label="Page navigation example">
            <?php
            echo show_paginate([
                'vars' => [
                    'lastPage'    => $motels->get('meta')->get('pagination')->get('total_pages'),
                    'currentPage' => $motels->get('meta')->get('pagination')->get('current_page')
                ]
            ], $_GET);
            ?>
        </nav>
    </div>

@endsection

@section('script')

@endsection