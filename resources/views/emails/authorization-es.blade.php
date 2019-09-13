@component('mail::message')
@component('mail::promotion')
<img src="{{ asset('/images/Steigenberger_logo.jpg') }}" alt="Steigenberger Mallorca"/>
@endcomponent
# Declaración de garantía de costes - Steigenberger Hotel & Resort
{{ $mailContent['contentSalutation'] }} {{ $mailContent['contentTitle'] }} {{ $mailContent['contentFirstname'] }} {{ $mailContent['contentLastname'] }},<br>
le agradecemos su consulta.<br>
Para poder atender su deseo correctamente, haga clic en el botón y así liquidar la cantidad pendiente de pago.<br>

@component('mail::button', ['url' => $mailContent['contentlink']])
Realizar el pago ahora
@endcomponent

Para atender cualquier otra consulta o deseo estamos a su disposición.<br>
El equipo de Steigenberger
@endcomponent
