@extends('layouts/app')

@section('content')
	<div class="row">
		<div class="col">
			<h2 class="text-center">{{ __('testemonials.header_testemonials')}}</h2>
			<p class="text-center">{{ __('testemonials.header_testemonials_text')}}</p>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col testemonials">
			{{ $testemonials->links() }}
			@foreach($testemonials as $testemonial)
				<div class="testemonial2">
					<div class="row">
						<div class="col">
							@if(empty($testemonial->account_id))
								<h3>{{ $testemonial->name }}</h3>
							@else
								<h3>
									<a href="/account/{{ $testemonial->account_id }}/profile/info">
										{{ $testemonial->account->firstName }} {{ $testemonial->account->middleName }} {{ $testemonial->account->lastName }}
									</a>
								</h3>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<h6>{{ $testemonial->created_at }}</h6>
						</div>
						<div class="col-8">
							<p>&#39;{{ $testemonial->experience }}&#39;</p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endsection