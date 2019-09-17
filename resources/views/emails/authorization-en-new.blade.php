@component('mail::message')
@component('mail::promotion')
<img src="{{ asset('images/Steigenberger_Logo.jpg') }}" alt="Steigenberger Mallorca" width="300px"/>
@endcomponent
# Cost assumption declaration - Steigenberger Hotel & Resort
{{ $mailContent['contentSalutation'] }} {{ $mailContent['contentTitle'] }} {{ $mailContent['contentFirstname'] }} {{ $mailContent['contentLastname'] }},<br>
Thank you for your inquiry.<br>
In order to help us to fulfill your wish, please click the button to settle the outstanding amount.<br>

@component('mail::button', ['url' => $mailContent['contentlink']])
Make payment now
@endcomponent

Should you have any further questions, please do not hesitate to contact us at
any time.<br>
Yours Steigenberger team
@endcomponent
