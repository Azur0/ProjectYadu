@extends('layouts/admin/app')

@section('content')
{{-- Upload icon --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
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
                <div>
                    <div class="card-header">
                    <h1>{{__('image.add_tag_title')}}</h1>
                    </div>
                    <div class="form card-body">
                        <form class="form-group" action="{{ route('imagescontroller.addtype') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="responsive">
                            <label class="background-label formitem">
                                    <i class="fa fa-input"></i>
                            <label>{{__('image.add_tag_name')}}</label>
                            <input required autofocus class="w3-input w3-border" type="text" name="naam">
                            </div>
                            <div class="responsive">
                                <label for="file1" class="input-label first formitem">
                                    <i class="fa fa-upload"></i>
                                    {{__('image.add_tag_default')}}
                                </label>
                                <input id="file1" class="btn btn-info" type="file" name="defaultImage" accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div class="responsive">
                                <label for="file2" class="input-label second formitem">
                                    <i class="fa fa-upload"></i>
                                    {{__('image.add_tag_selected')}}
                                </label>
                                <input id="file2" class="btn btn-info" type="file"  name="selectedImage" accept="image/png, image/jpeg, image/jpg">
                            </label>
                            <button type="submittype" class="btn btn-primary submit-edit" name="submittype">{{__('image.button_upload_dual')}}</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Show category types --}}
        <div class="types">
            <h1>{{__('image.header_type_tag')}}</h1>
                <div class="box">
                    @foreach ($tags as $tag)
                    <div class="card divider"> 
                        <input type="radio" id="{{$tag->id}}" name="tag" value="{{$tag->id}}" onclick="fetch_customer_data({{$tag->id}})">
                        <label for="{{$tag->id}}" class="category">
                            <div class="ml-auto my-auto mr-3">
                                <button type="button" class="btn btn-danger" id="{{$tag->id}}" onclick="setchecked({{$tag->id}})" data-toggle="modal" data-target="#confirmDeleteTag"><i class="far fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-warning" id="{{$tag->id}}" onclick="location.href='/images/categroy/edittagpicture';"><i class="far fa-edit" style="width:14px"></i></button>
                                        
                                        {{-- Popup for deleting --}}
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


                                <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '"/>'; ?>
                                <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '"/>'; ?>
                            </div>
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
            <div class="pic" hidden>
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
$(document).ready(function() {
    $("#file1").on("change", function() {
        $('.first').html(`<i class="fa fa-upload"></i>Default image: ${$(this)[0].files[0].name}`);
    });
    $("#file2").on("change", function() {
        $('.second').html(`<i class="fa fa-upload"></i>Selected image: ${$(this)[0].files[0].name}`);
    });
})
</script>
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
                    console.log(data);
                    if(data.length > 0) {
                        document.querySelector('.eventheader').innerHTML = "{{__('image.modal_delete_event_connected')}}";
                    }
                    if(imagedata.length > 0) {
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
            document.querySelector('.pic').hidden = false;
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
                        $('#box2').html(`
                        <div class="card">
                            <div class="card-header">
                                <h5><i>{{__('image.error_nodata')}}</i></h5>
                            </div>
                                <form action="{{ url('admin/images/category/addeventpicture/${query}') }}" method="POST" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="responsive">
                                        <label for="file3" class="input-label first formitem">
                                            <i class="fa fa-upload"></i>
                                            {{__('image.add_event_picture_first')}}
                                        </label>
                                        <input id="file3" class="btn btn-info" type="file" name="default" accept="image/png, image/jpeg, image/jpg">
                                    </div>
                                </form>
                            </div>`);
                    } else {
                        $('#box2').html("");

                        data.forEach(function (element) {
                            $('#box2').html($("#box2").html() + `
                                <div class="box divider">
                                <input type="radio" id="${element['id']}" class="picture ${element['tag_id']}" name="eventpicture" value="${element['id']}"> 
                                <label for="${element['id']}" class="picture ${element['tag_id']}">
                                        <button type="button" onclick="setchecked(${element['id']})" class="btn btn-danger eventpicturebutton" data-toggle="modal"data-target="#confirmDeleteEventPicture"><i class="far fa-trash-alt"></i></button>
                                        <button type="button" onclick="location.href='/images/categroy/edittagpicture';" class="btn btn-warning eventpicturebutton" id="${element['id']}"><i class="far fa-edit" style="width:14px"></i></button>

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
                                    
                                    <img class="default" src="data:image/jpeg;base64, ${element['picture']}">
                                </label>
                                </div>`);
                        });
                        $('#box2').html($("#box2").html() + `
                                <form id="myForm" action="{{ url('admin/images/category/addeventpicture/${query}') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="responsive" id="incard">
                                        <label for="file3" class="input-label first formitem">
                                            <i class="fa fa-upload"></i>
                                            {{__('image.add_event_picture_second')}}
                                        </label>
                                        <input id="file3" class="btn btn-info" type="file" name="default" accept="image/png, image/jpeg, image/jpg">
                                    </div>
                                </form>`);
                    }
                    $("#file3").on('change',function(){
                        document.getElementById("myForm").submit();
                    });
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