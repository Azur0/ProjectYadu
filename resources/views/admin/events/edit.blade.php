@extends('layouts/admin/app')

@section('custom_script')
	<script src="/js/event_edit1.js" defer></script>
	<script src="/js/event_edit2.js" defer></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuigrcHjZ0tW0VErNr7_U4Pq_gLCknnD0&libraries=places&callback=initAutocomplete" async defer></script>
@endsection

@section('content')
	<div class="create-event">
		<form action="/events/{{$data['event']->id}}" method="POST">
			@method("PATCH")
			@csrf
			<div class="type">
				<h3>1. Kies het type event </h3>
				<div class="types">
					<div class="box">
						@foreach ($data['tags'] as $tag)
							<input type="radio" id="{{$tag->tag}}" name="tag" value="{{$tag->id}}"
									onclick="check({{$tag->id }})"
									@if($tag->id == $data["event"]->tag_id)
									@php($selectedTag = $tag)
									checked
									@endif
							>
							<label for="{{$tag->tag}}" class="category" title="Uitje met gezinnen">
								<?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($tag->imageDefault) . '"/>'; ?>
								<?php echo '<img class="selected" src="data:image/jpeg;base64,' . base64_encode($tag->imageSelected) . '"/>'; ?>
								<span>{{$tag->tag}}</span>
							</label>
						@endforeach
					</div>
					@if ($errors->has('tag'))
						<div class="error">Kies een type.</div>
					@endif
				</div>
			</div>

			<div class="pic">
				<h3>2. Kies een foto voor je event </h3>
				<div class="types">
					<div id="box2" class="box">
						@foreach($selectedTag->eventPictures()->get() as $picture)
							<input type='radio' id='{{$picture->id}}' class='picture {{$picture->id}}' name='picture'
								   value='{{$picture->id}}'
							@if($picture->id == $data["event"]->event_picture_id)
								checked
							@endif
							>
							<label for='{{$picture->id}}' class='picture {{$picture->id}}' title='Uitje met gezinnen'>
								<?php echo '<img class="default" src="data:image/jpeg;base64,' . base64_encode($picture->picture) . '"/>'; ?>
							</label>
						@endforeach
					</div>
					@if ($errors->has('picture'))
						<div class="error">Kies een foto.</div>
					@endif
				</div>
			</div>

			<div class="loc">
				<h3>3. Kies de (verzamel)locatie </h3>
				<div class="description location">
					<input id="pac-input" name="location" class="controls" type="text" placeholder="Search Box" required
						   value="{{ $data['event']->location()->first()->postalcode }} {{ $data['event']->location()->first()->houseNumber }}{{ $data['event']->location()->first()->houseNumberAddition }}">
					<div id="map"></div>
					@if ($errors->has('location'))
						<div class="error">Het locatie-veld is verplicht.</div>
					@endif
				</div>
			</div>
			<div class="date">
				<h3>4. Kies de datum en tijd</h3>
				<div class="description">
					<h5>Date</h5>
					<input id="date" name="startDate" type="date" value="{{ $data['event']->startDate }}" required>
					<h5>Time</h5>
					<input id="date" name="startTime" type="time" value="{{ $data['event']->startTime }}" required>
					@if ($errors->has('startDate'))
						<div class="error">Deze datum/tijd is ongeldig.</div>
					@endif
				</div>
			</div>
			<div>
				<h3>5. Beschrijf je uitje</h3>
				<div class="description">
					<input type="text" id="title" name="activityName" placeholder="Titel"
						   oninput="update_counter_title(this)" maxlength="30" required
						   value="{{ $data['event']->eventName }}">
					<span id="chars_title"></span> characters remaining
					@if ($errors->has('activityName'))
						<div class="error">Het titel-veld is verplicht.</div>
					@endif

					<textarea id="desc" name="description" placeholder="Omschrijving.."
							  oninput="update_counter_desc(this)"
							  maxlength="150" required>{{ $data['event']->description }}</textarea>
					<span id="chars_desc"></span> characters remaining
					@if ($errors->has('description'))
						<div class="error">Het omschrijving-veld is verplicht.</div>
					@endif
				</div>
			</div>
			<div>
				<h3>6. Hoeveel mensen gaan er max mee?</h3>
				<div class="description">
					<input type="number" name="numberOfPeople" min="1" max="25"
						   value="{{ $data['event']->numberOfPeople }}">
					<span class="number_desc">mensen kunnen mee (incl. jezelf)</span>
					@if ($errors->has('numberOfPeople'))
						<div class="error">Het max aantal mensen-veld is verplicht.</div>
					@endif
				</div>
			</div>
			<input class="submit" type="submit" name="verzenden" value="Verzend">
		</form>
	</div>
@endsection