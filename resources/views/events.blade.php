@extends('layouts/app')

@section('banner')

@endsection

@section('content')
    <div class="event_overview row">
        @foreach ($events as $event)

            <div class="col-md-6 col-lg-4 event">
                <a href="/events/{{$event->id}}">
                    {{--<img src={{ asset("images/large.jpg") }} class="img-responsive" width="100%" alt="Event">--}}
                    <img class="default" src="data:image/jpeg;base64, {{base64_encode($event->eventPicture->pictures)}}" class="img-responsive" width="100%" alt="Event"/>
                    <div class="event_info text-truncate">
                        {{-- If your are reading this, it is probably broken. Change activityName to eventName to fix. --}}
                        <h3>{{$event->activityName}}</h3>
                        <p>
                            {{dateToText($event->startDate)}} <br>
                            {{cityFromPostalcode(App\location::where('id', $event->location_id)->firstOrFail()->postalcode) }}
                        </p>
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

function cityFromPostalcode($postalcode){

    if(!isValidPostalcode($postalcode)){
        return "Invalid postal code";
    }

    $url = "https://nominatim.openstreetmap.org/search?q={$postalcode}&format=json&addressdetails=1";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($result, true);
    if(isset($json[0]['address']['suburb'])){
        return $json[0]['address']['suburb'];
    }else{
        return "City not found";
    }
}

function isValidPostalcode($postalcode){
    $regex = '/^([1-8][0-9]{3}|9[0-8][0-9]{2}|99[0-8][0-9]|999[0-9])[a-zA-Z]{2}$/';
    return preg_match($regex,$postalcode);
}


?>
