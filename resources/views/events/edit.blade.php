@extends('layouts/app')

@section('content')

    <div class="create-event">
        <form action="/events/{{$data['event']->id}}" method="POST">
            @method("PATCH")
            @csrf
            <div class="type">
                <h3>1. Kies het type event </h3>
                <div class="types">
                    <div class="box">
                        @foreach ($data['tags'] as $tag)
                            @if($tag->id == $data["event"]->tag_id)
                                <input type="radio" id="{{$tag->tag}}" name="tag" value="{{$tag->id}}"
                                       onclick="check({{$tag->id }})" checked>
                                {{--<script>check({{$tag->id}})</script> TODO:run check script--}}
                            @else
                                <input type="radio" id="{{$tag->tag}}" name="tag" value="{{$tag->id}}"
                                       onclick="check({{$tag->id }})">
                            @endif
                            <label for="{{$tag->tag}}" class="category" title="Uitje met gezinnen">
                                <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '"/>'; ?>
                                <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '"/>'; ?>
                                <span>{{$tag->tag}}</span>
                            </label>
                        @endforeach
                    </div>
                    @if ($errors->has('tag'))
                        <div class="error">Kies een type.</div>
                    @endif
                </div>
            </div>

            <div class="pic">
                <h3>2. Kies een foto voor je event </h3>
                <div class="types">
                    <div id="box2" class="box">

                    </div>
                    @if ($errors->has('picture'))
                        <div class="error">Kies een foto.</div>
                    @endif
                </div>
            </div>

            <div class="loc">
                <h3>3. Kies de (verzamel)locatie </h3>
                <div class="description location">
                    <input id="pac-input" name="location" class="controls" type="text" placeholder="Search Box" required
                           value="{{ $data['event']->location()->first()->postalcode }} {{ $data['event']->location()->first()->houseNumber }}{{ $data['event']->location()->first()->houseNumberAddition }}">
                    <div id="map"></div>
                    @if ($errors->has('location'))
                        <div class="error">Het locatie-veld is verplicht.</div>
                    @endif
                </div>
            </div>
            <div class="date">
                <h3>4. Kies de datum en tijd</h3>
                <div class="description">
                    <input id="date" name="startDate" type="datetime-local" value="{{ $data['event']->startDate }}"
                           required>
                    @if ($errors->has('startDate'))
                        <div class="error">Deze datum/tijd is ongeldig.</div>
                    @endif
                </div>
            </div>
            <div>
                <h3>5. Beschrijf je uitje</h3>
                <div class="description">
                    <input type="text" id="title" name="activityName" placeholder="Titel"
                           oninput="update_counter_title(this)" maxlength="30" required
                           value="{{ $data['event']->eventName }}">
                    <span id="chars_title"></span> characters remaining
                    @if ($errors->has('activityName'))
                        <div class="error">Het titel-veld is verplicht.</div>
                    @endif

                    <textarea id="desc" name="description" placeholder="Omschrijving.."
                              oninput="update_counter_desc(this)"
                              maxlength="150" required>{{ $data['event']->description }}</textarea>
                    <span id="chars_desc"></span> characters remaining
                    @if ($errors->has('description'))
                        <div class="error">Het omschrijving-veld is verplicht.</div>
                    @endif
                </div>
            </div>
            <div>
                <h3>6. Hoeveel mensen gaan er max mee?</h3>
                <div class="description">
                    <input type="number" name="numberOfPeople" min="1" max="25"
                           value="{{ $data['event']->numberOfPeople }}">
                    <span class="number_desc">mensen kunnen mee (incl. jezelf)</span>
                    @if ($errors->has('numberOfPeople'))
                        <div class="error">Het max aantal mensen-veld is verplicht.</div>
                    @endif
                </div>
            </div>
            <input class="submit" type="submit" name="verzenden" value="Verzend">
        </form>
    </div>
    <script>
        $(document).ready(function () {
            fetch_customer_data();
        });

        function check(tag) {
            fetch_customer_data(tag);
        }

        function fetch_customer_data(query) {
            $.ajax({
                url: "{{ route('events_controller.action')}}",
                method: 'POST',
                data: {
                    query: query,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data == "") {
                        $('#box2').html("<h5><i>Kies eerst het type event</i></h5>");
                    } else {
                        $('#box2').html("");
                        data.forEach(function (element) {
                            //TODO: add if statement if element tag equals tag in given event add "checked"
                            $('#box2').html($("#box2").html() + "<input type='radio' id='" +
                                element['id'] + "' class='picture " + element['tag_id'] +
                                "' name='picture' value='" + element['id'] + "'> <label for='" +
                                element['id'] + "' class='picture " + element['tag_id'] +
                                "' title='Uitje met gezinnen'> <img class='default' src='data:image/jpeg;base64," +
                                element['picture'] + "'/> </label>");
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
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
    <script>
        function update_counter_title(text) {
            var len = parseInt(text.getAttribute("maxlength"), 10);
            document.getElementById('chars_title').innerHTML = len - text.value.length;
        }

        function update_counter_desc(textarea) {
            var len = parseInt(textarea.getAttribute("maxlength"), 10);
            document.getElementById('chars_desc').innerHTML = len - textarea.value.length;
        }


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
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
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
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&libraries=places&callback=initAutocomplete"
            async defer></script>
@endsection