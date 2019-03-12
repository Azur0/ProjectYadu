@extends('layouts/app')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div>
                <h1>{{$event->activityName}}</h1><br>
                <img class="img-fluid w-100" src="data:image/jpeg;base64, {{base64_encode($event->eventPicture->picture)}}"/><br>
                {{$event->startDate}} <br><br>
            </div>

            <h3>Initiatiefnemer</h3>
            <div class="row my-1">
                <?php echo '<img class="img-fluid rounded-circle" width="50" class="my-auto" src="data:image/jpeg;base64,' . base64_encode($event->owner->avatar) . '"/>'; ?>
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
                        @else
                            <a href="/events/{{$event->id}}/join"
                               class="btn btn-success btn-sm my-auto mx-2">Aanmelden</a>
                        @endif
                    @endif
                @endif
            </div>
            @foreach($event->participants as $participant)
                <div class="row my-1">
                    <?php echo '<img class="img-fluid rounded-circle" width="50" class="my-auto" src="data:image/jpeg;base64,' . base64_encode($participant->avatar) . '"/>'; ?>
                    <h5 class="my-auto ml-2">{{$participant->firstName .' '. $participant->middleName .' '. $participant->lastName}}</h5>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            {{--TODO: Add map API--}}
            <div id="map" class="rounded"></div>
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
    </div>
@endsection