@component('mail::message')
@component('mail::promotion')
<img src="{{ asset('images/Steigenberger_Logo.jpg') }}" alt="Steigenberger Mallorca" width="300px"/>
@endcomponent
# Kostenübernahme - Steigenberger Hotel & Resort
{{ $mailContent['contentSalutation'] }} {{ $mailContent['contentTitle'] }} {{ $mailContent['contentFirstname'] }} {{ $mailContent['contentLastname'] }},<br>
wir bedanken uns für Ihre Anfrage.<br>
Damit wir Ihren Wünschen gerecht werden können, klicken Sie bitte auf den Button, um den offenen Rechnungsbetrag zu begleichen.<br>

@component('mail::button', ['url' => $mailContent['contentlink']])
Jetzt Zahlung vornehmen
@endcomponent

Für Wünsche oder Fragen stehen wir Ihnen jederzeit<br>gerne zur Verfügung,<br>
Ihr Steigenberger-Team
@endcomponent
