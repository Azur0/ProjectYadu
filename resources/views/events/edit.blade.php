@extends('layouts/app')

@section('content')

<div class="create-event">
    <form action="/events/{{$data['event']->id}}" method="POST">
        @method("PATCH")
        @csrf
        <div class="type">
            <h3 style="display: inline">1. {{__('events.create_step1')}} </h3>
            <div class="CSH_tooltip">
                <i class="fas fa-question-circle"></i>
                <span class="tooltiptext">{{__('events.CSH_step1')}}</span>
            </div>
            <div class="types">
                <div class="box">
                    @foreach ($data['tags'] as $tag)
                    <input type="radio" id="{{$tag->tag}}" name="tag" value="{{$tag->id}}"
                        onclick="check({{$tag->id }})" @if($tag->id == $data["event"]->tag_id)
                    @php($selectedTag = $tag)
                    checked
                    @endif
                    >
                    <label for="{{$tag->tag}}" class="category" title="Uitje met gezinnen">
                        <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '"/>'; ?>
                        <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '"/>'; ?>
                        <span>{{$tag->tag}}</span>
                    </label>
                    @endforeach
                </div>
                @if ($errors->has('tag'))
                <div class="error">{{__('events.create_error_select_type')}}.</div>
                @endif
            </div>
        </div>

        <div class="pic">
            <h3 style="display: inline">2. {{__('events.create_step2')}} </h3>
            <div class="CSH_tooltip">
                <i class="fas fa-question-circle"></i>
                <span class="tooltiptext">{{__('events.CSH_step2')}}</span>
            </div>
            <div class="types">
                <div id="box2" class="box">
                    @foreach($selectedTag->eventPictures()->get() as $picture)
                    <input type='radio' id='{{$picture->id}}' class='picture {{$picture->id}}' name='picture'
                        value='{{$picture->id}}' @if($picture->id == $data["event"]->event_picture_id)
                    checked
                    @endif
                    >
                    <label for='{{$picture->id}}' class='picture {{$picture->id}}'>
                        <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($picture->picture) . '"/>'; ?>
                    </label>
                    @endforeach
                </div>
                @if ($errors->has('picture'))
                <div class="error">{{__('events.create_error_select_photo')}}</div>
                @endif
            </div>
        </div>

        <div class="loc">
            <h3 style="display: inline">3. {{__('events.create_step3')}} </h3>
            <div class="CSH_tooltip">
                <i class="fas fa-question-circle"></i>
                <span class="tooltiptext">{{__('events.CSH_step3')}}</span>
            </div>
            <div class="description location">
                <input type="hidden" name="lng" id="lng" value="{{$data['event']->location()->first()->locLongtitude}}">
                <input type="hidden" name="lat" id="lat" value="{{$data['event']->location()->first()->locLatitude}}">
                <input type="hidden" name="houseNumber" id="houseNumber"
                    value="{{$data['event']->location()->first()->houseNumber}}">
                <input type="hidden" name="postalCode" id="postalCode"
                    value="{{$data['event']->location()->first()->postalcode}}">
                <input type="hidden" name="locality" id="locality"
                    value="{{$data['event']->location()->first()->locality}}">
                <input type="hidden" name="route" id="route" value="{{$data['event']->location()->first()->route}}">

                <input id="pac-input" name="location" class="controls" type="text" placeholder="Search Box" required
                    @if(old('location')==null)
                    value="{{ $data['event']->location()->first()->route }} {{ $data['event']->location()->first()->houseNumber }}, {{ $data['event']->location()->first()->locality }}"
                    @else value="{{old('location')}}" @endif>
                <div id="map"></div>
                @if ($errors->has('lat'))
                <div class="error">{{__('events.create_error_location_required')}}</div>
                @endif
                @if ($errors->has('houseNumber'))
                <div class="error">{{__('events.create_error_house_number')}}</div>
                @endif
                @if ($errors->has('postalCode'))
                <div class="error">{{__('events.create_error_postalcode')}}</div>
                @endif
            </div>
        </div>
        <div class="date">
            <h3 style="display: inline">4. {{__('events.create_step4')}}</h3>
            <div class="CSH_tooltip">
                <i class="fas fa-question-circle"></i>
                <span class="tooltiptext">{{__('events.CSH_step4')}}</span>
            </div>
            <div class="description">
                <h5>{{__('events.create_date')}}</h5>
                <input id="date" name="startDate" type="date" value="{{ $data['event']->startDate }}" required>
                <h5>{{__('events.create_time')}}</h5>
                <input id="date" name="startTime" type="time" value="{{ $data['event']->startTime }}" required>
                @if ($errors->has('startDate'))
                <div class="error">{{__('events.create_error_invalid_datetime')}}</div>
                @endif
            </div>
        </div>
        <div>
            <h3 style="display: inline">5. {{__('events.create_step5')}}</h3>
            <div class="CSH_tooltip">
                <i class="fas fa-question-circle"></i>
                <span class="tooltiptext">{{__('events.CSH_step5')}}</span>
            </div>
            <div class="description">
                <input type="text" id="title" name="activityName" placeholder="{{__('events.create_title')}}"
                    oninput="update_counter_title(this)" maxlength="30" required
                    value="{{ $data['event']->eventName }}">
                <span id="chars_title"></span> {{__('events.create_characters_remaining')}}
                @if ($errors->has('activityName'))
                <div class="error">{{__('events.create_error_title_required')}}</div>
                @endif

                <textarea id="desc" name="description" placeholder="{{__('events.create_description')}}" oninput="update_counter_desc(this)"
                    maxlength="150" required>{{ $data['event']->description }}</textarea>
                <span id="chars_desc"></span> {{__('events.create_characters_remaining')}}
                @if ($errors->has('description'))
                <div class="error">{{__('events.create_error_description_required')}}</div>
                @endif
            </div>
        </div>
        <div>
            <h3 style="display: inline">6. {{__('events.create_step6')}}</h3>
            <div class="CSH_tooltip">
                <i class="fas fa-question-circle"></i>
                <span class="tooltiptext">{{__('events.CSH_step6')}}</span>
            </div>
            <div class="description">
                <input type="number" name="numberOfPeople" min="1" max="25"
                    value="{{ $data['event']->numberOfPeople }}">
                <span class="number_desc">{{__('events.create_amount_of_participants')}}</span>
                @if ($errors->has('numberOfPeople'))
                <div class="error">{{__('events.create_error_max_participants_required')}}</div>
                @endif
            </div>
        </div>
        <input class="submit" type="submit" name="verzenden" value="{{__('events.create_submit')}}">
    </form>
