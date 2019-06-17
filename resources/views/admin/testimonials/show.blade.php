@extends('layouts/admin/app')

@section('content')
	<div class="row ml-3 mb-3">
		<div class="backlink">
			<a href="{{ url('admin/testimonials') }}"><i class="fas fa-arrow-left"></i> {{__('accounts.back')}}</a>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			{{__('testimonials.header_testimonial')}}: {{ $testimonial->id }}

		</div>
		<div class="card-body">
			<div class="row">
				<div class="col">
					<h3>{{ $testimonial->name }}</h3>
					<h6>{{ $testimonial->created_at }}</h6>
				</div>
				<div class="col">
					@if( $testimonial->accepted == true )
						Status: <i class="fas fa-check"></i>
					@else
						Status: <i class="fas fa-times"></i>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p>
						{{ $testimonial->experience }}
					</p>
				</div>
			</div>
		</div>
	</div>
@endsection