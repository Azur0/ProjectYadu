@extends('/layouts/app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div id="user_header" class="row">
						<div class="col-md-3">
							<div id="user_avatar">
								<img src="data:image/png;base64,{{ chunk_split(base64_encode($account->avatar)) }}">
								<div>
									{{ $account->firstName }} {{ $account->middleName }} {{ $account->lastName }}
								</div>
							</div>
						</div>
						<div class="col-md-9">
							<div id="user_header_interactable" class="row">
								<div class="col">
									@if($account->id != Auth::user()->id)
										@if(is_null($follow))
											<a href="/profile/{{$account->id}}/follow" class="btn btn-info btn-sm my-auto mx-2">
												<i class="fas fa-user-plus"></i> {{ __('profile.follow') }}
											</a>
										@elseif($follow->status == "pending")
											<a href="#" class="btn btn-info btn-sm my-auto mx-2" disabled>
												{{ __('profile.follow_pending') }}
                    						</a>
										@elseif($follow->status == "accepted")
										<a href="/profile/{{$account->id}}/unfollow" class="btn btn-info btn-sm my-auto mx-2">
										<i class="fas fa-user-minus"></i> {{ __('profile.unfollow') }}
                    					</a>
										@endif
										@if (session('error'))
                        					<div class="alert alert-danger">Request already sent</div>
                    					@endif
									@endif
								</div>
							</div>
							<div id="user_header_tabs" class="row align-items-end">
								<div class="col">
									<div id="account_tabs">
										<ul><!--nav nav-tabs-->
											@if( $account->id == Auth::user()->id )
												<li><a href="/account/{{ $account->id }}/profile/info"><i class="fas fa-user"></i> {{__('profile.head_me_info')}}</a></li>
												<li><a href="/account/{{ $account->id }}/profile/events"><i class="fas fa-calendar-alt"></i> {{__('profile.head_my_events')}}</a></li>
												<li><a href="/account/{{ $account->id }}/profile/participating"><i class="fas fa-calendar-alt"></i> {{__('profile.head_participating')}}</a></li>
												<li><a href="/account/{{ $account->id }}/profile/followers"><i class="fas fa-users"></i> {{__('profile.head_followers')}}</a></li>
												<li><a href="/account/{{ $account->id }}/profile/following"><i class="fas fa-user-friends"></i> {{__('profile.head_following')}}</a></li>
											@else
												@if($account->infoVisibility == 'public' || ($account->infoVisibility == 'follower' && $follow->status == "accepted"))
													<li><a href="/account/{{ $account->id }}/profile/info"><i class="fas fa-user"></i> {{__('profile.head_info')}}</a></li>
												@endif

												@if($account->eventsVisibility == 'public' || ($account->eventsVisibility == 'follower' && $follow->status == "accepted"))
													<li><a href="/account/{{ $account->id }}/profile/events"><i class="fas fa-calendar-alt"></i> {{__('profile.head_events')}}</a></li>
												@endif
												
												@if($account->participatingVisibility == 'public' || ($account->participatingVisibility == 'public' && $follow->status == "accepted"))
													<li><a href="/account/{{ $account->id }}/profile/participating"><i class="fas fa-calendar-alt"></i> {{__('profile.head_participating')}}</a></li>
												@endif
												
												@if($account->followerVisibility == 'public' || ($account->followerVisibility == 'follower' && $follow->status == "accepted"))
													<li><a href="/account/{{ $account->id }}/profile/followers"><i class="fas fa-users"></i> {{__('profile.head_followers')}}</a></li>
												@endif
												
												@if($account->followingVisibility == 'public' || ($account->followingVisibility == 'follower' && $follow->status == "accepted"))
													<li><a href="/account/{{ $account->id }}/profile/following"><i class="fas fa-user-friends"></i> {{__('profile.head_following')}}</a></li>
												@endif
											@endif
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				@yield('profilecontent')
				
			</div>
		</div>
	</div>
</div>
@endsection