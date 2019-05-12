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
                {{-- TODO: Controller logic in view --}}
                <h5 class="mb-5">{{$event->writtenDate}}
                    {{__('events.show_datetime_at')}} {{date(__('formats.timeFormat'), $timestamp)}}</h5>
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
                    {{--<a id="share-instagram" class="fab fa-instagram" style="font-size: 36px; color: #E79535; margin-right: 2%; margin-bottom: 50px; cursor: pointer; text-decoration: none;"></a>--}}
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

                function LogEventShared(platform){
                    $.ajax({
                        url: "{{route('LogEventShared')}}",
                        method: 'POST',
                        data: {
                            eventid: "{{$event->id}}",
                            platform: platform,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                    });
                }

                document.getElementById("share-link").addEventListener('click', function(){
                    LogEventShared("link");
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
                    LogEventShared("facebook");
                    let url = `https://www.facebook.com/sharer/sharer.php?u=${window.location.href}`;
                    window.open(url,'popUpWindow','height=500,width=700,left=400,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');

                });

                document.getElementById("share-twitter").addEventListener('click', function(){
                    LogEventShared("twitter");
                    let url = `https://twitter.com/intent/tweet?text={{$event->eventName}}: ${window.location.href} %23Yadu`;
                    window.open(url,'popUpWindow','height=500,width=700,left=400,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
                });

                document.getElementById("share-whatsapp").addEventListener('click', function(){
                    LogEventShared("whatsapp");
                    let url = `https://wa.me/?text={{$event->eventName}}: ${window.location.href}`;
                    window.open(url,'popUpWindow','height=500,width=700,left=400,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
                });
            </script>

            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v3.2"></script>
            {{--End section Share buttons--}}

        </div>
    </div>
    <div class="row">
    @if(Auth::check() && (!empty($event->participants()->where('account_id', Auth::id())->first()) || !empty($event->owner_id == Auth::id())))
        <!-- BEGIN CHAT TEMPLATE -->
            <div id="app" class="message-container clearfix" v-if="account">

                <div class="chat">
                    <div class="chat-header clearfix">
                        <div class="chat-about">
                            <h1 class="chat-with">Chat</h1>
                        </div>
                    </div>
                    <!-- end chat-header -->

                    <div id="chat" class="chat-history" v-chat-scroll>
                        <ul>

                            <li v-for="message in messages" v-bind:class="{'clearfix':(message.user_id !== {{ Auth::id() }})}">
                                <div v-if="message.user_id === {{ Auth::id() }}">
                                    <div class="message-data">
                                        <span class="message-data-name"><i class="fa fa-circle online"></i> @{{  message.firstName + ' ' + message.lastName }}</span>
                                        <span class="message-data-time">@{{ message.created_at }}</span>
                                    </div>
                                    <div class="message my-message">
                                        @{{ message.body }}
                                    </div>
                                </div>
                                <div v-else-if="message.user_id !== {{ Auth::id() }}">
                                    <div class="message-data align-right">
                                        <span class="message-data-time">@{{ message.created_at }}</span>
                                        <span class="message-data-name"></i> @{{  message.firstName + ' ' + message.lastName }}</span> <i class="fa fa-circle me"></i>
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
                        <textarea name="message-to-send" id="message-to-send" placeholder="{{ __('events.show_chat_typemessage') }}" rows="3" v-model="messageBox" v-on:keyup.enter="postMessage"></textarea>

                        <button @click.prevent="postMessage">{{ __('events.show_chat_send') }}</button>

                    </div>
                    <!-- end chat-message -->

                </div>
                <!-- end chat -->

            </div>
            <!-- end container -->

            <!-- END CHAT TEMPLATE -->
        @else
            <div class="col-md-6">
                <h3 style="margin-top:30px;">
                    Meld je aan bij dit event om te kunnen chatten!
                </h3>
            </div>
        @endif
    </div>

@endsection
@if(Auth::check() && (!empty($event->participants()->where('account_id', Auth::id())->first()) || !empty($event->owner_id == Auth::id())))
@section('scripts')
    <script>

        let warning = document.createElement("strong");
        warning.style.color = "red";
        warning.innerHTML = "{{ __('events.show_chat_swearword') }}";

        function insertAfter(referenceNode, newNode) {
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
        }

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
                            warning.remove();
                        })
                        .catch(function (error) {
                            insertAfter(document.getElementById("message-to-send"), warning);
                        });
                },
                listen() {
                    Echo.private('event.'+this.event.id)
                        .listen('NewMessage', (message) => {
                            this.messages.push(message)
                        })
                }
            }
        });

        // Disable newline on enter(except when holding shift)
        $('textarea').keydown(function(e){
            if (e.keyCode == 13 && !e.shiftKey)
            {
                // prevent default behavior
                e.preventDefault();
            }
        });

    </script>
@endsection
@endif