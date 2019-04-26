@extends('layouts/admin/app')

@section('content')

	 <div>
        <div class="search">
            <label for="filterByTag">{{__('events.index_select_category')}}</label>
            <input oninput="fetch_events()" list="tags" id="filterByTag" name="filterByTag"/>
            <datalist id="tags">
                @foreach ($tags as $tag)
                    <option value="{{__('events.cat'.$tag->id)}}">
                @endforeach
            </datalist>
            <label for="filterByName">{{__('events.index_search_name')}}</label>
            <input oninput="fetch_events()" list="names" id="filterByName" name="filterByName" autocomplete="off"/>
        </div>
    </div>

	<div class="card">
		<div class="card-header">
			<a href="/account/participating"><i class="fas fa-calendar-alt"></i> {{__('home.participating_title')}}</a>
		</div>
		<div class="card-body">
			<table class="table table-hover">
				<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col">ID</th>
					<th scope="col">{{__('event.show_location')}}</th>
					<th scope="col">{{__('home.participating_table_colname_owner')}}</th>
					<th scope="col">{{__('home.participating_table_colname_date')}}</th>
					<th scope="col">{{__('home.participating_table_colname_location')}}</th>
					<th scope="col">{{__('home.participating_table_colname_max_participants')}}</th>
                    <th scope="col">{{__('home.participating_table_colname_participants')}}</th>
				</tr>
				</thead>
				<tbody >
				@foreach($events as $event)
					<tr>
						<td>
							@if(  $event->isHighlighted == 0)
								ster
							@else
								geenster
							@endif
						</td>
						<td>{{ $event->id}}</td>
						<td>{{ $event->name}}</td>
						<td>{{ $event->owner->firstName }} {{ $event->owner->middleName }} {{ $event->owner->lastName }}</td>
						<td>{{ $event->date }}</td>
						<td>{{ $event->location->postalcode }} {{ $event->city }}</td>
                        <td>{{$event->numberOfPeople}}</td>
                        <td>{{$event->participants->count()}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

   

    <div class="row">
        <div class="col-12">
            <a href="/events/create" class="btn btn-yadu-orange w-100"><i
                        class="fas fa-user-friends"></i>&nbsp;{{__('events.index_create_event')}}</a>
        </div>
    </div>

    <div class="event_overview row" id="eventsToDisplay">
        <img class='loadingSpinner' src='images/Spinner-1s-200px.gif'>
    </div>

    <script type="text/javascript">
        //AJAX request
        function fetch_events() {
            $('#eventsToDisplay').html("<img class='loadingSpinner' src='images/Spinner-1s-200px.gif'>");
            //var distance;
            //distance = $("#rangeValue").val();
            var inputTag = $(filterByTag).val();
            var inputName = $(filterByName).val();
            $.ajax({
                url: "{{ route('events_controller.actionDistanceFilter')}}",
                method: 'POST',
                data: {
                    //distance: distance,
                    inputTag: inputTag,
                    inputName: inputName,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data == "") {
                        $('#eventsToDisplay').html(
                            //TODO remove inline style
                            //TODO TRANSLATION
                            "<div style='text-align:center; width:100%; padding-top:50px;'><h1>{{__('events.index_no_event_found')}}</h1><div>"
                        );
                    } else {
                        $('#eventsToDisplay').html("");
                        data.forEach(function (element) {
                            $('#eventsToDisplay').html($("#eventsToDisplay").html() +
                                "<div class='col-md-6 col-lg-4 event'><a href='/events/" + element[
                                    'id'] +
                                "'><div class='card mb-4 box-shadow'> <img class = 'card-img-top' src ='data:image/jpeg;base64, " +
                                element['picture'] +
                                "' alt = 'Card image cap'><div class = 'event_info' > <h3> " +
                                element['eventName'] + "</h3><p>" + element['date'] +
                                "<br>" + element['loc'] +
                                "</p></div></div></a></div>");
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#eventsToDisplay').html(
                        //TODO TRANSLATION
                        "<div style='text-align:center; width:100%; padding-top:50px;'><h1>{{__('events.index_loading_error')}}</h1><div>"
                    );
                }
            })

        }
    </script>

@endsection