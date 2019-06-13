@extends('frontend.layout.master')

@section('style')
    <link rel="stylesheet" href="/assets/css/summernote-bs4.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/dropzone/dist/dropzone.css" type="text/css"/>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="">Đăng tin</a></li>
    </ol>
@endsection

@section('content')
    <div class="post_motel_content mt-4">
        <div class="container clearfix">
            <form action="{{route('motel_post.post')}}" method="POST" enctype="multipart/form-data" id="formMotel"
                  onsubmit="return validateFormMotel()">
                @csrf
                <div class="row">
                    <div class="col-md-2 norightpadding">
                        <div id="step-1" class="submit-list-type">
                            <div class="title-block">
                                <h4 class="step_title">Bước 1: Chọn nhu cầu</h4>
                            </div>
                            <div class="checkbox checkbox-success">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input check_step_1" id="" name="use_need"
                                               value="0">
                                        Cho thuê</label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input check_step_1" id="" name="use_need"
                                               value="1">
                                        Ở ghép</label>
                                </div>
                            </div>
                        </div>
                        <div id="step-2" class="submit-list-type">
                            <div class="title-block">
                                <h4 class="step_title">Bước 2: Chọn loại phòng</h4>
                            </div>
                            <div class="checkbox checkbox-success">
                                @foreach($typeRoom ?: [] as $item)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input check_step_2" id=""
                                                   name="category_id"
                                                   value="{{$item->get('id')}}">{{$item->get('name')}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="step-3" class="col-md-10 no-padding-right submit-room-main-content" style="">
                        <div class="title-block">
                            <h4 class="step_title">Bước 3: Nhập thông tin chi tiết</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="control-label">Tiêu đề</div>
                                    <input type="text" name="title" class="form-control form_title" value=""
                                           title="Tiêu đề"
                                           placeholder="Nhập tiêu đề">
                                    <div class="help-block error_title">
                                        @if($errors->has('title'))
                                            * {!! $errors->first('title') !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">Số điện thoại</div>
                                    <input type="text" name="phone" class="form-control form_phone" value=""
                                           title="Số điện thoại" placeholder="Nhập số điện thoại">
                                    <div class="help-block error_phone">
                                        @if($errors->has('phone'))
                                            * {!! $errors->first('phone') !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="control-label">Giá</div>
                                            <div class="input-group">
                                                <input type="text" class="form-control form_price" name="price"
                                                       placeholder="Giá thuê" id="price">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">đ/tháng</div>
                                                </div>
                                            </div>
                                            <div class="help-block">
                                                @if($errors->has('price'))
                                                    * {!! $errors->first('price') !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="control-label">Diện tích</div>
                                            <div class="input-group">
                                                <input type="text" name="area" value="" class="form-control form_area"
                                                       placeholder="nhập số, viết liền" id="area">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">M<sup>2</sup></div>
                                                </div>
                                            </div>
                                            <div class="help-block">
                                                @if($errors->has('area'))
                                                    * {!! $errors->first('area') !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="control-label">Tỉnh/Thành phố</div>
                                            <div>
                                                <select title="Chọn thành phố" name="cty_id"
                                                        class="select optional form-control fct-profile-edit"
                                                        id="cbCity">
                                                    <option value=""></option>
                                                    @if($cities)
                                                        @foreach ($cities ?: [] as $item)
                                                            <option value="{{$item->get('id')}}">{{$item->get('name')}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="help-block">
                                                    @if($errors->has('cty_id'))
                                                        * {!! $errors->first('cty_id') !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="control-label">Quận/Huyện</div>
                                            <div class="" id="loadDistrict">
                                                <select title="Chọn quận huyện" id="cbDistrict" name="district"
                                                        class="select optional form-control fct-profile-edit">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <dv class="clearfix"></dv>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="control-label">Xã/Phường</div>
                                            <div class="" id="loadWard">
                                                <select title="Chọn xã phường" id="cbWard" name="war_id"
                                                        class="select optional form-control fct-profile-edit">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="control-label">Địa chỉ cụ thể</div>
                                            <div>
                                                <input type="text" name="address" class="form-control address_input"
                                                       value="" id="maps_address" placeholder="Nhập địa chỉ">
                                                <div class="help-block">
                                                    @if($errors->has('cty_id'))
                                                        * {!! $errors->first('cty_id') !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="title-block">
                                    <h4 class="step_title">Thông tin bổ sung</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="vs">
                                                <div class="control-label">Vệ sinh</div>
                                                <div>
                                                    <select name="toilet" class="form-control select2">
                                                        <option value="Khép kín">Khép kín</option>
                                                        <option value="Chung">Chung</option>
                                                        <option value="Chưa xác định">Chưa xác định</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group people-in">
                                            <div class="control-label">Số người ở tối đa</div>
                                            <div>
                                                <select name="people" class="form-control select2">
                                                    <option value="0">Chọn..</option>
                                                    <option value="1">1 người</option>
                                                    <option value="2">2 người</option>
                                                    <option value="3">3 người</option>
                                                    <option value="4">4 người</option>
                                                    <option value="5">5 người</option>
                                                    <option value="6">6 người</option>
                                                    <option value="7">7 người</option>
                                                    <option value="8">8 người</option>
                                                    <option value="9">9 người</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="control-label">Tiện ích</div>
                                <div class="form-group room-option nomargin">
                                    <div class="row">
                                        @foreach($amenities ?: []  as $item)
                                            <div class="col-md-4 norightpadding amen_item">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input amenities_check"
                                                               name="amenities[]"
                                                               value="<?= $item->get('id') ?>"><?= $item->get('name') ?>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="control-label">Thêm hình ảnh về nhà trọ</div>
                                    <div class="dropzone" id="my-dropzone" name="myDropzone">

                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="submit-room-des">
                                    <div class="control-label">Mô tả chi tiết</div>
                                    <div id="text_editer">
                                        <textarea name="description" id="edit_layout"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 gmaps-group">
                                <div class="control-label">Bản đồ</div>
                                <div id="maps_maparea">
                                    <div id="maps_mapcanvas" class="form-group"></div>

                                    <div class="d-none">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">L</span>
                                                        <input type="text" class="form-control"
                                                               name="maps[maps_mapcenterlat]"
                                                               id="maps_mapcenterlat" value="{maps_mapcenterlat}"
                                                               readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">N</span>
                                                        <input type="text" class="form-control"
                                                               name="maps[maps_mapcenterlng]"
                                                               id="maps_mapcenterlng" value="{maps_mapcenterlng}"
                                                               readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">L</span>
                                                        <input type="text" class="form-control" name="maps[maps_maplat]"
                                                               id="maps_maplat" value=""
                                                               readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">N</span>
                                                        <input type="text" class="form-control" name="maps[maps_maplng]"
                                                               id="maps_maplng" value=""
                                                               readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Z</span>
                                                        <input type="text" class="form-control"
                                                               name="maps[maps_mapzoom]"
                                                               id="maps_mapzoom" value="{maps_mapzoom}"
                                                               readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="images" value="">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Đăng tin ngay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div id="msg"></div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/assets/js/jquery.inputmask.min.js"></script>
    <script src="/assets/js/summernote-bs4.min.js"></script>
    <script src="/assets/js/summernote-vi-VN.js"></script>
    <script src="/assets/dropzone/dist/dropzone.js"></script>
    <script src="/assets/js/motel.js"></script>
    <script type="text/javascript">

        $("#price").inputmask({
            alias: 'numeric',
            allowMinus: false,
            digits: 0,
            digitsOptional: false,
            autoGroup: true,
            groupSeparator: '.',
            placeholde: '0',
            max: 10000000000
        });
        $("#area").inputmask({
            alias: 'numeric',
            max: 1000
        });

        var motel_images = [];
        Dropzone.options.myDropzone = {
            url: '{{ route('ajax.upload.store')}}',
            headers: {
                'X-CSRF-TOKEN': '{!! csrf_token() !!}'
            },
            autoProcessQueue: true,
            uploadMultiple: true,
            parallelUploads: 5,
            maxFiles: 10,
            maxFilesize: 5,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            dictFileTooBig: 'Image is bigger than 5MB',
            addRemoveLinks: true,
            removedfile: function (file) {
                var name = file.name;
                name = name.replace(/\s+/g, '-').toLowerCase();
                arrayRemove(motel_images, name);
                /*only spaces*/
                deleteImage(name);
                $('[name=images]').val(motel_images);
                var _ref;
                if (file.previewElement) {
                    if ((_ref = file.previewElement) != null) {
                        _ref.parentNode.removeChild(file.previewElement);
                    }
                }
                return this._updateMaxFilesReachedClass();
            },
            previewsContainer: null,
            hiddenInputContainer: "body",
            successmultiple: function (data) {
                $.each(data, function (key, value) {
                    motel_images.push(value.name);
                })
                $('[name=images]').val(motel_images);
            }
        };

        function deleteImage(name) {
            $.ajax({
                type: 'POST',
                url: '{{ route('ajax.upload.delete')}}',
                headers: {
                    'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                },
                data: "id=" + name,
                dataType: 'json',
                success: function (data) {

                }
            });
        }
    </script>
    <script>
        $('#edit_layout').summernote({
            placeholder: 'Thêm thông tin về phòng trọ, nhà trọ',
            tabsize: 1,
            height: 300,
            lang: 'vi-VN',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    </script>
    <script>

        let map, ele, mapH, mapW, addEle, mapZ;

        ele = 'maps_mapcanvas';
        addEle = 'maps_address';
        mapLat = 'maps_maplat';
        mapLng = 'maps_maplng';
        mapZ = 'maps_mapzoom';
        mapArea = 'maps_maparea';
        mapCenLat = 'maps_mapcenterlat';
        mapCenLng = 'maps_mapcenterlng';

        // Call Google MAP API
        if (!document.getElementById('googleMapAPI')) {
            const s = document.createElement('script');
            s.type = 'text/javascript';
            s.id = 'googleMapAPI';
            s.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&callback=controlMap&key={{config('map.key')}}';
            document.body.appendChild(s);
        } else {
            controlMap();
        }

        function controlMap() {
            $('#' + mapArea).slideDown(100, function () {
                initializeMap();
            });

            return !1;
        }

        // Creat map and map tools
        function initializeMap() {
            let zoom = parseInt($("#" + mapZ).val()), lat = parseFloat($("#" + mapLat).val()),
                lng = parseFloat($("#" + mapLng).val()), Clat = parseFloat($("#" + mapCenLat).val()),
                Clng = parseFloat($("#" + mapCenLng).val());
            Clat || (Clat = 20.984516000000013, $("#" + mapCenLat).val(Clat));
            Clng || (Clng = 105.79547500000001, $("#" + mapCenLng).val(Clng));
            lat || (lat = Clat, $("#" + mapLat).val(lat));
            lng || (lng = Clng, $("#" + mapLng).val(lng));
            zoom || (zoom = 15, $("#" + mapZ).val(zoom));

            mapW = $('#' + ele).innerWidth();
            mapH = 350;

            // Init MAP
            $('#' + ele).width(mapW).height(mapH > 500 ? 500 : mapH);
            map = new google.maps.Map(document.getElementById(ele), {
                zoom: zoom,
                center: {
                    lat: lat,
                    lng: lng
                }
            });

            // Init default marker
            var markers = [];
            markers[0] = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(lat, lng),
                draggable: true,
                animation: google.maps.Animation.DROP
            });
            markerdragEvent(markers);

            // Init search box
            let searchBox = new google.maps.places.SearchBox(document.getElementById(addEle));

            google.maps.event.addListener(searchBox, 'places_changed', function () {
                let places = searchBox.getPlaces();

                if (places.length === 0) {
                    return;
                }

                for (let i = 0, marker; marker = markers[i]; i++) {
                    marker.setMap(null);
                }

                markers = [];
                let bounds = new google.maps.LatLngBounds();
                for (let i = 0, place; place = places[i]; i++) {
                    let marker = new google.maps.Marker({
                        map: map,
                        position: place.geometry.location,
                        draggable: true,
                        animation: google.maps.Animation.DROP
                    });
                    markers.push(marker);
                    bounds.extend(place.geometry.location);
                }

                markerdragEvent(markers);
                map.fitBounds(bounds);
                map.setZoom(18);
                console.log(places);
            });

            // Thêm marker khi click
            google.maps.event.addListener(map, 'click', function (e) {
                for (let i = 0, marker; marker = markers[i]; i++) {
                    marker.setMap(null);
                }

                markers = [];
                markers[0] = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(e.latLng.lat(), e.latLng.lng()),
                    draggable: true,
                    animation: google.maps.Animation.DROP
                });

                markerdragEvent(markers);
            });

            // Event on zoom map
            google.maps.event.addListener(map, 'zoom_changed', function () {
                $("#" + mapZ).val(map.getZoom());
            });

            // Event on change center map
            google.maps.event.addListener(map, 'center_changed', function () {
                $("#" + mapCenLat).val(map.getCenter().lat());
                $("#" + mapCenLng).val(map.getCenter().lng());
                console.log(map.getCenter());
            });
        }

        // Map Marker drag event
        function markerdragEvent(markers) {
            for (let i = 0, marker; marker = markers[i]; i++) {
                $("#" + mapLat).val(marker.position.lat());
                $("#" + mapLng).val(marker.position.lng());

                google.maps.event.addListener(marker, 'drag', function (e) {
                    $("#" + mapLat).val(e.latLng.lat());
                    $("#" + mapLng).val(e.latLng.lng());
                });
            }
        }
    </script>
@endsection