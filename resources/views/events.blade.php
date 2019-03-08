@extends('layouts/app')

@section('banner')

@endsection

@section('content')
    <div class="event_overview row">
        @foreach ($events as $event)
            <div class="col-md-6 col-lg-4 event">
                <img src={{ asset("images/large.jpg") }} class="img-responsive" width="100%" alt="Event">
                <div class="event_info text-truncate">
                    {{-- If your are reading this, it is probably broken. Change activityName to eventName to fix. --}}
                    <a href="/events/{{$event->id}}"><h3>{{$event->activityName}}</h3></a>
                    <p>{{App\location::where('id', $event->location_id)->firstOrFail()->postalcode }}
                        - {{dateToText($event->startDate)}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<?php

function dateToText($timestamp)
{
    $date = getdate(strtotime($timestamp));
    $formatted_date = dateToDayCode($date) . " ";
    $formatted_date .= $date['mday'] . " ";
    $formatted_date .= dateToMonth($date) . " ";
    $formatted_date .= $date['year'];
    return $formatted_date;
}

function dateToDayCode($date)
{
    //TODO multi-language support
    switch ($date['wday']) {
        case 0:
            $day_code = "Zo";
            break;
        case 1:
            $day_code = "Ma";
            break;
        case 2:
            $day_code = "Di";
            break;
        case 3:
            $day_code = "Wo";
            break;
        case 4:
            $day_code = "Do";
            break;
        case 5:
            $day_code = "Vr";
            break;
        case 6:
            $day_code = "Za";
            break;
        default:
            $day_code = "??";
            break;
    }
    return $day_code;
}

function dateToMonth($date)
{
    //TODO mutli-language support
    switch ($date['month']) {
        case "January":
            $month = "Januari";
            break;
        case "February":
            $month = "Februari";
            break;
        case "March":
            $month = "Maart";
            break;
        case "April":
            $month = "April";
            break;
        case "May":
            $month = "Mei";
            break;
        case "June":
            $month = "Juni";
            break;
        case "July":
            $month = "Juli";
            break;
        case "August":
            $month = "Augustus";
            break;
        case "September":
            $month = "September";
            break;
        case "October":
            $month = "Oktober";
            break;
        case "November":
            $month = "November";
            break;
        case "December":
            $month = "December";
            break;
        default:
            $month = "??";
            break;
    }
    return $month;
}
?>
