@component('mail::message')
#{{$title}}

{{$salutation}} {{$ownerName}}

{{$body}}

{{$closing}}
@endcomponent
