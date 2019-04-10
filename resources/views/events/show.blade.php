@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div>
                <h1>{{$event->eventName}}</h1><br>
                <img class="img-fluid w-100 rounded event_img mb-3"
                     src="data:image/jpeg;base64, {{base64_encode($event->eventPicture->picture)}}"/><br>
                <h3>Wanneer?</h3>
                @php($timestamp = strtotime($event->startDate))
                <h5 class="mb-5">{{\App\Http\Controllers\DateTimeController::getDayNames(date("w", $timestamp))}} {{date("d-m-Y", $timestamp)}}
                    om {{date("H:i", $timestamp)}}</h5>
            </div>

            <h3>Initiatiefnemer</h3>
            <div class="row my-1">
                <img class="img-fluid rounded-circle my-auto avatar"
                     src="data:image/jpeg;base64, {{base64_encode($event->owner->avatar)}}"/>
                <h5 class="my-auto ml-2">{{$event->owner->firstName .' '. $event->owner->middleName .' '. $event->owner->lastName}}</h5>
            </div>
            <br><br>

            <div class="row">
                <h3>Wie gaan er mee?</h3>
                @if(Auth::check())
                    @if($event->owner->id != auth()->user()->id)
                        @if($event->participants->contains(auth()->user()->id))
                            <a href="/events/{{$event->id}}/leave"
                               class="btn btn-danger btn-sm my-auto mx-2">Afmelden</a>
                        @elseif($event->participants->count() < $event->numberOfPeople)
                            <a href="/events/{{$event->id}}/join"
                               class="btn btn-success btn-sm my-auto mx-2">Aanmelden</a>
                        @endif
                    @endif
                @endif
            </div>
            <p class="text-md-right">{{$event->participants->count()}} deelnemers van de {{$event->numberOfPeople}}</p>
            <div class="progress">
                <div class="progress-bar" role="progressbar"
                     style="width: {{$event->participants->count() / $event->numberOfPeople * 100}}%" aria-valuemin="0"
                     aria-valuenow="{{$event->participants->count()}}" aria-valuemax="{{$event->numberOfPeople}}"></div>
            </div>
            @foreach($event->participants as $participant)
                <div class="row my-1">
                    <img class="img-fluid rounded-circle my-auto avatar"
                         src="data:image/jpeg;base64, {{base64_encode($participant->avatar)}}"/>
                    <h5 class="my-auto ml-2">{{$participant->firstName .' '. $participant->middleName .' '. $participant->lastName}}</h5>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            {{--TODO: Add map API--}}
            <h3>Waar?</h3>
            <h5>{{$event->location()->first()->postalcode}} {{$event->location()->first()->houseNumber}}{{$event->location()->first()->houseNumberAddition}}</h5>
            <div id="map" class="rounded event_map"></div>
            <script>
                var map;

                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {
                            lat: {{$event->location()->first()->locLatitude}},
                            lng: {{$event->location()->first()->locLongtitude}}},
                        zoom: 12
                    });

                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng({{$event->location()->first()->locLatitude}}, {{$event->location()->first()->locLongtitude}}),
                        map: map,
                        title: '{{$event->eventName}}'
                    });

                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&callback=initMap"
                    async defer></script>
            <p>{{$event->location()->first()->postalcode}} {{$event->location()->first()->houseNumber}}{{$event->location()->first()->houseNumberAddition}}</p>
            <div class="mb-5">
                <h3>Beschrijving</h3>
                <p>{{$event->description}}</p>
            </div>
        </div>
    </div>

@endsection