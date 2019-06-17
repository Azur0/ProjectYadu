@extends('layouts/admin/app')

@section('content')
	<div class="card">
		<div class="card-header">
			{{ __('testemonials.header_testemonial')}} 
			<div class="float-right">
				<a href="/admin/testemonials/create">{{ __('testemonials.header_new')}} <i class="fas fa-plus-square"></i></a>
			</div>
		</div>
		<div class="card-body">
			{{ $testemonials->links() }}
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">{{ __('testemonials.table_type')}}</th>
						<th scope="col">{{ __('testemonials.table_accepted')}}</th>
						<th scope="col">{{ __('testemonials.table_name')}}</th>
						<th scope="col">{{ __('testemonials.table_experience')}}</th>
						<th scope="col">{{ __('testemonials.table_date')}}</th>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
				@foreach($testemonials as $testemonial)
					<tr>						
						<td>{{ $testemonial->id }}</td>
						@if(empty($testemonial->account_id))
							<td>{{ __('testemonials.table_custom')}}</td>
						@else
							<td><a href="/admin/accounts/{{ $testemonial->account_id }}">{{ __('testemonials.table_user')}}</a></td>
						@endif
						<td>
							@if( $testemonial->accepted == true )
								<i class="fas fa-check"></i>
							@else
								<i class="fas fa-times"></i>
							@endif
						</td>
						<td>
							@if(empty($testemonial->account_id))
								{{ $testemonial->name }}
							@else
								<a href="/admin/accounts/{{ $testemonial->account_id }}">
									{{ $testemonial->account->firstName }} {{ $testemonial->account->middleName }} {{ $testemonial->account->lastName }}
								</a>
							@endif
						</td>
						<td>{{ str_limit($testemonial->experience, $limit = 15, $end = '...') }}</td>
						<td>{{ $testemonial->created_at }}</td>
						<td>
							<a href="/admin/testemonials/{{ $testemonial->id }}">
								<i class="fas fa-eye"></i>
							</a>
						</td>
						<td>
							<a href="/admin/testemonials/{{ $testemonial->id }}/edit">
								<i class="fas fa-edit"></i>
							</a>
						</td>
						<td>
							<form class="form_submit_ays" method="POST" id="deleteAccount{{$testemonial->id}}" action="/admin/testemonial/{{$testemonial->id}}">
								@method('DELETE')
								@csrf
								<div>
									<div >
										<button type="button" class="button-remove" data-toggle="modal" data-target="#confirmDeleteAccount{{$testemonial->id}}">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>

									<div class="modal fade" id="confirmDeleteAccount{{$testemonial->id}}" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">{{__('testemonials.delete_title_confirm')}}</h5>
													<button type="button" class="close" data-dismiss="modal"
															aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													{{__('testemonials.delete_confirm_text')}}
												</div>
												<div class="modal-footer">
													<input type="submit" form="deleteAccount{{$testemonial->id}}" class="btn btn-danger"
														   value="{{__('testemonials.delete_confirm_delete')}}">
													<button type="button" class="btn btn-primary"
															data-dismiss="modal">{{__('testemonials.delete_dismiss_delete')}}
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection