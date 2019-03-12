@extends('layouts.app')

@section('banner')

@endsection

@section('content')
<div class="box-range-value">
    <div id="rangeValueDisplay">
    </div>
</div>
<div class="slideContainer">
    <input type="range" ticks="[5, 10, 15, 20, 25]" min="5" max="25" step="5" value="20" class="slider" id="rangeValue">
    <div class="labels">
        <label class="rangeTextLeft">5 KM</label>
        <label class="rangeTextCenter">10 KM</label>
        <label class="rangeTextCenter">15 KM</label>
        <label class="rangeTextCenter">20 KM</label>
        <label class="rangeTextRight"> > </label>
    </div>
</div>
<div class="event_overview row" id="eventsToDisplay">
</div>

<script type="text/javascript">
var slider = document.getElementById("rangeValue");
var val = document.getElementById("rangeValueDisplay");
val.innerHTML = slider.value;
slider.oninput = function() {
    if (25 == slider.value) {
        val.innerHTML = "∞";
    } else {
        val.innerHTML = this.value;
    }
    fetch_events();
};



//AJAX request
function fetch_events() {
    //alert('test');
    var distance;
    distance = $("#rangeValue").val();
    $.ajax({
        url: "{{ route('events_controller.actionDistanceFilter')}}",
        method: 'POST',
        data: {
            distance: distance,
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data == "") {
                $('#eventsToDisplay').html("<p>error</p>");
            } else {
                $('#eventsToDisplay').html("");
                data.forEach(function(element) {
                    $('#eventsToDisplay').html($("#eventsToDisplay").html() +
                        "<div class='col-md-6 col-lg-4 event'><a href='/events/" + element[
                            'id'] +
                        "'><div class='card mb-4 box-shadow'><div class='event_info'><h3>" +
                        element['eventName'] + "</h3><p>" + element['startDate'] +
                        " <br>3971NK</p></div></div></a></div>");

                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(
                'An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!'
            );

            $('#result').html('<p>status code: ' + jqXHR.status + '</p><p>errorThrown: ' +
                errorThrown +
                '</p><p>jqXHR.responseText:</p><div>' + jqXHR.responseText + '</div>');
            console.log('jqXHR:');
            console.log(jqXHR);
            console.log('textStatus:');
            console.log(textStatus);
            console.log('errorThrown:');
            console.log(errorThrown);
        }
    })

}
</script>
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