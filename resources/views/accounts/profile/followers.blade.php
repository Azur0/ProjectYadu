@extends('/layouts/public_profile')

@section('profilecontent')
<div class="row">
	<div class="col">
		<h3>follow</h3>

		@foreach( $account->followers as $follower)
			<div class="profile_related_user">
				<div class="avatar">
					<img src="data:image/png;base64,{{ chunk_split(base64_encode($account->avatar)) }}">
				</div>
				<div>
					
				</div>
				<div>
					{{ $follower->firstName }} {{ $follower->middleName }} {{ $follower->lastName }}
				</div>
			</div>
		@endforeach
	</div>
</div>

@endsection