@component('mail::message')
    # {{__('mail.editTitle')}}

    {{$salutation . $name}}

    {{$bodyText}}

    {{__('mail.closing')}}
@endcomponent
