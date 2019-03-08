@extends('layouts/app')

@section('banner')

@endsection

@section('content')
    <div class="event_overview row">
        @foreach ($events as $event)

            <div class="col-md-6 col-lg-4 event">
                <a href="/events/{{$event->id}}">
                    <img src={{ asset("images/large.jpg") }} class="img-responsive" width="100%" alt="Event">
                    <div class="event_info text-truncate">
                        {{-- If your are reading this, it is probably broken. Change activityName to eventName to fix. --}}
                        <h3>{{$event->activityName}}</h3>
                        <p>{{App\location::where('id', $event->location_id)->firstOrFail()->postalcode }}
                            - {{dateToText($event->startDate)}}</p>
                    </div>
                </a>
            </div>

        @endforeach
    </div>
@endsection

<?php

function dateToText($timestamp)
{
    setlocale(LC_ALL, 'nl_NL.utf8');
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp);
    $formatted_date = ucfirst($date->formatLocalized('%a %d %B %Y'));
    return $formatted_date;
}

?>
