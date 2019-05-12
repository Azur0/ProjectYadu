@extends('layouts/admin/app')

@section('content')
<div>
    <form action="{{ action('Management\ImagesController@check') }}" method="POST" enctype="multipart/form-data">
        <div class="types">
                <div class="box">
                    @foreach ($tags as $Tag)
                        <input type="radio" id="{{$Tag->tag}}" name="tag" value="{{$Tag->id}}"
                               onclick="check({{$Tag->id }})">
                        <label for="{{$Tag->tag}}" class="category">
                            <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($Tag->imageDefault) . '"/>'; ?>
                            <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($Tag->imageSelected) . '"/>'; ?>
                            <span>{{__('events.cat'.$Tag->id)}}</span>
                        </label>
                    @endforeach
                </div>
                @if ($errors->has('tag'))
                    <div class="error">{{__('events.error_select_type')}}.</div>
                @endif
            </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>
@endsection