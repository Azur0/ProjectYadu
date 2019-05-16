@extends('/layouts/public_profile')

@section('profilecontent')
<div class="row">
	<div class="col">
		<h3>info</h3>
		<p>naam: {{ $account->firstName }} {{ $account->middleName }} {{ $account->lastName }}</p>
		<p>role: {{ $account->accountRole }}</p>
	</div>
	<div class="col">
		<h3>stats</h3>
		<p>events hosted: </p>
		<p>events participated: </p>
	</div>
</div>
@endsection