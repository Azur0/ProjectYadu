@extends('layouts/admin/app')

@section('content')
<div>
        <div class="types">
            <h1>Placeholder type</h1>
                <div class="box">
                    @foreach ($tags as $tag)
                    <div class="card"> 
                        <input type="radio" id="{{$tag->tag}}" name="tag" value="{{$tag->id}}" onclick="fetch_customer_data({{$tag->id }})">
                        <label for="{{$tag->tag}}" class="category">
                                <div>
                                    <div>
                                        <button type="button" onclick="removeType({{$tag->id}})" class="button-remove button-hover">x</button>
                                    </div>
                                </div>
                            <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '"/>'; ?>
                            <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '"/>'; ?>
                        </label>  
                    </div>                     
                    @endforeach
                    <div class="card">
                        <form action="{{ route('imagescontroller.addtype') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="filename">
                            <input class="btn btn-info" type="file" name="file" accept="image/png, image/jpeg, image/jpg">
                            <button type="submittype" name="submittype">placeholder upload</button>
                        </form>
                    </div>    
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
                            $('#box2').html($("#box2").html() + `<input type="radio" id="${element['id']}" class="picture ${element['tag_id']}"  
                                name="picture" value="${element['id']}"> <label for="${element['id']}" class="picture ${element['tag_id']}">
                                        <div>
                                            <div class="badgecontainer">
                                                <button type="button" class="button-remove button-hover" value="${element['id']}" onclick="deleteTypeOff(this.value)">x</button>
                                            </div>
                                        </div>
                                <img class="default" src="data:image/jpeg;base64, ${element['picture']}"> </label>`);
                        });
                    }
                }
            })
        }

    function deleteTypeOff(id) {
        $.ajax({
            url: "{{ route('events_controller.deleteCategoryPicture')}}",
                method: 'POST',
                data: {
                    query: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (data) { 
                    let id = $('input[name=tag]:checked').val();
                    fetch_customer_data(id);
                    alert("Success");
                },
                error: function () {
                    alert("Picture in use");
                }
        }) 
    }
    </script>
@endsection