@extends('/layouts/app')

@section('content')
	<div class="col">
			<div class="card">
				<div class="card-header">
					<a href="/home"><i class="fas fa-door-open"></i> Dashboard</a>
				</div>
			</div>
			<div class="card">
				<div class="card-header"><i class="fas fa-calendar-alt"></i> Events particiting</div>
			</div>
			<ul class="events">
				@foreach($events as $event)
					<li class="event_wrap">
						<a href="/events/{{$event->id}}">
							<div class="box-shadow">
								<div class="event_background">
									<img class="card-img-top" src="data:image/png;base64,{{ chunk_split(base64_encode($event->eventPicture->picture)) }}">
								</div>
								<div class="event_avatar">
									<img src="data:image/png;base64,{{ chunk_split(base64_encode($event->owner->avatar)) }}">
									<h3>{{ str_limit($event->owner->firstName, $limit = 17, $end = '...') }}</h3>
								</div>
								<div class="event_info">
									<h3>{{ str_limit($event->eventName, $limit = 17, $end = '...') }}</h3>
									<p>{{ date('d-m-Y', strtotime($event->startDate)) }}<br>{{ $event->location->postalcode }}</p>
								</div>
							</div>
						</a>
					</li>
				@endforeach
			</ul>
		</div>
@endsection
