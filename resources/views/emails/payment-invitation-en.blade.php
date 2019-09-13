@component('mail::message')
@component('mail::promotion')
<img src="{{ asset('/images/Steigenberger_Mallorca_logo.jpg') }}" alt="Steigenberger Mallorca"/>
@endcomponent
# Your holiday at the Steigenberger Hotel & Resort
{{ $mailContent['contentSalutation'] }} {{ $mailContent['contentTitle'] }} {{ $mailContent['contentFirstname'] }} {{ $mailContent['contentLastname'] }},<br>
We thank you for your reservation at the Steigenberger Hotel & Resort Camp de Mar.<br><br>
To complete the booking process bindingly, please click on the button to confirm your reservation and to pay the invoice amount.<br>

@component('mail::button', ['url' => $mailContent['contentlink']])
Make payment now
@endcomponent

Already today we wish you a pleasant journey to Majorca.<br>
Yours Steigenberger team
@endcomponent
