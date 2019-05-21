@extends('layouts/admin/app')

@section('custom_css')
	<link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@endsection

@section('custom_script')

@endsection
@section('content')

	<div class="card">
		<div class="card-header">
			<b>&nbsp; {{__('ProhibitedWords.addWord')}}</b>
			<div class="input-group flex-nowrap">
				<form id="createWord" action="/admin/prohibitedWords/create" method="POST">
					@csrf
					<input name="newProhibitedWord" class="form-control" placeholder="{{ __('ProhibitedWords.word')}}">
				</form>
				<input type="submit" form="createWord" class="btn" style="background-color: limegreen; margin-left: 2%; color: black;" value="{{__('ProhibitedWords.add')}}">
			</div>
		</div>
		<div class="card-body">
			<div id="">
				<table class="table">
					<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{ __('ProhibitedWords.word')}}</th>
						<th scope="col"></th>
						<th scope="col"></th>
					</tr>
					</thead>

					<tbody>
					<?php $id = 1; ?>
					@foreach($prohibitedWords as $prohibitedWord)
						<tr>
							<td>{{$id}}</td>
							<td>{{$prohibitedWord->word}}</td>
							<td>
								<form class="form_submit_ays" method="POST" id="updateWord{{$id}}" action="/admin/prohibitedWords/update">
									@csrf
									<div>
										<div >
											<button type="button" class="button button-hover" data-toggle="modal" data-target="#confirmUpdateProhibitedWord{{$id}}">{{__('ProhibitedWords.show_edit')}}</button>
										</div>
										<div class="modal fade" id="confirmUpdateProhibitedWord{{$id}}" tabindex="-1" role="dialog">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">{{__('ProhibitedWords.confirm_update')}}</h5>
														<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														{{ __('ProhibitedWords.word')}}: <br>
														<input class="form-control" name="updatedProhibitedWord" value="{{$prohibitedWord->word}}">
														<input hidden name="originalProhibitedWord" value="{{$prohibitedWord->word}}">
													</div>
													<div class="modal-footer">
														<input type="submit" form="updateWord{{$id}}" class="btn" style="background-color: limegreen; color: black;" value="{{__('ProhibitedWords.confirm_update')}}">
														<button type="button" class="btn btn-primary" data-dismiss="modal">{{__('ProhibitedWords.dismiss_delete')}} </button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</td>
							<td>
							<form method="POST" action="/admin/prohibitedWords/delete">
								@csrf
								<input hidden name="prohibitedWordToDelete" value="{{$prohibitedWord->word}}">
								<button type="submit" class="button-remove button-hover">{{__('ProhibitedWords.show_delete')}}</button>
							</form>
							</td>
						</tr>
					<?php $id++; ?>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection