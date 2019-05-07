@extends('layouts/admin/app')

@section('content')
<div class="edit-event">
    <div class="type">
        {{-- TODO: translation --}}
        <h3>Wijzig type event</h3>
        <div class="types">
            <div class="box">
                @foreach ($tags as $Tag)
                    <input type="radio" id="{{$Tag->tag}}" name="tag" value="{{$Tag->id}}"
                          onclick="popup('popUpDiv')"  onclick="check({{$Tag->id }})">
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
    </div>
        @if ($errors->has('picture'))
            <div class="error">{{__('events.error_select_photo')}}</div>
        @endif
</div>


{{-- popup --}}
<div id="blanket" style="display:none;"></div>
<div id="popUpDiv" style="display:none;">
    <a href="#" onclick="popup('popUpDiv')" >Click to Close CSS Pop Up</a>
    <p>test</p>
</div>

<script src="..\js\popup.js"></script>
@endsection