@component('mail::message')

# {{$ownerName . ' ' . __('profile.follow_request')}}
    
@component('mail::button', ['url' => URL::to('/') . '/profile/' . $ownerId . '/accept', 'color' => 'success'])
{{__('profile.follow_request_accept')}}
@endcomponent

@component('mail::button', ['url' => URL::to('/') . '/profile/' . $ownerId . '/decline', 'color' => 'error'])
{{__('profile.follow_request_decline')}}
@endcomponent

@endcomponent
