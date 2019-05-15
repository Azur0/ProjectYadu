@extends('/layouts/public_profile')

@section('profilecontent')
<div class="row">
	<h3>follow</h3>

	@foreach( $account->following as $following)
		<div id="user_avatar">
			<img src="data:image/png;base64,{{ chunk_split(base64_encode($account->avatar)) }}">
			<div>
				{{ $account->firstName }} {{ $account->middleName }} {{ $account->lastName }}
			</div>
		</div>
	@endforeach
</div>

@endsection