@extends('layouts/admin/app')

@section('content')
	<div class="row ml-3 mb-3">
		<div class="backlink">
			<a href="{{url('admin/testemonials')}}"><i class="fas fa-arrow-left"></i> {{__('accounts.back')}}</a>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th scope="col">{{ __('accounts.index_name')}}</th>
					<th scope="col">{{ __('accounts.Experience')}}</th>
					<th scope="col"></th>
				</tr>
				</thead>
				<tbody>
				@foreach($testemonials as $testemonial)
					<tr>
						<td>{{ $testemonial->name }}</td>
						<td>{{ $testemonial->experience }}</td>
						<td>{{ $testemonial->created_at }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection