@extends('layouts/admin/app')

@section('custom_css')
	<link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@endsection

@section('custom_script')

@endsection
@section('content')

	<div class="card">
		<div class="card-header">
			<div class="input-group flex-nowrap">
				<div class="input-group-prepend">
					<span class="input-group-text" id="addon-wrapping" style="background-color: lawngreen"><i class="fa fa-plus"></i></span>
				</div>
				<input class="form-control" placeholder="{{ __('global.word')}}">
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
							{{--<td><a href="/admin/events/{{$event->id}}/edit" class="button button-hover">{{__('events.show_edit')}}</a></td>--}}
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