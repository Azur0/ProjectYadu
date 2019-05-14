@extends('layouts/admin/app')

@section('custom_css')
	<link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@endsection

@section('custom_script')

@endsection
@section('content')

	<div class="card">
		{{--<div class="card-header">--}}
			{{--<div class="input-group flex-nowrap">--}}
				{{--<div class="input-group-prepend">--}}
					{{--<span class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></span>--}}
				{{--</div>--}}
				{{--<input oninput="fetch_accounts()" list="names" id="filterByName" name="filterByName"--}}
					   {{--autocomplete="off" class="form-control" placeholder="{{ __('accounts.index_search')}}" aria-label="Email"--}}
					   {{--aria-describedby="addon-wrapping">--}}
			{{--</div>--}}
		{{--</div>--}}
		<div class="card-body">
			<div id="">
				<table class="table">
					<thead>
					<tr>
						{{-- @TODO Translate --}}
						<th scope="col">#</th>
						<th scope="col">Word</th>
						<th scope="col">Updated at</th>
						<th scope="col">Created at</th>
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
						</tr>
					<?php $id++; ?>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection