@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div>
                <h1>{{$event->eventName}}</h1><br>
                <img class="img-fluid w-100 rounded event_img mb-3"
                     src="data:image/jpeg;base64, {{base64_encode($event->eventPicture->picture)}}"/><br>
                <h3>{{__('events.show_date')}}</h3>
                @php($timestamp = strtotime($event->startDate))
                {{-- TODO: This currently cant be translated --}}
                {{-- TODO: Controller logic in view --}}
                <h5 class="mb-5">{{\App\Http\Controllers\DateTimeController::getDayNames(date("w", $timestamp))}} {{date("d-m-Y", $timestamp)}}
                    om {{date("H:i", $timestamp)}}</h5>
            </div>

            <h3>{{__('events.show_initiator')}}</h3>
            <div class="row my-1">
                <img class="img-fluid rounded-circle my-auto avatar"
                     src="data:image/jpeg;base64, {{base64_encode($event->owner->avatar)}}"/>
                <h5 class="my-auto ml-2">{{$event->owner->firstName .' '. $event->owner->middleName .' '. $event->owner->lastName}}</h5>
            </div>
            <br><br>

            <div class="row">
                <h3>{{__('events.show_attendees')}}</h3>
                @if(Auth::check())
                    @if($event->owner->id != auth()->user()->id)
                        @if($event->participants->contains(auth()->user()->id))
                            <a href="/events/{{$event->id}}/leave"
                               class="btn btn-danger btn-sm my-auto mx-2">{{__('events.show_leave')}}</a>
                        @elseif($event->participants->count() < $event->numberOfPeople)
                            <a href="/events/{{$event->id}}/join"
                               class="btn btn-success btn-sm my-auto mx-2">{{__('events.show_join')}}</a>
                        @endif
                    @endif
                @endif
            </div>
            <p class="text-md-right">{{__('events.show_number_of_attendees', ['amount' => $event->participants->count(), 'max' => $event->numberOfPeople])}}</p>
            <div class="progress">
                <div class="progress-bar" role="progressbar"
                     style="width: {{$event->participants->count() / $event->numberOfPeople * 100}}%" aria-valuemin="0"
                     aria-valuenow="{{$event->participants->count()}}" aria-valuemax="{{$event->numberOfPeople}}"></div>
            </div>
            @foreach($event->participants as $participant)
                <div class="row my-1">
                    <img class="img-fluid rounded-circle my-auto avatar"
                         src="data:image/jpeg;base64, {{base64_encode($participant->avatar)}}"/>
                    <h5 class="my-auto ml-2">{{$participant->firstName .' '. $participant->middleName .' '. $participant->lastName}}</h5>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            {{--TODO: Add map API--}}
            <h3>{{__('events.show_location')}}</h3>
            <h5>{{$event->location()->first()->postalcode}} {{$event->location()->first()->houseNumber}}{{$event->location()->first()->houseNumberAddition}}</h5>
            <div id="map" class="rounded event_map"></div>
            <script>
                var map;

                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {
                            lat: {{$event->location()->first()->locLatitude}},
                            lng: {{$event->location()->first()->locLongtitude}}},
                        zoom: 12
                    });

                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng({{$event->location()->first()->locLatitude}}, {{$event->location()->first()->locLongtitude}}),
                        map: map,
                        title: '{{$event->eventName}}'
                    });

                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&callback=initMap"
                    async defer></script>
            <div class="mb-5">
                <h3>{{__('events.show_description')}}</h3>
                <p>{{$event->description}}</p>
            </div>

            {{--Start section Share buttons--}}
            <div class="mb-5">
                <h3>{{__('events.show_share')}}</h3>
                <div>
                    <a id="share-whatsapp" class="fab fa-whatsapp" style="font-size: 36px; color: #E79535; margin-right: 2%; margin-bottom: 50px; cursor: pointer; text-decoration: none;"></a>
                    <a id="share-facebook" class="fab fa-facebook" style="font-size: 36px; color: #E79535; margin-right: 2%; margin-bottom: 50px; cursor: pointer; text-decoration: none;"></a>
                    <a id="share-twitter" class="fab fa-twitter" style="font-size: 36px; color: #E79535; margin-right: 2%; margin-bottom: 50px; cursor: pointer; text-decoration: none;"></a>
                    <a id="share-instagram" class="fab fa-instagram" style="font-size: 36px; color: #E79535; margin-right: 2%; margin-bottom: 50px; cursor: pointer; text-decoration: none;"></a>
                    <a id="share-link" class="fa fa-link" data-toggle="modal" data-target="#confirmDeleteAccount" style="font-size: 36px; color: #E79535; margin-right: 2%; margin-bottom: 50px; cursor: pointer; text-decoration: none;"></a>
                </div>
            </div>

            <div class="modal fade" id="confirmDeleteAccount" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('events.show_share_link')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <a id="page-url"></a>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('events.show_share_close')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById("share-link").addEventListener('click', function(){
                    let clipboard = document.createElement('input'),
                        url = window.location.href;

                    document.body.appendChild(clipboard);
                    clipboard.value = url;
                    clipboard.select();
                    document.execCommand('copy');
                    document.body.removeChild(clipboard);

                    document.getElementById("page-url").innerHTML = url;
                });

                document.getElementById("share-facebook").addEventListener('click', function(){
                    let url = `https://www.facebook.com/sharer/sharer.php?u=${window.location.href}`;
                    window.open(url,'popUpWindow','height=500,width=700,left=400,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
                });

                document.getElementById("share-twitter").addEventListener('click', function(){
                    let url = `https://twitter.com/intent/tweet?text={{$event->eventName}}: ${window.location.href} %23Yadu`;
                    window.open(url,'popUpWindow','height=500,width=700,left=400,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
                });
            </script>

            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v3.2"></script>
            {{--End section Share buttons--}}

        </div>
    </div>

@endsection