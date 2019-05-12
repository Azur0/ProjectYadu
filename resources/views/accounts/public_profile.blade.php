@extends('/layouts/app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<div id="user_avatar">
								<img src="data:image/png;base64,{{ chunk_split(base64_encode($account->avatar)) }}">
								<div>
									{{ $account->firstName }} {{ $account->middleName }} {{ $account->lastName }}
								</div>
							</div>
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="col">
									@if($account->id != Auth::user()->id)
										<form>
										@if($account)
											<i class="fas fa-user-plus"></i> Follow
										@else
											<i class="fas fa-user-plus"></i> Unfollow
										@endif
										</form>
									@endif
								</div>
								<div class="w-100 d-none d-md-block"></div>
								<div class="col">
									<div class="row align-items-end">
										<div id="account_tabs">							
											<ul><!--nav nav-tabs-->
												@if( $account->id == Auth::user()->id )
													<li class="active"><a href=""><i class="fas fa-user"></i> My Info</a></li>
													<li><a href="/account/{{ $account->id }}/profile/Events"><i class="fas fa-calendar-alt"></i> My Events</a></li>
													<li><a href="/account/{{ $account->id }}/profile/Events"><i class="fas fa-calendar-alt"></i> Participating</a></li>
													<li><a href="/account/{{ $account->id }}/profile/Followers"><i class="fas fa-users"></i> Followers</a></li>
													<li><a href="/account/{{ $account->id }}/profile/Following"><i class="fas fa-user-friends"></i> Following</a></li>
												@else
													@if($account->infoVisibility == 'public' || ($account->infoVisibility == 'follower' && $isFollowing == true))
														<li class="active"><a href=""><i class="fas fa-user"></i> Info</a></li>
													@endif

													@if($account->eventsVisibility == 'public' || ($account->eventsVisibility == 'follower' && $isFollowing == true))
														<li><a href="/account/{{ $account->id }}/profile/Events"><i class="fas fa-calendar-alt"></i> Events</a></li>
													@endif
													
													@if($account->participatingVisibility == 'public' || ($account->participatingVisibility == 'public' && $isFollowing == true))
														<li><a href="/account/{{ $account->id }}/profile/Events"><i class="fas fa-calendar-alt"></i> Participating</a></li>
													@endif
													
													@if($account->followerVisibility == 'public' || ($account->followerVisibility == 'follower' && $isFollowing == true))
														<li><a href="/account/{{ $account->id }}/profile/Followers"><i class="fas fa-users"></i> Followers</a></li>
													@endif
													
													@if($account->followingVisibility == 'public' || ($account->followingVisibility == 'follower' && $isFollowing == true))
														<li><a href="/account/{{ $account->id }}/profile/Following"><i class="fas fa-user-friends"></i> Following</a></li>
													@endif
												@endif
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection