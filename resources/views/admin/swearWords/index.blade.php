@extends('layouts/admin/app')

@section('custom_css')
	<link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@endsection

@section('custom_script')

@endsection
@section('content')

	<div class="card">
		<div class="card-header">
			<b>&nbsp; {{__('validation.addWord')}}</b>
			<div class="input-group flex-nowrap">
				{{--<form id="createWord" action="/admin/prohibitedWords/'{{$_GET["newProhibitedWord"]}}'/create" method="get">--}}
				<form id="createWord" action="/admin/prohibitedWords/Hallowww/create" method="get">
					<input name="newProhibitedWord" class="form-control" placeholder="{{ __('global.word')}}">
				</form>
				<input type="submit" form="createWord" class="btn" style="background-color: limegreen; margin-left: 2%; color: black;" value="{{__('validation.add')}}">
			</div>
		</div>
		<div class="card-body">
			<div id="">
				<table class="table">
					<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{ __('global.word')}}</th>
						<th scope="col">{{ __('global.created_at')}}</th>
						<th scope="col">{{ __('global.updated_at')}}</th>
						<th scope="col"></th>
						<th scope="col"></th>
					</tr>
					</thead>

					<tbody>
					<?php $id = 1; ?>
					@foreach($ProhibitedWords as $ProhibitedWord)
						<tr>
							<td>{{$id}}</td>
							<td>{{$ProhibitedWord->word}}</td>
							<td>{{$ProhibitedWord->created_at}}</td>
							<td>{{$ProhibitedWord->updated_at}}</td>
							{{--<td><a href="/admin/prohibitedWords/{{$ProhibitedWord->word}}/update" class="button button-hover">{{__('events.show_edit')}}</a></td>--}}
							<td>
								<form class="form_submit_ays" method="POST" id="updateWord" action="/admin/prohibitedWords/{{$ProhibitedWord->word}}/update">
									<div>
										<div >
											<button type="button" class="button button-hover" data-toggle="modal" data-target="#confirmUpdateAccount">{{__('events.show_edit')}}</button>
										</div>
										<div class="modal fade" id="confirmUpdateAccount" tabindex="-1" role="dialog">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">{{__('validation.confirm_update')}}</h5>
														<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														{{ __('global.word')}}: <br>
														{{-- @TODO: zorgen dat het goede woord weergegeven wordt !!!--}}
														<input class="form-control" value="{{$ProhibitedWord->word}}">
													</div>
													<div class="modal-footer">
														<input type="submit" form="updateWord" class="btn" style="background-color: limegreen" value="{{__('validation.confirm_update')}}">
														<button type="button" class="btn btn-primary" data-dismiss="modal">{{__('events.dismiss_delete')}} </button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</td>
							<td> <button type="submit" onclick="window.location.href='{{url('/admin/prohibitedWords/'. $ProhibitedWord->word .'/delete')}}'" class="button-remove button-hover">{{__('events.show_delete')}}</button> </td>
						</tr>
					<?php $id++; ?>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection