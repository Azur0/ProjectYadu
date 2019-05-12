@component('mail::message')

    # {{$ownerName . ' ' . __('profile.follow_request')}}
    

    <a href="accept">{{__('profile.follow_request_accept')}}</a>
    <a href="decline">{{__('profile.follow_request_decline')}}</a>

@endcomponent
