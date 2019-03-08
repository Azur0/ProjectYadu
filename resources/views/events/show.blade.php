@extends('layouts/app')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div style="background-image: url();">
                <h1>{{$event->activityName}}</h1><br>
                {{$event->startDate}} <br><br>
            </div>

            <h3>Initiatiefnemer</h3>
            <h5>{{$event->owner->firstName .' '. $event->owner->middleName .' '. $event->owner->lastName}}</h5>

            <h3>Wie gaan er mee?</h3>
            @foreach($event->participants as $participant)
                <h5>{{$participant->firstName .' '. $participant->middleName .' '. $participant->lastName}}</h5>
            @endforeach

            <a href="/events/{{$event->id}}/join" class="btn btn-success">Join</a>

        </div>

        <div class="col-md-6">

        </div>
    </div>
@endsection