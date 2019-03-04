@extends('layouts/app')

@section('content')
<script>
    window.onload = function() { 
                        var textarea = document.getElementById('desc');
                        var text = document.getElementById('title');
                        var len_d = parseInt(textarea.getAttribute("maxlength"), 10); 
                        var len_t = parseInt(text.getAttribute("maxlength"), 10); 
                        document.getElementById('chars_desc').innerHTML = len_d - textarea.value.length;
                        document.getElementById('chars_title').innerHTML = len_t - text.value.length;
                    }
                    function update_counter_title(text){
                        var len = parseInt(text.getAttribute("maxlength"), 10); 
                        document.getElementById('chars_title').innerHTML = len - text.value.length;
                    }
                    function update_counter_desc(textarea){
                        var len = parseInt(textarea.getAttribute("maxlength"), 10); 
                        document.getElementById('chars_desc').innerHTML = len - textarea.value.length;
                    }
                </script>
<div class="create-event">
    <form action="/events" method="POST">
        @csrf
        <div class="type">
            <h3>1. Kies het type uitje </h3>
            <div class="types">
                <div id="category_box">
                    @foreach ($tags as $Tag)
                    <input type="radio" id="{{$Tag->tag}}" name="tag" value="{{$Tag->tag}}">
                    <label for="{{$Tag->tag}}" class="category" title="Uitje met gezinnen">
                        <?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($Tag->imageDefault) . '"/>'; ?>
                        <?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($Tag->imageSelected) . '"/>'; ?>

                        <span>{{$Tag->tag}}</span>
                    </label>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="pic">
            <h3>2. Kies een foto voor je event </h3>
        </div>
        <div class="loc">
            <h3>3. Kies de (verzamel)locatie </h3>
        </div>
        <div class="date">
            <h3>4. Kies de datum en tijd</h3>
            <input id="date" name="startDate" type="date" value="{{ old('startDate') }}" required>
            <input id="time" name="startTime" type="time" value="{{ old('startTime') }}" required>
        </div>
        <div>
            <h3>5. Beschrijf je uitje</h3>
            <div class="description">
                <input type="text" id="title" name="title" placeholder="Titel" oninput="update_counter_title(this)" maxlength="30" value="{{ old('title') }}">
                <span id="chars_title"></span> characters remaining
                <textarea id="desc" name="description" placeholder="Omschrijving.." oninput="update_counter_desc(this)" maxlength="150" required>{{ old('description') }}</textarea>
                <span id="chars_desc"></span> characters remaining

            </div>
        </div>
        <div>
            <h3>6. Hoeveel mensen gaan er max mee?</h3>
            <div class="description">
                <input type="number" name="people" min="1" max="25" required value="{{ old('people') }}">
                <span class="number_desc">mensen kunnen mee (incl. jezelf)</span>
            </div>
        </div>
        <input class="submit" type="submit" name="verzenden" value="Verzend!!">
        <div class="notification is-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </form>
</div>
@endsection 