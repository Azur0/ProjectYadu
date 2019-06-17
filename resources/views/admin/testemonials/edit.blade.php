@extends('layouts/admin/app')

@section('content')
	<div class="row ml-3 mb-3">
		<div class="backlink">
			<a href="{{ url('admin/testemonials') }}"><i class="fas fa-arrow-left"></i> {{__('accounts.back')}}</a>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			{{__('testemonials.header_testemonial')}}: {{ $testemonial->id }}

		</div>
		<div class="card-body">
			<form action="/admin/testemonials/{{ $testemonial->id }}" method="POST">
				@method("PATCH")
				@csrf

				<input type="hidden" name="id" value="{{ $testemonial->id }}">

				<div class="form-group">
					<label for="name">{{ __('testemonials.form_accepted') }}</label>
					<select name="accepted" class="form-control{{ $errors->has('accepted') ? ' is-invalid' : '' }}">
						<option value="1" {{ $testemonial->accepted == "1" ? 'selected' : '' }}>
							{{__('testemonials.form_accepted_true')}}
						</option>
						<option value="0" {{ $testemonial->accepted == "0" ? 'selected' : '' }}>
							{{__('testemonials.form_accepted_false')}}
						</option>
					</select>
				</div>

				<div class="form-group">
					<label for="name">{{ __('testemonials.form_name') }}</label>
					<input type="text" class="form-control" name="name" placeholder="{{__('testemonials.form_name')}}" maxlength="99" required value="{{ $testemonial->name }}">
			
					@if ($errors->has('activityName'))
						<div class="error">{{__('events.create_error_title_required')}}</div>
					@endif
				</div>
				<div class="form-group">
					<label for="experience">{{ __('testemonials.form_name') }}</label>
					<textarea name="experience" placeholder="{{__('testemonials.form_experience')}}" maxlength="150" required>{{ $testemonial->experience }}</textarea>

					@if ($errors->has('description'))
						<div class="error">{{__('events.create_error_description_required')}}</div>
					@endif
				</div>

				<div>
					<input type="submit" name="submit" value="{{__('testemonials.form_update')}}">
				</div>
			</form>
		</div>
	</div>
@endsection