</div>
<script>
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
        success: function(data) {
            if (data == "") {
                $('#box2').html("<h5><i>{{__('events.create_select_type_first')}}</i></h5>");
            } else {
                $('#box2').html("");
                data.forEach(function(element) {
                    $('#box2').html($("#box2").html() + "<input type='radio' id='" +
                        element['id'] + "' class='picture " + element['tag_id'] +
                        "' name='picture' value='" + element['id'] + "'> <label for='" +
                        element['id'] + "' class='picture " + element['tag_id'] +
                        "' title='Uitje met gezinnen'> <img class='default' src='data:image/jpeg;base64," +
                        element['picture'] + "'/> </label>");
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
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
function initAutocomplete() {
    var Eventlat = <?php echo $data['event']->location()->first()->locLatitude ?>;
    var Eventlng = <?php echo $data['event']->location()->first()->locLongtitude ?>;
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: Eventlat,
            lng: Eventlng
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
    var myLatlng = new google.maps.LatLng(Eventlat, Eventlng);

    var marker = new google.maps.Marker({
        position: myLatlng,
        title: "Hello World!"
    });

    marker.setMap(map);
    markers.push(marker);
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

            var myAddressNumber = "";
            var myPostalCode = "";
            var myRoute = "";
            var myLocality = "";
            for (i = 0; i < place.address_components.length; i++) {
                if (place.address_components[i].types == "street_number") {
                    myAddressNumber = place.address_components[i].long_name;
                } else if (place.address_components[i].types == "postal_code") {
                    myPostalCode = place.address_components[i].long_name;
                } else if (place.address_components[i].types[0] == "locality") {
                    myLocality = place.address_components[i].long_name;
                } else if (place.address_components[i].types == "route") {
                    myRoute = place.address_components[i].long_name;
                }
            }

            $('#lng').val(place.geometry.location.lng);
            $('#lat').val(place.geometry.location.lat);

            $('#houseNumber').val(myAddressNumber);
            $('#postalCode').val(myPostalCode);
            $('#route').val(myRoute);
            $('#locality').val(myLocality);

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
    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&libraries=places&callback=initAutocomplete"
    async defer></script>
@endsection