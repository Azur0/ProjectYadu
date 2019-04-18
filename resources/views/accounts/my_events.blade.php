@extends('/layouts/app')

@section('content')
	<div class="col">
		<div class="backlink">
			<a href="/home"><i class="fas fa-arrow-left"></i> Dashboard</a>
		</div>
		<div class="card">
			<div class="card-header"><i class="fas fa-calendar-alt"></i> My events</div>
			<div class="card-body">
				<table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">naam</th>
                        <th scope="col">datum</th>
                        <th scope="col">locatie</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td><a href="/events/{{$event->id}}">{{ $event->eventName }}</a></td>
                            <td>{{ date('d-m-Y', strtotime($event->startDate)) }}</td>
                            <td>{{ $event->location->postalcode }}</td>
                            <td>
                            	<a href="/events/{{$event->id}}/edit"><i class="fas fa-edit" style="font-size:20px; margin-right: 10px; color:#2578AF;"></i></a>
                            	<a href="/events/{{$event->id}}/delete"><i class="fas fa-trash-alt" style="font-size:20px; color:red;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
			</div>
		</div>
	</div>
@endsection
