@extends('layouts/admin/app')

@section('content')
<div>
        <div class="types">
            <h1>Placeholder type</h1>
                <div class="box">
                    @foreach ($tags as $tag)
                        <input type="radio" id="{{$tag->tag}}" name="tag" value="{{$tag->id}}">
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
            <div class="types">
                <div class="box">
                    @foreach ($pictures as $picture)
                        <input type="radio" id="{{$picture->name}}" name="picture">
                            <label for="{{$picture->picture}}" class="category">
                            <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($picture->picture) . '"/>'; ?>
                        </label
                    @endforeach
                </div>
                @if ($errors->has('pictures'))
                    <div class="error">placeholder.</div>
                @endif
            </div>
    {{-- <form action="{{ action('Management\ImagesController@check') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form> --}}
</div>
@endsection