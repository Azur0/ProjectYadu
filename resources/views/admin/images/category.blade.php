@extends('layouts/admin/app')

@section('content')
<div>
    <div class="card">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($message = Session::get('success'))
                    <div class="alert alert-succes alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <form action="{{ route('imagescontroller.addtype') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="filename">
                    <div>
                        <input class="btn btn-info" type="file" name="typefile1" accept="image/png, image/jpeg, image/jpg">
                    </div>
                    <div>
                        <input class="btn btn-info" type="file" name="typefile2" accept="image/png, image/jpeg, image/jpg">
                    </div>
                    <button type="submittype" name="submittype">{{__('image.button_upload_dual')}}</button>
                </form>
            </div>  
        <div class="types">
            <h1>{{__('image.header_type_tag')}}</h1>
                <div class="box">
                    @foreach ($tags as $tag)
                    <div class="card divider"> 
                        <input type="radio" id="{{$tag->id}}" name="tag" value="{{$tag->id}}" onclick="fetch_customer_data({{$tag->id}})">
                        <label for="{{$tag->id}}" class="category">
                                <div class="ml-auto my-auto mr-3">
                                        <button type="button" class="badge btn-danger my-auto" id="{{$tag->id}}" onclick="setchecked({{$tag->id}})" data-toggle="modal" data-target="#confirmDeleteTag">x</button>
                                        <div class="modal fade" id="confirmDeleteTag" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{__('image.modal_delete_title')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="text-warning bg-danger eventheader"></h5>
                                                        <div class="eventsbody" id="eventbox"></div>
                                                        <h5 class="text-warning bg-danger pictureheader"></h5>
                                                        <div class="imagebody" id="imagebox"></div>
                                                        <div class="confirmation">{{__('image.modal_delete_tag_center')}}</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" id="approve" onclick="removeType({{$tag->id}})" class="btn btn-danger">{{__('image.modal_delete_confirmation')}}</button>
                                                        <button type="button" id="deny" class="btn btn-primary" data-dismiss="modal">{{__('image.modal_delete_dismiss')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '"/>'; ?>
                            <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '"/>'; ?>
                        </label>  
                    </div>                     
                    @endforeach
                </div>
                @if ($errors->has('tag'))
                    <div class="error">{{__('image.error_empty_tags')}}</div>
                @endif
            </div>
            @if($message = Session::get('eventsuccess'))
                    <div class="alert alert-succes alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
            <div class="pic">
                <h3>{{__('image.header_eventpictures')}}</h3>
                    <div class="types">
                        <div id="box2" class="box">
                            
                        </div>
                        @if ($errors->has('picture'))
                            <div class="error">{{__('image.error_empty_eventpictures')}}</div>
                        @endif
                    </div>
            </div>
            <div class="imageform">

            </div>
</div>
<script>
    function removeType() {
        let id = $('input[name=tag]:checked').val();
        let imagedata;
        $.ajax({
            url: "{{ route('imagescontroller.checktiedpictures')}}",
            method: 'POST',
            data: {
                query: id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
                imagedata = data;
            }
        });

        $.ajax({
            url: "{{ route('imagescontroller.removetype')}}",
            method: 'POST',
            data: {
                query: id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (data) {
                if(data == "success"){
                    location.reload();
                } else {
                    if(data) {
                        document.querySelector('.eventheader').innerHTML = "{{__('image.modal_delete_event_connected')}}";
                    }
                    if(imagedata) {
                        document.querySelector('.pictureheader').innerHTML = "{{__('image.modal_delete_image_connected')}}";
                    }

                    // get buttons
                    let approve = document.getElementById('approve');
                    let deny = document.getElementById('deny');
                    approve.setAttribute('data-dismiss', 'modal');

                    // get div bodies
                    let eventsbody = document.querySelector('.eventsbody');
                    let imagebody = document.querySelector('.imagebody')
                    eventsbody.appendChild(document.createElement('ul'));

                    // set bodies
                    data.forEach(function (element) {
                        $(eventsbody).html($("#eventbox").html() + `<li>${element['eventName']}</li>`);
                    });
                    eventsbody.appendChild(document.createElement('br'));
                    imagedata.forEach(function (element) {
                        $(imagebody).html($("#imagebox").html() + `<label class="picture"><img class="responsive" src="data:image/jpeg;base64, ${element['picture']}"></label>`);
                    });

                    // set reload and ajax on event click
                    approve.addEventListener('click', function() {
                        $.ajax({
                            url: "{{ route('imagescontroller.trueremove')}}",
                            method: 'POST',
                            data: {
                                query: id,
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(data) {
                                location.reload();
                            },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('jqXHR:');
                    console.log(jqXHR);
                    console.log('textStatus:');
                    console.log(textStatus);
                    console.log('errorThrown:');
                    console.log(errorThrown);
                }
                        });
                    });
                    deny.addEventListener('click', function() {
                        location.reload();
                    })
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
        });
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
                    if (data == "") {
                        $('#box2').html(`<h5><i>{{__('image.error_nodata')}}</i></h5><form action="{{ url('admin/images/category/addeventpicture/${query}') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input class="btn btn-info" type="file" name="eventfile" accept="image/png, image/jpeg, image/jpg">
                                    </div>
                                    <button type="submittype" name="submittype">{{__('image.button_upload_dual')}}</button>
                                </form>`);
                    } else {
                        $('#box2').html("");

                        data.forEach(function (element) {
                            $('#box2').html($("#box2").html() + `<div class="flexbox divider"><input type="radio" id="${element['id']}" class="picture ${element['tag_id']}"  
                                name="eventpicture" value="${element['id']}"> <label for="${element['id']}" class="picture ${element['tag_id']}">
                                        <div>
                                            <button type="button" id="eventpicture" onclick="setchecked(${element['id']})" class="badge btn-danger my-auto" data-toggle="modal"
                                                data-target="#confirmDeleteEventPicture">x
                                            </button>
                                            <div class="modal fade" id="confirmDeleteEventPicture" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{__('image.modal_delete_title')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                                {{__('image.modal_delete_eventpicture_center')}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" onclick="deleteeventpicture(this.value)" value="${element['id']}"
                                                            class="btn btn-danger" data-dismiss="modal">{{__('image.modal_delete_confirmation')}}</button>
                                                            <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">{{__('image.modal_delete_dismiss')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <img class="default" src="data:image/jpeg;base64, ${element['picture']}"> </label></div>`);
                        });
                        $('#box2').html($("#box2").html() + `<form action="{{ url('admin/images/category/addeventpicture/${query}') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input class="btn btn-info" type="file" name="eventfile" accept="image/png, image/jpeg, image/jpg">
                                    </div>
                                    <button type="submittype" name="submittype">{{__('image.button_upload_dual')}}</button>
                                </form>`);
                    }
                }
            })
        }

    function setchecked(id) {
        document.getElementById(id).checked = true;
    }

    function deleteeventpicture() {
        let id = $('input[name=eventpicture]:checked').val();
        $.ajax({
            url: "{{ route('events_controller.deleteeventpicture')}}",
                method: 'POST',
                data: {
                    query: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (data) { 
                    let id = $('input[name=tag]:checked').val();
                    fetch_customer_data(id);
                }
        }) 
    }
    </script>
@endsection