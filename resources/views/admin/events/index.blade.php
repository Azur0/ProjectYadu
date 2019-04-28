@extends('layouts/admin/app')
@section('custom_script')
	<script type="text/javascript" src="/js/admin_event_filter.js" defer></script>
@endsection
@section('content')

	<div class="card">
		<div class="card-header">
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
					<input oninput="fetch_events()" list="names" id="filterByName" name="filterByName" placeholder="search" autocomplete="off"/>
				</div>
			</div>
			<div class="col-12">
			   
			</div>
		</div>
		<div class="card-body">
			<table class="table table-hover">
				<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col">ID</th>
					<th scope="col">{{__('events.show_category')}}</th>
					<th scope="col">{{__('events.show_title')}}</th>
					<th scope="col">{{__('events.show_initiator')}}</th>
					<th scope="col">{{__('events.show_date')}}</th>
					<th scope="col">{{__('events.show_location')}}</th>
                    <th scope="col">{{__('events.show_max')}}</th>
					<th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
				</tr>
				</thead>
				<tbody id="eventsToDisplay">
					@foreach($events as $event)


					<tr >
						<td>
							@if(  $event->isHighlighted == 1)
								<i class="fas fa-star"></i>
							@endif
						</td>
						<td>{{ $event->id}}</td>
						<td>{{ $event->tag->tag }}</td>
						<td>{{ $event->eventName}}</td>
						<td>{{ $event->owner->firstName }} {{ $event->owner->middleName }} {{ $event->owner->lastName }}</td>
						<td>
							@if(__('events.show_lang') == "Dutch")
								{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i')}}
							@else
								{{ \Carbon\Carbon::parse($event->date)->format('m/d/Y H:i')}}
							@endif
						</td>
						<td>{{ $event->location->postalcode }} {{ $event->city }}</td>
						<td>{{$event->numberOfPeople}}/{{$event->participants->count()}}</td>
						<td><a href="/events/{{$event->id}}" class="button-show button-hover">{{__('events.show')}}</a></td>
                        <td><a href="/admin/events/{{$event->id}}/edit" class="button button-hover">{{__('events.show_edit')}}</a></td>
                        <td>
                            <form method="POST" action="/admin/events/{{$event->id}}">
                                @method('DELETE')
                                @csrf
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="button-remove button-hover">{{__('events.show_delete')}}</button>
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

	

	<script type="text/javascript">
		//AJAX request
		function fetch_events() {
			$('#eventsToDisplay').html("<img class='loadingSpinner' src='images/Spinner-1s-200px.gif'>");
			//var distance;
			//distance = $("#rangeValue").val();
			var inputTag = $(filterByTag).val();
			var inputName = $(filterByName).val();
			$.ajax({
				url: "{{ route('admin_events_controller.actionDistanceFilter')}}",
				method: 'POST',
				data: {
					distance: 25,
					inputTag: inputTag,
					inputName: inputName,
					_token: '{{ csrf_token() }}'
				},
				dataType: 'json',
				success: function (data) {
					console.log(data);
					if (data == "") {
						$('#eventsToDisplay').html("<tr>{{__('events.index_no_event_found')}}</tr>");
					} else {
                        $('#eventsToDisplay').html("");
						data.forEach(function (element)
						{
							var highlighted = ""
							if(element['isHighlighted'] == 1){
								highlighted = "<i class='fas fa-star'></i>"
							}
							var middleName = ""
							if(element['owner_middleName'] != null){
								middleName = element['owner_middleName'] + " ";
							}

							console.log(element);
                            $('#eventsToDisplay').html($("#eventsToDisplay").html()+
									"<tr><td>"+ highlighted +"</td>" +
									"<td>"+ element['id'] + "</td>" +
									"<td>"+ element['tag'] + "</td>" +
                                	"<td>"+ element['eventName'] + "</td>" +
                                	"<td>"+ element['owner_firstName'] + " "+ middleName +element['owner_lastName'] + "</td>" +
                                	"<td>"+ element['user_date'] + "</td>" +
                                	"<td>"+ element['location']['postalcode'] + " " + element['loc'] + "</td>" +
									"<td>"+ element['numberOfPeople'] + "/" + element['participants_ammount'] + "</td>" +
                                	"<td><a href='/events/"+ element['id']+"' class='button-show button-hover'>{{__('events.show')}}</a></td>" +
                                	"<td><a href='/admin/events/"+ element['id']+"/edit'class='button button-hover'>{{__('events.show_edit')}}</a></td>" +
									"<td><form method='POST' action='/admin/events/"+element['id']+"'>" +
									'@method('DELETE') @csrf' +
									"<div class='field'><div class='control'>"+
									"<button type='submit' class='button-remove button-hover'>{{__('events.show_delete')}}"+
									"</button> </div> </div> </form></td></tr>")
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