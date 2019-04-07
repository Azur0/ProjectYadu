@component('mail::message')


{{$information['mail']}}

<h1>Geachte {{$information['gender']}}, {{$information['middleName']}} {{$information['lastName']}}</h1>

<p>
    Dit e-mailtje is naar aanleiding van uw registratie bij Yadu.
    <br>
    Doormiddel van de onderstaande link kan u zich registeren.
</p>

<!-- activation link -->
@component('mail::button', ['url' => ''])

    Activeer account
@endcomponent

<p>
    De activatie dient gedaan te worden binnen vierentwintig uur
    <br>
    anders vervalt het account.
</p>

<p>
    Met vriendelijk groet van,
    <br>
    Yadu
</p>
@endcomponent
