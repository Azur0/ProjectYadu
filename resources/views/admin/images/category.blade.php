@extends('layouts/admin/app')

@section('content')
<div>
    <form action="{{ action('Management\ImagesController@passthrough') }}" method="POST" enctype="multipart/form-data">
        <div class="types">
            <h1>Placeholder type</h1>
                <div class="box">
                    @foreach ($tags as $tag)
                        <input type="radio" id="{{$tag->tag}}" name="tag" value="{{$tag->id}}" onclick="fetch_customer_data({{$tag->id }})">
                        <label for="{{$tag->tag}}" class="category">
                            <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '"/>'; ?>
                            <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '"/>'; ?>
                        </label>
                    @endforeach
                </div>
                @if ($errors->has('tag'))
                    <div class="error">placeholder.</div>
                @endif
            </div>

            <div class="pic">
                <h3>2. {{__('events.create_step2')}}</h3>
                    <div class="types">
                        <div id="box2" class="box">
                            
                        </div>
                        @if ($errors->has('picture'))
                            <div class="error">{{__('events.error_select_photo')}}</div>
                        @endif
                    </div>
            </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                        $('#box2').html("<h5><i>{{__('events.create_select_type_first')}}</i></h5>");
                    } else {
                        $('#box2').html("");

                        data.forEach(function (element) {
                            $('#box2').html($("#box2").html() + "<input type='radio' id='" +
                                element['id'] + "' class='picture " + element['tag_id'] +
                                "' name='picture' value='" + element['id'] + "'> <label for='" +
                                element['id'] + "' class='picture " + element['tag_id'] +
                                "'> <img class='default' src='data:image/jpeg;base64," +
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
@endsection