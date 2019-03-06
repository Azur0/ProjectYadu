@extends('layouts/app')

@section('banner')

@endsection

@section('content')
    <div class="event_overview">
        <?php
        $i = 0;
        $size =  count($events);

        foreach ($events as $event){
        $i++;
        if ($i % 3 == 1) {
            echo "<div class=\"row\">";
        }
        ?>

        <div class="col-4 event">
            <img src={{ asset("images/beer.jpg") }} class="img-responsive" width="100%" alt="Event">
            <div class="event_info">
                <h3>{{$event->activityName}}</h3>
            </div>
        </div>

        <?php
        if ($i % 3 == 0 || $size == $i) {
            echo "</div><br>";
        }
        }
        ?>


    </div>
@endsection
