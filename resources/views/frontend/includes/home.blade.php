@extends('frontend.layout.master')

@section('search_box')
    <section id="slider" class="banner_home slider-element clearfix"
             style="background: url('{{asset('assets/images/slide_new.jpg')}}') center center no-repeat; background-size: cover;">
        <div class="vertical-middle search_box">
            <div class="container clearfix" style="padding: 0 10px">
                <form id="search-motel" class="form" action="{{route('motel.search')}}" method="GET">
                    <div class="form_search">
                        <div class="search_box_header">
                            <div class="search_box_header_left">
                                <h3 class="title">Chọn khu vực</h3>
                                <div class="form-group nomargin">
                                    <div class="input_search">
                                        <input type="text" name="address" class="form-control"
                                               placeholder="Địa chỉ bạn muốn tìm phòng">
                                    </div>
                                    <div class="input_search">
                                        <select title="Chọn thành phố" name="city"
                                                class="select optional form-control fct-profile-edit"
                                                id="cbCity">
                                            <option value=""></option>
                                            @if($cities)
                                                @foreach ($cities ?: [] as $item)
                                                    <option value="{{$item->get('id')}}">{{$item->get('name')}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="input_search" id="loadDistrict">
                                        <select title="Chọn quận huyện" id="cbDistrict" name="district"
                                                class="select optional form-control fct-profile-edit">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="search_box_header_middle">
                                <h3 class="title">Chọn loại phòng</h3>
                                <div class="form-group">
                                    <div class="radio_inline_item nopadding">
                                        <input type="radio" class="radio-style" name="motel_type" id="payment_type_1"
                                               value="1">
                                        <label for="payment_type_1" class="radio-style-2-label radio-small">Phòng trọ,
                                            nhà trọ </label>
                                    </div>
                                </div>
                            </div>
                            <div class="search_box_header_right">
                                <h3 class="title">Chọn khoảng giá</h3>
                                <div class="white-section">
                                    <input class="range_13" name="price" title=""/>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 text-center">
                            <button type="submit" class="btn btn_search"><span class="icon-search3"></span>Tìm kiếm
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('content')

    <div class="intro-home">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="asks-first">
                        <div class="asks-first-circle">
                            <span class="icon-search"></span>
                        </div>
                        <div class="asks-first-info">
                            <h2>Giải pháp tìm kiếm mới</h2>
                            <p>Tiết kiệm nhiều thời gian cho bạn với giải pháp và công nghệ mới</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="asks-first2 asks-first">
                        <div class="asks-first-circle">
                            <span class="icon-line2-hourglass"></span>

                        </div>
                        <div class="asks-first-info">
                            <h2>An Toàn - Nhanh chóng</h2>
                            <p>Với đội ngũ Quản trị viên kiểm duyệt hiệu quả, Chất Lượng đem lại sự tin tưởng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="show_motel">
        <div class="container">
            <div class="title fancy-title title-dotted-border title-center">
                <h2>Mới đăng gần đây</h2>
            </div>
            <div class="row">
                @if($motels)
                    @foreach($motels ?: [] as $item)
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
                @endif
            </div>
        </div>


    </div>

@endsection

@section('script')
    <script !src="">
        $(".range_13").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 10000000,
            from: 500000,
            to: 5000000,
            step: 100000,
            postfix: " đ"
        });
    </script>
@endsection