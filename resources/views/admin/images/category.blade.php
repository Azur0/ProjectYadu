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
                    <button type="submittype" name="submittype">placeholder upload</button>
                </form>
            </div>  
        <div class="types">
            <h1>Placeholder type</h1>
                <div class="box">
                    @foreach ($tags as $tag)
                    <div class="card divider"> 
                        <input type="radio" id="{{$tag->tag}}" name="tag" value="{{$tag->id}}" onclick="fetch_customer_data({{$tag->id }})">
                        <label for="{{$tag->tag}}" class="category">
                                <div>
                                    <div>
                                        <button type="button" onclick="removeType({{$tag->id}})" class="badge eventpicture btn-danger my-auto">x</button>
                                    </div>
                                </div>
                            <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '"/>'; ?>
                            <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '"/>'; ?>
                        </label>  
                    </div>                     
                    @endforeach
                </div>
                @if ($errors->has('tag'))
                    <div class="error">placeholder.</div>
                @endif
            </div>

            <div class="pic">
                <h3>Placeholder secondary</h3>
                    <div class="types">
                        <div id="box2" class="box">
                            
                        </div>
                        @if ($errors->has('picture'))
                            <div class="error">Placeholder error</div>
                        @endif
                    </div>
            </div>
    @if($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif
</div>
<script>
    function removeType(id) {
        $.ajax({
            url: "{{ route('imagescontroller.checkforevent')}}",
            method: 'GET',
            data: {
                query: id,
            },
            dataType: 'json',
            success: function (data) {
                if(typeof(data[0]) != "undefined"){
                    if (confirm('Placeholder events are tied are you sure? This will remove all connecting pictures.')) {
                        $.ajax({
                        url: "{{ route('imagescontroller.overrideremove') }}",
                        method: 'POST',
                        data: {
                            query: id,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function() {
                            // alert("placeholder overwrite successful");
                            console.log(data[0]);
                        }
                        });
                    } 
                } else {
                    $.ajax({
                        url: "{{ route('imagescontroller.removetype')}}",
                        method: "POST",
                        data: {
                            query: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            alert("Placeholder successful removal");
                        }
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
                        $('#box2').html("<h5><i>Placeholder</i></h5>");
                    } else {
                        $('#box2').html("");

                        data.forEach(function (element) {
                            $('#box2').html($("#box2").html() + `<div class="flexbox divider"><input type="radio" id="${element['id']}" class="picture ${element['tag_id']}"  
                                name="picture" value="${element['id']}"> <label for="${element['id']}" class="picture ${element['tag_id']}">
                                        <div>
                                            <button type="button" id="eventpicture" class="badge btn-danger my-auto" data-toggle="modal"
                                                data-target="#confirmDeleteAccount">x
                                            </button>
                                            <div class="modal fade" id="confirmDeleteAccount" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">placeholder title</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            placeholder are u sure
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" onclick="deleteeventpicture(this.value)" value="${element['id']}"
                                                            class="btn btn-danger" data-dismiss="modal">placeholder confirm</button>
                                                            <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">placeholder negative
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <img class="default" src="data:image/jpeg;base64, ${element['picture']}"> </label></div>`);
                        });
                    }
                }
            })
        }

    function deleteeventpicture(id) {
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
@endsection