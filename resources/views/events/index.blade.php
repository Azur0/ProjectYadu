@extends('layouts.app')

@section('banner')

@endsection

@section('content')
<div class="box-range-value">
    <div id="rangeValueDisplay"></div>
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

<div class="row">
    <div class="col-12">
        <a href="/events/create" class="btn btn-yadu-orange w-100"><i class="fas fa-user-friends"></i> Organiseer een evenement</a>
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

$(document).ready(function() {
    fetch_events();
});

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
                $('#eventsToDisplay').html("<div style='text-align:center; width:100%; padding-top:50px;'><h1>Er kan geen event worden gevonden in uw buurt.</h1><div>");
            } else {
                $('#eventsToDisplay').html("");
                data.forEach(function(element) {
                    $('#eventsToDisplay').html($("#eventsToDisplay").html() +
                        "<div class='col-md-6 col-lg-4 event'><a href='/events/" + element[
                            'id'] +
                        "'><div class='card mb-4 box-shadow'> <img class = 'card-img-top' src ='data:image/jpeg;base64, " +
                        element['picture'] +
                        "' alt = 'Card image cap'><div class = 'event_info' > <h3> " +
                        element['eventName'] + "</h3><p>" + element['date'] +
                        "<br>" + element['loc'] +
                        "</p></div></div></a></div>");

                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#eventsToDisplay').html("<div style='text-align:center; width:100%; padding-top:50px;'><h1>Er kan geen event worden geladen.</h1><div>");
        }
    })

}
</script>
@endsection