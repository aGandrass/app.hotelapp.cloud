@component('mail::message')
@component('mail::promotion')
<img src="{{ asset('images/Steigenberger_Logo.jpg') }}" alt="Steigenberger Mallorca"/>
@endcomponent
# Ihr Urlaub im Steigenberger Hotel & Resort
{{ $mailContent['contentSalutation'] }} {{ $mailContent['contentTitle'] }} {{ $mailContent['contentFirstname'] }} {{ $mailContent['contentLastname'] }},<br>
wir bedanken uns für Ihre Reservierung im Steigenberger Hotel & Resort Camp de Mar.<br><br>
Um Ihren Buchungsprozess verbindlich abzuschließen, klicken Sie bitte auf den Button um Ihre
Reservierung zu bestätigen und den Rechnungsbetrag zu begleichen.<br>

@component('mail::button', ['url' => $mailContent['contentlink']])
Jetzt Zahlung vornehmen
@endcomponent

Wir wünschen Ihnen schon heute eine gute Anreise nach Mallorca,<br>
Ihr Steigenberger-Team
@endcomponent
