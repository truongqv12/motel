@extends('frontend.layout.master')

@section('content')
    <div class="map_canvas">
        <div id="gmap"></div>
        <!-- vị trí khung zoom -->
    </div>
@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key={{ config('map.key') }}&libraries=places,geometry,visualization">
    </script>
    <script src="<?= asset('assets/js/infobox.js') ?>"></script>
    <script src="<?= asset('assets/js/markerclusterer.js') ?>"></script>
    <script src="<?= asset('assets/js/map.js') ?>"></script>
@endsection