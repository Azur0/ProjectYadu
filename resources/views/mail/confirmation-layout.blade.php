@component('mail::message')
# Succesfully send the mail for creation

{{$information->mail}}

<!-- activation link -->
@component('mail::button', ['url' => ''])
    Activeer account
@endcomponent

Dankje wel ,<br>
{{ config('app.name') }}
@endcomponent
