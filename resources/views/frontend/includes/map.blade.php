@extends('frontend.layout.master')

@section('content')
    <div class="motels_map">
        <div class="container">
            <div class="title fancy-title title-dotted-border title-center">
                <h2>Xem danh sách phòng trên bản đồ</h2>
            </div>
            <div class="control_box" id="control_box">
                <div class="form-group">
                    <input type="text" name="search_address" id="search_address" class="form-control" placeholder="Tìm kiếm địa điểm"
                           title="Tìm theo địa điểm">
                </div>
            </div>
            <div id="data-motel" data-motel="{{$motels_json}}" class="hidden"></div>
            <div class="map_canvas">
                <div id="gmap"></div>
                <!-- vị trí khung zoom -->
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key={{ config('map.key') }}&libraries=places,geometry,visualization">
    </script>
    <script src="/assets/js/infobox.js"></script>
    <script src="/assets/js/markerclusterer.js"></script>
    <script src="/assets/js/map.js?v={{rand(0,100)}}"></script>
@endsection