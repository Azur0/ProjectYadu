@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-header">
			
		</div>
		<div class="card-body">
			<form action="/testemonials" method="POST">
				@csrf
				<div class="form-group">
					<label for="experience">{{ __('testemonials.form_experience') }}</label>
					<textarea name="experience" placeholder="{{__('testemonials.form_experience')}}" maxlength="150" required>{{ old('experience') }}</textarea>

					@if ($errors->has('description'))
						<div class="error">{{__('events.create_error_description_required')}}</div>
					@endif
				</div>

				<div>
					<input type="submit" name="submit" value="{{__('testemonials.form_create')}}">
				</div>
			</form>
		</div>
	</div>
@endsection