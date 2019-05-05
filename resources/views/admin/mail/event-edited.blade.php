@component('mail::message')

    # {{__('mail.editTitle')}}

    {{$salutation . $ownerName}}

    {{__('mail.editText1') . $event->eventName . __('mail.editText2')}}

    {{__('mail.closing')}}

@endcomponent
