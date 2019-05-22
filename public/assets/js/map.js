$(document).ready(function (listener) {
    var listMarker = $('#data-motel').data('motel');
    var icon_agency = '/assets/images/icons/gps.png';
    var latLngCenter = new google.maps.LatLng(21.0282852, 105.79533459999993);
    var mapDiv = document.getElementById('gmap');
    var map, current_location;
    var service = new google.maps.DistanceMatrixService();
    var geocoder = new google.maps.Geocoder;
    mapDiv.style.width = '100%';
    mapDiv.style.height = '100%';
    var mapOptions = {
        zoom: 14,
        center: latLngCenter,
        styles: [
            {elementType: 'labels.text.fill', stylers: [{color: '#6d8798'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#ffffff'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{color: '#e6e6e6'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#bbcacf'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#97adb5'}]
            },
            {
                featureType: 'water',
                stylers: [{color: '#a3c7df'}]
            },
            // ẩn bớt đối tượng trên lớp
            {
                featureType: 'poi.business',
                stylers: [{visibility: 'off'}]
            },
            {
                featureType: 'transit',
                elementType: 'labels.icon',
                stylers: [{visibility: 'off'}]
            }
        ],
        streetViewControl: false,
        zoomControl: true,
        gestureHandling: 'greedy',
        clickableIcons: false
    };
    var infowindow = new google.maps.InfoWindow();

    /* SINGLE */
    function initMap() {
        map = new google.maps.Map(mapDiv, mapOptions);
        var marker_created = [];
        //Tạo control box
        // var controlBox = document.getElementById('control_box');
        // map.controls[google.maps.ControlPosition.TOP_CENTER].push(controlBox);

        // tạo marker
        listMarker.forEach(function (item) {
            createMarker(item);
        });
        createClusterer(marker_created);
        var searchBox = new google.maps.places.SearchBox(document.getElementById('search_address'));
        var markers = [];
        google.maps.event.addListener(searchBox, 'places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length === 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            markers = [];
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        // tạo marker
        function createMarker(item) {
            var pos = new google.maps.LatLng(item.lat, item.lng);

            var contentString = '<div class="container_infobox">' +
                '<h3 class="title text-center">' + item.title + '</h3>' +
                '<div class="" style="width: 350px; margin: auto">' +
                '<img class="img-fit" src="' + item.avatar + '">' +
                '</div>' +
                '<p><strong>Địa chỉ: </strong> ' + item.address + '</p>' +
                '<a target="_blank" href="' + item.url + '" id="" class="btn btn_search btn-lg btn-block text-white">' +
                'Xem chi tiết' +
                '</a>' +
                '<div class="link">' +
                '<a target="_blank" href="https://www.google.com/maps/search/?api=1&query=' + item.lat + ',' + item.lng + '">' +
                '<span> View on Google Maps </span> ' +
                '</a>' +
                '</div>' +
                '</div>';


            var marker = new google.maps.Marker({
                animation: google.maps.Animation.DROP,
                icon: icon_agency,
                position: pos,
                map: map
            });
            marker.set("id", item.id);

            marker.addListener('click', function () {
                map.setZoom(18);
                new google.maps.event.trigger(map, 'click');
                marker.setAnimation(google.maps.Animation.BOUNCE);
                map.setCenter(marker.position);
                infowindow.close();
                infowindow.setContent(contentString);
                infowindow.open(map, marker);
            });

            map.addListener('click', function () {
                marker.setAnimation(null);
                infowindow.close(map, marker);
            });
            marker_created.push(marker);
        }

        // thu gọn
        function createClusterer(marker_created) {
            var clusterStyles = [
                {
                    textColor: '#000',
                    url: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m1.png', //small
                    height: 50,
                    width: 50,
                    backgroundPosition: 'center'
                },
                {
                    textColor: '#000',
                    url: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m2.png', //medium
                    height: 50,
                    width: 50,
                    backgroundPosition: 'center'
                },
                {
                    textColor: '#000',
                    url: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m3.png', //large
                    height: 50,
                    width: 50,
                    backgroundPosition: 'center'
                }
            ];

            var mcOptions = {
                gridSize: 20,
                maxZoom: 16,
                zoomOnClick: true,
                styles: clusterStyles
            };
            var mc = new MarkerClusterer(map, marker_created, mcOptions);
        }

        //hàm định vị
        function currentLocation() {
            var currentButton = document.getElementById('find_agency_near');
            google.maps.event.addDomListener(currentButton, 'click', geolocate)
        }

        function geolocate() {
            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    NearestAgency(pos.lat, pos.lng);
                    // current_location.setPosition(pos);
                }, function () {
                    alert('Bật định vị trên trang web này')
                });
            }
            else {
                alert('Bật định vị trên trang web này')
            }
        }

        // tính toán khoảng cách
        var rad = function (x) {
            return x * Math.PI / 180;
        };

        var getDistance = function (p1, p2) {
            var R = 6378137; // Earth’s mean radius in meter
            var dLat = rad(p2.lat() - p1.lat());
            var dLong = rad(p2.lng() - p1.lng());
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
                Math.sin(dLong / 2) * Math.sin(dLong / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            return d; // returns the distance in meter
        };

        function NearestAgency(latitude, longitude) {
            var mindif = 999999999999;
            var key;
            listMarker.forEach(function (item) {
                var p1 = new google.maps.LatLng(latitude, longitude);
                var p2 = new google.maps.LatLng(item.lat, item.lng);
                var dif = getDistance(p1, p2);
                if (dif < mindif) {
                    key = item.id;
                    mindif = dif;
                }
            });
            var latLngNear = new google.maps.LatLng(listMarker[key - 1].lat, listMarker[key - 1].lng);
            // activeAgencyList(key);
            map.setZoom(12);
            map.setCenter(latLngNear);
            new google.maps.event.trigger(marker_created[key - 1], 'click');
        }

    }

    initMap()

});

