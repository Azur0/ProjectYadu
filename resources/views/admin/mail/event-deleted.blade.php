@component('mail::message')

# {{__('mail.deleteTitle')}}
{{$salutation . $ownerName}}

{{__('mail.deleteText1') . $event->eventName . __('mail.deleteText2')}}

{{__('mail.closing')}}

@endcomponent
