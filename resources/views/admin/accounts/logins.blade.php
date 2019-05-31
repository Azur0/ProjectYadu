@extends('layouts/admin/app')

@section('content')
	<div class="row ml-3 mb-3">
		<div class="backlink">
			<a href="{{url('admin/accounts/'.$account->id)}}"><i class="fas fa-arrow-left"></i> {{__('accounts.back')}}</a>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="row">
				<img class="img-fluid rounded-circle my-auto mr-3 avatar-lg" src="data:image/jpeg;base64, {{base64_encode($account->avatar)}}"/>
				<h1 class="my-auto">{{$account->firstName .' '. $account->middleName .' '. $account->lastName}}</h1>
				<div class="ml-auto my-auto mr-3">
					<button type="button" class="btn btn-danger my-auto" data-toggle="modal"
							data-target="#confirmDeleteAccount">
						{{__('accounts.edit_delete_account')}}
					</button>
					<div class="modal fade" id="confirmDeleteAccount" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">{{__('accounts.edit_delete_account_confirm_title')}}</h5>
									<button type="button" class="close" data-dismiss="modal"
											aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									{{__('accounts.edit_delete_account_confirm_content')}}
								</div>
								<div class="modal-footer">
									<button type="submit" onclick="window.location.href='{{url('/admin/accounts/'. $account->id .'/delete')}}'"
									   class="btn btn-danger">
										{{__('accounts.edit_delete_account_positive')}}</button>
									<button type="button" class="btn btn-primary"
											data-dismiss="modal">{{__('accounts.edit_delete_account_negative')}}
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col">
					<table class="table table-hover">
						<thead>
						<tr>
							<th scope="col">IP</th>
							<th scope="col">amount of logins</th>
							<th scope="col"></th>
						</tr>
						</thead>
						<tbody>
							{{ $amount }}
						{{-- @foreach($amount as $login)
							<tr>
								<td>{{ $login->ip }}</td>
								<td>{{ $login->created_at }}</td>
								<td><a><i class="fas fa-unlock-alt"> block</i></a></td>
							</tr>
						@endforeach --}}
						</tbody>
					</table>
				</div>

				<div class="col">
					<table class="table table-hover">
						<thead>
						<tr>
							<th scope="col">IP</th>
							<th scope="col">{{__('home.participating_table_colname_date')}}</th>
							<th scope="col"></th>
						</tr>
						</thead>
						<tbody>
						@foreach($logins as $login)
							<tr>
								<td>{{ $login->ip }}</td>
								<td>{{ $login->created_at }}</td>
								<td><a><i class="fas fa-unlock-alt"> block</i></a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
@endsection