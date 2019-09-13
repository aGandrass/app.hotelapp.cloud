@component('mail::message')
@component('mail::promotion')
<img src="{{ asset('/images/Steigenberger_Mallorca_logo.jpg') }}" alt="Steigenberger Mallorca"/>
@endcomponent
# Sus vacaciones en el hotel Steigenberger Hotel & Resort
{{ $mailContent['contentSalutation'] }} {{ $mailContent['contentTitle'] }} {{ $mailContent['contentFirstname'] }} {{ $mailContent['contentLastname'] }},<br>
le agradecemos su reserva en el hotel Steigenberger Hotel & Resort Camp de Mar.<br><br>
Para finalizar el proceso de su reserva, haga click en el botón y así confirmar los datos y abonar el importe de la misma.<br>

@component('mail::button', ['url' => $mailContent['contentlink']])
Realizar el pago ahora
@endcomponent

Desde ya le deseamos una feliz estancia en Mallorca.<br>
El equipo de Steigenberger
@endcomponent
