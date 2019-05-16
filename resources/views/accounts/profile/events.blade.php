@extends('/layouts/public_profile')

@section('profilecontent')
<div class="row">
	<div class="col">
		<h3>events hosted by {{ $account->firstName }}</h3>

	</div>
</div>

@endsection