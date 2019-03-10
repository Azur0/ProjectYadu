@extends('layouts/app')

@section('content')
<script>
    window.onload = function() {
        var textarea = document.getElementById('desc');
        var text = document.getElementById('title');
        var len_d = parseInt(textarea.getAttribute("maxlength"), 10);
        var len_t = parseInt(text.getAttribute("maxlength"), 10);
        document.getElementById('chars_desc').innerHTML = len_d - textarea.value.length;
        document.getElementById('chars_title').innerHTML = len_t - text.value.length;
    }

    function update_counter_title(text) {
        var len = parseInt(text.getAttribute("maxlength"), 10);
        document.getElementById('chars_title').innerHTML = len - text.value.length;
    }

    function update_counter_desc(textarea) {
        var len = parseInt(textarea.getAttribute("maxlength"), 10);
        document.getElementById('chars_desc').innerHTML = len - textarea.value.length;
    }
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 51.6978162,
                lng: 5.3036748
            },
            zoom: 13,
            mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&libraries=places&callback=initAutocomplete" async defer></script>
<div class="create-event">
    <form action="/events" method="POST">
        @csrf
        <div class="type">
            <h3>1. Kies het type uitje </h3>
            <div class="types">
                <div id="box">
                    @foreach ($tags as $Tag)
                    <input type="radio" id="{{$Tag->tag}}" name="tag" value="{{$Tag->id}}" onclick="check({{$Tag->id }})">
                    <label for="{{$Tag->tag}}" class="category" title="Uitje met gezinnen">
                        <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($Tag->imageDefault) . '"/>'; ?>
                        <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($Tag->imageSelected) . '"/>'; ?>

                        <span>{{$Tag->tag}}</span>
                    </label>
                    @endforeach
                </div>
                @if ($errors->has('tag'))
                <div class="error">Kies een type.</div>
                @endif
            </div>
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script>
            function check(tag) {
                $(".picture").hide();
                $("."+tag).show();
            }
        </script>
        <div class="pic">
            <h3>2. Kies een foto voor je event </h3>
            <div class="types">
                <div id="box">
                    @foreach ($pictures as $picture)
                    <input type="radio" id="{{$picture->id}}" class="picture {{$picture->tag_id}}" name="picture" value="{{$picture->id}}">
                    <label for="{{$picture->id}}" class="picture {{$picture->tag_id}}" title="Uitje met gezinnen">
                        <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($picture->picture) . '"/>'; ?>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="loc">
            <h3>3. Kies de (verzamel)locatie </h3>
            <div class="description location">
                <input id="pac-input" name="location" class="controls" type="text" placeholder="Search Box" required value="{{ old('location') }}">
                <div id="map"></div>
                @if ($errors->has('location'))
                <div class="error">Het locatie-veld is verplicht.</div>
                @endif
            </div>
        </div>
        <div class="date">
            <h3>4. Kies de datum en tijd</h3>
            <div class="description">
                <input id="date" name="startDate" type="datetime-local" value="{{ old('startDate') }}" required>
                @if ($errors->has('startDate'))
                <div class="error">Deze datum/tijd is ongeldig.</div>
                @endif
            </div>
        </div>
        <div>
            <h3>5. Beschrijf je uitje</h3>
            <div class="description">
                <input type="text" id="title" name="activityName" placeholder="Titel" oninput="update_counter_title(this)" maxlength="30" required value="{{ old('activityName') }}">
                <span id="chars_title"></span> characters remaining
                @if ($errors->has('activityName'))
                <div class="error">Het titel-veld is verplicht.</div>
                @endif

                <textarea id="desc" name="description" placeholder="Omschrijving.." oninput="update_counter_desc(this)" maxlength="150" required>{{ old('description') }}</textarea>
                <span id="chars_desc"></span> characters remaining
                @if ($errors->has('description'))
                <div class="error">Het omschrijving-veld is verplicht.</div>
                @endif
            </div>
        </div>
        <div>
            <h3>6. Hoeveel mensen gaan er max mee?</h3>
            <div class="description">
                <input type="number" name="people" min="1" max="25" value="{{ old('people') }}">
                <span class="number_desc">mensen kunnen mee (incl. jezelf)</span>
                @if ($errors->has('people'))
                <div class="error">Het max aantal mensen-veld is verplicht.</div>
                @endif
            </div>
        </div>
        <input class="submit" type="submit" name="verzenden" value="Verzend">
    </form>
</div>
@endsection 