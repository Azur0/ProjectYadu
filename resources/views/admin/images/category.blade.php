@extends('layouts/admin/app')

@section('content')
<div>
    <form action="{{ action('Management\ImagesController@passthrough') }}" method="POST" enctype="multipart/form-data">
        <div class="types">
            <h1>Placeholder type</h1>
                <div class="box">
                    @foreach ($tags as $tag)
                    <div class="card"> 
                        <input type="radio" id="{{$tag->tag}}" name="tag" value="{{$tag->id}}" onclick="fetch_customer_data({{$tag->id }})">
                        <label for="{{$tag->tag}}" class="category">
                                        <div>
                                            <div>
                                                <button type="button" class="button-remove button-hover" data-toggle="modal" data-target="#confirmDelete">x</button>
                                            </div>
                                            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">placeholder title</h5>
                                                            <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            placeholder information
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" form="deleteAccount" class="btn btn-danger" onclick="window.location.href='{{url('/admin/images/'.$tag->id.'/delete')}}'" value="placeholder confirm delete">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Placeholder dismiss</button>
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
    </form>
</div>
<script>
    
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
                        $('#box2').html("<h5><i>Placeholder</i></h5>");
                    } else {
                        $('#box2').html("");

                        data.forEach(function (element) {
                            $('#box2').html($("#box2").html() + `<input type="radio" id="${element['id']}" class="picture ${element['tag_id']}"  
                                name="picture" value="${element['id']}"> <label for="${element['id']}" class="picture ${element['tag_id']}">
                                        <div>
                                            <div class="badgecontainer">
                                                <button type="button" class="button-remove button-hover" data-toggle="modal" data-target="#confirmDeleteTypeOff">x</button>
                                            </div>
                                            <div class="modal fade" id="confirmDeleteTypeOff" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">placeholder title</h5>
                                                            <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            placeholder information
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" form="deleteTypeOff" class="btn btn-danger" value="placeholder confirm delete" onclick="deleteTypeOff()">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Placeholder dismiss</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <img class="default" src="data:image/jpeg;base64, ${element['picture']}"> </label>`);
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
        function deleteTypeOff() {
        // window.location.href ={{url('/admin/images/'.$tag->id.'/delete')}};
        console.log("{{ url('Management\ImagesController@removetype') }}");
    }   
        </script>
@endsection