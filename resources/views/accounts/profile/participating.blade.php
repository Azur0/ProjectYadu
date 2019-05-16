@extends('/layouts/public_profile')

@section('profilecontent')
<div class="row">
	<div class="col">
		<h3>participating</h3>
		<div class="row">
			<div class="col">
			
			@foreach( $events as $event)
						
			@endforeach
			</div>
		</div>
	</div>
</div>
@endsection