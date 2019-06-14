@extends('frontend.layout.master')
@section('style')
    <style>
        .gllpMap {
            width: 100% !important;
            height: 420px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container clearfix">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $motel->get('title') }}</a></li>
        </ol>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="motel-detail">
                    <div class="room-detail">
                        <div class="title">
                            <a href="javascript: void(0);"><h1>{{$motel->get('title')}}</h1></a>
                        </div>
                        <div class="social">
                            <div class="pull-left facebook">
                                <div class="pull-right">
                                    <a href="javascript:;"><span>Lượt xem : </span>{{$motel->get('total_view')}}</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- Nhà trọ, Phòng trọ -->
                            <div class="main-info">
                                <div class="row">
                                    <div class="col-md-8 left-info">
                                        <table class="table table-bordered nomargin">
                                            <tbody>
                                            <tr>
                                                <th scope="row">Địa chỉ</th>
                                                <td><a href="">{{$motel->get('address')}}</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Diện tích</th>
                                                <td><a href="">{{$motel->get('area')}}m<sup>2</sup></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Loại phòng</th>
                                                <td><a href="">Ph&ograve;ng trọ, nh&agrave; trọ</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Vệ sinh</th>
                                                <td><a href="">{{$motel->get('toilet')}}</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Số người ở</th>
                                                <td><a href="">{{$motel->get('people') ?: 'Chưa xác định'}}</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tiện ích</th>
                                                <td>
                                                    @foreach($motel->get('amenities') as $item)
                                                        <a href="">{{$item}}</a>,
                                                    @endforeach
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 info-contact">
                                        <div class="" style="padding: 15px 20px">
                                            <div class="contact-label">
                                                <a href=""><span class="icon-info"></span>Thông tin liên hệ</a>
                                            </div>
                                            <div class="chr">
                                                <hr>
                                            </div>
                                            <div class="info-price">
                                                <a href=""><span class="icon-unlock"></span>{{$motel->get('price')}}</a>
                                            </div>
                                            <div class="info-boss">
                                                <a href=""><span class="icon-user3"></span></a>
                                            </div>
                                            <div class="info-phone">
                                                <a href=""><span class="icon-phone"></span>{{$motel->get('phone')}}</a>
                                            </div>
                                            <div class="info-feedback d-lg-flex d-md-block justify-content-between align-items-center">
                                                @if(Auth::check())
                                                    <button class="btn btn_search" id="report_btn" data-toggle="modal"
                                                            data-target="#modal_bao_cao">Phản hồi tình trạng
                                                    </button>
                                                    <button class="btn btn_search" id="save_btn"
                                                            onclick="return ajax_save_motel({{$motel->get('id')}})">Lưu
                                                        tin
                                                    </button>
                                                    <!-- modal_bao_cao -->
                                                    <div class="modal fade" id="modal_bao_cao" tabindex="-1"
                                                         role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content w-75 m-auto">
                                                                <div class="modal-body">
                                                                    <div class="report">
                                                                        <h4 class="mt-2 mb-2 text-center">BÁO CÁO</h4>

                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div class="form-check">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio"
                                                                                           class="form-check-input"
                                                                                           name="report" checked
                                                                                           value="0">Đã
                                                                                    cho thuê
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio"
                                                                                           class="form-check-input"
                                                                                           name="report"
                                                                                           value="1">Sai
                                                                                    thông tin
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-center mt-3 mb-2">
                                                                            <button class="btn btn-danger btn-sm"
                                                                                    onclick="return ajax_send_report({{$motel->get('id')}})">
                                                                                Gửi phản hồi
                                                                            </button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <button class="btn btn_search side-panel-trigger">Phản hồi tình
                                                        trạng
                                                    </button>
                                                    <button class="btn btn_search side-panel-trigger">Lưu tin</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="room-detail-img">
                                <div class="title fancy-title title-dotted-border title-center" style="margin: 20px 0;">
                                    <h2>Hình ảnh</h2>
                                </div>
                                <div class="row">
                                    @foreach($motel->get('images') as $item)
                                        <div class="col-md-3 mb-3">
                                            <div class="img-item">
                                                <a href="{{img_motel_link($item)}}" class="fancybox"
                                                   data-fancybox="img_motel">
                                                    <img class="img-fit" src="{{img_motel_link($item)}}"
                                                         onerror="this.onerror=null; this.src='/assets/images/no_img_room.png'"
                                                         alt="{{$motel->get('slug')}}">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="room-detail-des">
                                <div class="title fancy-title title-dotted-border title-center" style="margin: 20px 0;">
                                    <h2>Thông tin chi tiết</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $motel->get('description') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="room-detail-map">
                                <div class="title fancy-title title-dotted-border title-center" style="margin: 20px 0;">
                                    <h2>Bản đồ</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="map-content">
                                            <fieldset class="gllpLatlonPicker">
                                                <input type="hidden" class="gllpSearchField">
                                                <input type="hidden" class="gllpSearchButton" value="search">
                                                <!-- <br/><br/> -->
                                                <div class="gllpMap">Google Maps</div>
                                                <!-- <br/>
                                                lat/lon: -->
                                                <input type="hidden" class="gllpLatitude"
                                                       value="{{ $motel->get('lat') }}"/>
                                                <!-- / -->
                                                <input type="hidden" class="gllpLongitude"
                                                       value="{{ $motel->get('lng') }}"/>
                                                <!-- zoom: --> <input type="hidden" class="gllpZoom" value="15"/>
                                                <input type="hidden" class="gllpUpdateButton" value="update map">
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        load_icheck();
        $('.fancybox').fancybox({
            thumbs: {
                autoStart: true,
                axis: 'x'
            },
        });
    </script>
    <script src="/assets/js/jquery-gmaps-latlon-picker.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('map.key')}}&sensor=false"></script>
@endsection