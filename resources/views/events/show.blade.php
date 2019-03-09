@extends('layouts/app')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div style="background-image: url();">
                <h1>{{$event->activityName}}</h1><br>
                <img class="img-fluid" src="https://via.placeholder.com/4000x2000s.jpg"/><br>
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
                @if($event->participants->contains(5)) {{--TODO: Change the 5 to the id of the active account--}}
                <a href="/events/{{$event->id}}/leave" class="btn btn-danger btn-sm my-auto mx-2">Afmelden</a>
                @else
                    <a href="/events/{{$event->id}}/join" class="btn btn-success btn-sm my-auto mx-2">Aanmelden</a>
                @endif
            </div>
            @foreach($event->participants as $participant)
                <div class="row my-1">
                    <?php echo '<img class="img-fluid rounded-circle" width="50" class="my-auto" src="data:image/jpeg;base64,' . base64_encode($participant->avatar) . '"/>'; ?>
                    <h5 class="my-auto ml-2">{{$participant->firstName .' '. $participant->middleName .' '. $participant->lastName}}</h5>
                </div>
            @endforeach
        </div>
        <div class="col-md-6" style="background: #3f9ae5">
            {{--TODO: Add map API--}}
        </div>
    </div>
@endsection