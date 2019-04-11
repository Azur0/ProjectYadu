@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<a href="/account/participating"><i class="fas fa-calendar-alt"></i> Participating</a>
				</div>
				<div class="card-body">
					<table class="table table-hover">
						<thead>
						<tr>
							<th scope="col">naam</th>
							<th scope="col">eigenaar</th>
							<th scope="col">datum</th>
							<th scope="col">locatie</th>
						</tr>
						</thead>
						<tbody>
						@foreach($participation as $par)
							<tr>
								<td><a href="/events/{{$par->id}}">{{ $par->eventName }}</a></td>
								<td>{{ $par->owner->firstName }} {{ $par->owner->middleName }} {{ $par->owner->lastName }}</td>
								<td>{{ date('d-m-Y', strtotime($par->startDate)) }}</td>
								<td>{{ $par->location->postalcode }}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header"><i class="fas fa-user"></i> User</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif
					<div id="user_avatar">
						<img src="data:image/png;base64,{{ chunk_split(base64_encode(Auth::user()->avatar)) }}">
					</div>
					<div>	
						{{ Auth::user()->firstName }} {{ Auth::user()->middleName }} {{ Auth::user()->lastName }}
					</div>
					<div>
						<form method="POST" action="/profile/edit">										
							@csrf
							<input type="hidden" id="userId" name="userId" value="{{Auth::id()}}">
							<input type="submit" id="submit-form" class="hidden" />
						</form>
						{{--<a href="{{link_to('ProfileController@edit', $userId = Auth::id())}}" class="nav-link m-2 nav-item">Profiel</a>--}}
						<label for="submit-form" tabindex="0"><i class="fas fa-user-cog"></i>profile settings</label>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<a href="/account/myevents"><i class="fas fa-calendar-alt"></i> My events</a><a class="right" href="/events/create"><i class="fas fa-plus-square"></i></a>
				</div>
				<div class="card-body">
					@if($events)
						@foreach($events as $event)
							<div class="dashboard_event">
								<a href="/events/{{ $event->id }}">
									<img class="card-img-top" src="data:image/png;base64,{{ chunk_split(base64_encode($event->eventPicture->picture)) }}">
									<div class="dashboard_event_info">
										<h3>{{ str_limit($event->eventName, $limit = 8, $end = '...') }}</h3>
										<p>{{ date('d-m-Y', strtotime($event->startDate)) }}</p>
									</div>
								</a>
							</div>
							<hr>
						@endforeach
					@else
						No events found
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
