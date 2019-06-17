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
			<div class="row">
				<div class="col">
					<h3>{{ $testemonial->name }}</h3>
					<h6>{{ $testemonial->created_at }}</h6>
				</div>
				<div class="col">
					@if( $testemonial->accepted == true )
						Status: <i class="fas fa-check"></i>
					@else
						Status: <i class="fas fa-times"></i>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col">
					<p>
						{{ $testemonial->experience }}
					</p>
				</div>
			</div>
		</div>
	</div>
@endsection