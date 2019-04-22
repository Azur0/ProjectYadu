@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div>
                <h1>{{$event->eventName}}</h1><br>
                <img class="img-fluid w-100 rounded event_img mb-3"
                     src="data:image/jpeg;base64, {{base64_encode($event->eventPicture->picture)}}"/><br>
                <h3>Wanneer?</h3>
                @php($timestamp = strtotime($event->startDate))
                <h5 class="mb-5">{{\App\Http\Controllers\DateTimeController::getDayNames(date("w", $timestamp))}} {{date("d-m-Y", $timestamp)}}
                    om {{date("H:i", $timestamp)}}</h5>
            </div>

            <h3>Initiatiefnemer</h3>
            <div class="row my-1">
                <img class="img-fluid rounded-circle my-auto avatar"
                     src="data:image/jpeg;base64, {{base64_encode($event->owner->avatar)}}"/>
                <h5 class="my-auto ml-2">{{$event->owner->firstName .' '. $event->owner->middleName .' '. $event->owner->lastName}}</h5>
            </div>
            <br><br>

            <div class="row">
                <h3>Wie gaan er mee?</h3>
                @if(Auth::check())
                    @if($event->owner->id != auth()->user()->id)
                        @if($event->participants->contains(auth()->user()->id))
                            <a href="/events/{{$event->id}}/leave"
                               class="btn btn-danger btn-sm my-auto mx-2">Afmelden</a>
                        @elseif($event->participants->count() < $event->numberOfPeople)
                            <a href="/events/{{$event->id}}/join"
                               class="btn btn-success btn-sm my-auto mx-2">Aanmelden</a>
                        @endif
                    @endif
                @endif
            </div>
            <p class="text-md-right">{{$event->participants->count()}} deelnemers van de {{$event->numberOfPeople}}</p>
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
            <h3>Waar?</h3>
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
                <h3>Beschrijving</h3>
                <p>{{$event->description}}</p>
            </div>
        </div>
    </div>

    <!-- BEGIN CHAT TEMPLATE -->

    <div id="app" class="message-container clearfix" v-if="account">
        <div class="people-list" id="people-list">
            <div class="search">
                <input type="text" placeholder="search" />
                <i class="fa fa-search"></i>
            </div>
            <!-- PARTICIPANTS HERE! -->
        </div>

        <div class="chat">
            <div class="chat-header clearfix">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />

                <div class="chat-about">
                    <div class="chat-with">Eventnaam</div>
                </div>
            </div>
            <!-- end chat-header -->

            <div class="chat-history">
                <ul>

                    <li v-for="message in messages" v-bind:class="{'clearfix':(message.account.id !== {{ Auth::id() }})}">
                        <div v-if="message.account.id === {{ Auth::id() }}">
                            <div class="message-data">
                                <span class="message-data-name"><i class="fa fa-circle online"></i> @{{  message.account.firstName + ' ' + message.account.lastName}}</span>
                                <span class="message-data-time">@{{ message.created_at }}</span>
                            </div>
                            <div class="message my-message">
                                @{{ message.body }}
                            </div>
                        </div>
                        <div v-else-if="message.account.id !== {{ Auth::id() }}">
                            <div class="message-data align-right">
                                <span class="message-data-time">@{{ message.created_at }}</span>
                                <span class="message-data-name"></i> @{{  message.account.firstName + ' ' + message.account.lastName}}</span> <i class="fa fa-circle me"></i>
                            </div>
                            <div class="message other-message float-right">
                                @{{ message.body }}
                            </div>
                        </div>
                    </li>

                </ul>

            </div>
            <!-- end chat-history -->

            <div class="chat-message clearfix">
                <textarea name="message-to-send" id="message-to-send" placeholder="Type your message" rows="3" v-model="messageBox"></textarea>

                <button @click.prevent="postMessage">Send</button>

            </div>
            <!-- end chat-message -->

        </div>
        <!-- end chat -->

    </div>
    <!-- end container -->

    <!-- END CHAT TEMPLATE -->

@endsection

@section('scripts')
    <script>

        const app = new Vue({
            el: '#app',
            data: {
                messages: {},
                messageBox: '',
                event: {!! json_encode($event->getAttributes()) !!},
                account: {!! Auth::check() ? json_encode(Auth::user()->only(['id', 'firstName', 'lastName', 'api_token'])) : 'null' !!}
            },
            mounted() {
                this.getMessages();
                this.listen();
            },
            methods: {
                getMessages() {
                    axios.get(`/api/events/${this.event.id}/messages`)
                        .then((response) => {
                            this.messages = response.data
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                postMessage() {
                    axios.post(`/api/events/${this.event.id}/message`, {
                        api_token: this.account.api_token,
                        body: this.messageBox
                    })
                        .then((response) => {
                            this.messages.push(response.data);
                            this.messageBox = '';
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                listen() {
                    Echo.channel('event.'+this.event.id)
                        .listen('NewMessage', (message) => {
                            this.messages.push(message)
                        })
                }
            }
        });

    </script>
@endsection