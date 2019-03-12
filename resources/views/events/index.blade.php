@extends('layouts.app')

@section('banner')

@endsection

@section('content')

    <div class="row">
    <div class="col-12">
        <a href="/events/create" class="btn btn-yadu-orange w-100"><i class="fas fa-user-friends"></i> Organiseer een evenement</a>
    </div>
    </div>

    <div class="event_overview row">
        @foreach ($events as $event)
            <div class="col-md-6 col-lg-4 event">
                <a href="/events/{{$event->id}}">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                             src="data:image/jpeg;base64, {{base64_encode($event->eventPicture->picture)}}"
                             alt="Card image cap">
                        <div class="event_info">
                            <h3>{{$event->eventName}}</h3>
                            <p>
                                {{dateToText($event->startDate)}} <br>
                                {{cityFromPostalcode(App\location::where('id', $event->location_id)->firstOrFail()->postalcode) }}
                            </p>
                        </div>
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

function cityFromPostalcode($postalcode)
{
    if (!isValidPostalcode($postalcode)) {
        return "Invalid postal code";
    }

    $url = "https://nominatim.openstreetmap.org/search?q={$postalcode}&format=json&addressdetails=1";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($result, true);
    if (isset($json[0]['address']['suburb'])) {
        return $json[0]['address']['suburb'];
    } else {
        return "City not found";
    }
}

function isValidPostalcode($postalcode)
{
    $regex = '/^([1-8][0-9]{3}|9[0-8][0-9]{2}|99[0-8][0-9]|999[0-9])[a-zA-Z]{2}$/';
    return preg_match($regex, $postalcode);
}
?>
