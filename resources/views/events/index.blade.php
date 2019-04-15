@extends('layouts.app')

@section('banner')

@endsection

@section('content')

<div class="slideContainer">
<div style="width:90%; margin:auto;">
<div class="box-range-value" id="box-move-with-distance">
    <div id="rangeValueDisplay"></div>
</div>
</div>
    <input type="range" ticks="[5, 10, 15, 20, 25]" min="5" max="25" step="5" value="20" class="slider" id="rangeValue">
    <div class="labels">
        <label class="rangeTextLeft">5 KM</label>
        <label class="rangeTextCenter">10 KM</label>
        <label class="rangeTextCenter">15 KM</label>
        <label class="rangeTextCenter">20 KM</label>
        <label class="rangeTextRight"> > </label>
    </div>
    <div class="search">
        <label for="filterByTag">Kies een categorie:</label>
        <input oninput="fetch_events()" list="tags" id="filterByTag" name="filterByTag" />
        <datalist id="tags">
            @foreach ($tags as $tag)
            <option value="{{$tag}}">
                @endforeach
        </datalist>
        <label for="filterByName">Zoek op naam:</label>
        <input oninput="fetch_events()" list="names" id="filterByName" name="filterByName" autocomplete="off"/>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <a href="/events/create" class="btn btn-yadu-orange w-100"><i class="fas fa-user-friends"></i> Organiseer een
            evenement</a>
    </div>
</div>

<div class="event_overview row" id="eventsToDisplay">
    <img class='loadingSpinner' src='images/Spinner-1s-200px.gif'>
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
    document.getElementById("box-move-with-distance").style.transform = "translate(-"+((((this.value/5)-1)*10)+5)+"px) rotate(-136deg)";
    document.getElementById("box-move-with-distance").style.margin = "0 0 0 "+((((this.value/5)-1)*25))+"%";
   
    fetch_events();
};

$(document).ready(function() {
    fetch_events();
    document.getElementById("box-move-with-distance").style.transform = "translate(-"+((((slider.value/5)-1)*10)+5)+"px) rotate(-136deg)";
    document.getElementById("box-move-with-distance").style.margin = "0 0 0 "+((((slider.value/5)-1)*25))+"%";
   
});

//AJAX request
function fetch_events() {
    $('#eventsToDisplay').html("<img class='loadingSpinner' src='images/Spinner-1s-200px.gif'>");
    var distance;
    distance = $("#rangeValue").val();
    var inputTag = $(filterByTag).val();
    var inputName = $(filterByName).val();
    $.ajax({
        url: "{{ route('events_controller.actionDistanceFilter')}}",
        method: 'POST',
        data: {
            distance: distance,
            inputTag: inputTag,
            inputName: inputName,
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data == "") {
                $('#eventsToDisplay').html(
                    "<div style='text-align:center; width:100%; padding-top:50px;'><h1>Er kan geen event worden gevonden in uw buurt.</h1><div>"
                );
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
            $('#eventsToDisplay').html(
                "<div style='text-align:center; width:100%; padding-top:50px;'><h1>Er kan geen event worden geladen.</h1><div>"
            );
        }
    })

}
</script>
@endsection