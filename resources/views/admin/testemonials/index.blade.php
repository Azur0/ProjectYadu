@extends('layouts/admin/app')

@section('content')
	<div class="card">
		<div class="card-header">
			<a href="/admin/testemonials/create">new</a>
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th>ID</th>
					<th scope="col">{{ __('testemonials.type')}}</th>
					<th scope="col">{{ __('testemonials.name')}}</th>
					<th scope="col">{{ __('testemonials.Experience')}}</th>
					<th scope="col">date</th>
				</tr>
				</thead>
				<tbody>
				@foreach($testemonials as $testemonial)
					<tr>
						<a href="/admin/testemonials/{{ $testemonial->id }}">
							<td>{{ $testemonial->id }}</td>
							@if(empty($testemonial->account_id))
								<td>Custom</td>
							@else
								<td><a href="/admin/accounts/{{ $testemonial->account_id }}">{{ $testemonial->account_id }}</a></td>
							@endif
							<td>{{ $testemonial->name }}</td>
							<td>{{ $testemonial->experience }}</td>
							<td>{{ $testemonial->created_at }}</td>
						</a>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection