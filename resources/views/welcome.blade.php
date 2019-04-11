@extends('layouts/app')

@section('content')
    <div class="col-md-6">
        <div id="map" class="rounded" style="width: 1000px; height: 500px;"></div>
        <script>
            var map;

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: 52,
                        lng: 5.6
                    },
                    zoom: 7
                });

                var features = [
                    @foreach($events as $event)
                        @if($event->location()->first()->locLatitude != null && $event->location()->first()->locLongtitude != null)
                            {
                                position: new google.maps.LatLng({{$event->location()->first()->locLatitude}}, {{$event->location()->first()->locLongtitude}}),
                                title: '{{$event->eventName}}',
                                url: "{{url("/events") . "/" . $event->id}}"
                            },
                        @endif
                    @endforeach
                ];

                // Create markers.
                for (var i = 0; i < features.length; i++) {
                    var marker = new google.maps.Marker({
                        position: features[i].position,
                        title: features[i].title,
                        url: features[i].url,
                        map: map
                    });
                    marker.addListener('click', function() {
                        window.location.href = this.url;
                    });
                };



            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&callback=initMap"
                async defer></script>
    </div>
@endsection
