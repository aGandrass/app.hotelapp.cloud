<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailContent)
    {
        $this->mailContent = $mailContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->mailContent['contentType'] == "room")
        {
            switch ($this->mailContent['contentLang'])
            {
                case "de":
                return $this->subject('Ihr Urlaub im Steigenberger Golf & Spa Resort')
                    ->markdown('emails.payment-invitation-de')
                    ->with('mailContent', $this->mailContent);
                break;

                case "en":
                return $this->subject('Your holiday at the Steigenberger Golf & Spa Resort')
                    ->markdown('emails.payment-invitation-en')
                    ->with('mailContent', $this->mailContent);
                break;

                case "es":
                return $this->subject('Sus vacaciones en el hotel Steigenberger Golf & Spa Resort')
                    ->markdown('emails.payment-invitation-es')
                    ->with('mailContent', $this->mailContent);
                break;
            }
        }
        elseif ($this->mailContent['contentType'] == "authorization")
        {
            switch ($this->mailContent['contentLang'])
            {
                case "de":
                return $this->subject('Kostenübernahme - Steigenberger Golf & Spa Resort')
                    ->markdown('emails.authorization-de')
                    ->with('mailContent', $this->mailContent);
                break;

                case "en":
                return $this->subject('Cost assumption declaration - Steigenberger Golf & Spa Resort')
                    ->markdown('emails.authorization-en')
                    ->with('mailContent', $this->mailContent);
                break;

                case "es":
                return $this->subject('Declaración de garantía de costes - Steigenberger Golf & Spa Resort')
                    ->markdown('emails.authorization-es')
                    ->with('mailContent', $this->mailContent);
                break;
            }
        }



    }
}
