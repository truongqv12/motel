$(document).ready(function (listener) {
    // var listMarker = JSON.parse(document.getElementById('data').innerHTML);
    // console.log(listMarker);
    var icon_agency = '/assets/v2/images/icons/agency.png';
    var latLngCenter = new google.maps.LatLng(21.071353178402816, 105.78994989913326);
    var mapDiv = document.getElementById('gmap');
    var map, current_location;
    var service = new google.maps.DistanceMatrixService();
    var geocoder = new google.maps.Geocoder;
    mapDiv.style.width = '100%';
    mapDiv.style.height = '100%';
    var mapOptions = {
        zoom: 7,
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
        // listMarker.forEach(function (item) {
        //     createMarker(item);
        // });
        // createClusterer(marker_created);

        // tạo marker
        function createMarker(item) {
            var pos = new google.maps.LatLng(item.lat, item.lng);
            var contentString = '<div class="container_infobox">' +
                '<h3 class="title text-center">' + item.name + '</h3>' +
                '<p><strong>Địa chỉ: </strong> ' + item.address + '</p>' +
                '<p><strong>Website: </strong> ' + '<a href="' + item.website + '">' + item.website + '</a>' + '</p>' +
                '<a target="_blank" href="https://www.google.com/maps/search/?api=1&query=' + item.lat + ',' + item.lng + '">' +
                '<span> View on Google Maps </span> ' +
                '</a>' +
                '</div>';


            var marker = new google.maps.Marker({
                animation: google.maps.Animation.DROP,
                icon: icon_agency,
                position: pos,
                map: map
            });
            marker.set("id", item.id);

            marker.addListener('click', function () {
                // $('.container_infobox').fadeOut('300');

                // activeAgencyList(marker.id)
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
                // current_location.setMap(null);
                // current_location = new google.maps.Marker({
                //     // icon: icon_my_location,
                //     animation: google.maps.Animation.DROP,
                //     map: map,
                //     draggable: true,
                // });

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

        // currentLocation();
        // $('#agc_city').change(function () {
        //     var id = $(this).val();
        //     var longitude = $(this).find(':selected').attr('data-longitude')
        //     var latitude = $(this).find(':selected').attr('data-latitude')
        //     var latLng = new google.maps.LatLng(latitude, longitude);
        //     ajaxLoadAgency(id);
        //     map.setZoom(12);
        //     map.setCenter(latLng);
        // });

        function ajaxLoadAgency(city_id, district_id = 0) {
            $.ajax({
                type: 'GET',
                url: '/ajax/load-agency',
                data: {
                    city_id: city_id,
                    district_id: district_id,
                },
                success: function (response) {
                    $('#agency_box').html(response);
                    $('#agc_listing').select2();
                    select_agency();
                }
            });
        }

        //chọn đại lý
        function select_agency() {
            $('#agc_listing').change(function () {
                var id = $(this).val();
                var marker = marker_created.find(function(e) {
                    return e.id == id;
                });
                new google.maps.event.trigger(marker, 'click');
            });
        }

        // $('.agency_info_name').click(function (e) {
        //     e.preventDefault();
        //     var id = $(this).data('id');
        //     $('html,body').animate({scrollTop: $("#control_box").offset().top}, 'slow');
        //     var marker = marker_created.find(function(e) {
        //         return e.id == id;
        //     });
        //     new google.maps.event.trigger(marker, 'click');
        // })

        // select_agency();
    }


    initMap()

    // var city_id = $('#agc_city').val();
    // ajaxLoadDistrict(city_id);


    //chọn đại lý
    // $('.select_agency').click(function (e) {
    //     e.preventDefault();
    //     $('.select_agency').removeClass('active');
    //     $(this).addClass('active');
    //     var id = $(this).data('id');
    //     map.setZoom(14);
    //     new google.maps.event.trigger(marker_created[id - 1], 'click');
    // })
    //
    // function activeAgencyList(id) {
    //     $('.select_agency').removeClass('active');
    //     $('.select_agency_' + id).addClass('active');
    // }

    // initMap();

    // function ajaxLoadDistrict(city_id) {
    //     $.ajax({
    //         type: 'GET',
    //         url: '/ajax/load-district',
    //         data: {
    //             city_id: city_id,
    //         },
    //         success: function (response) {
    //             $('.load_district_select').html(response);
    //             var district_id = $("#agc_district option:selected").val();
    //             districtChange();
    //             ajaxLoadAgency(city_id, district_id)
    //         }
    //     });
    // }

    // function districtChange() {
    //     $('#agc_district').change(function () {
    //         var city_id = $('#agc_city').val();
    //         var district_id = $(this).val();
    //         ajaxLoadAgency(city_id, district_id);
    //     });
    // }

});

