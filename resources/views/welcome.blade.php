@extends('layouts/app')

@section('content')
    <div class="col-md-6">
        {{--TODO: Add map API--}}
        <h3>Kaart</h3>
        <div id="map" class="rounded event_map"></div>
        <script>
            var map;

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 52.1037242, lng: 5.5593545},
                    zoom: 7
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&callback=initMap"
                async defer></script>
    </div>
@endsection
