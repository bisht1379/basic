<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $ccEmails;
    public $bccEmails;

    public function __construct($subject, $body, $ccEmails = [], $bccEmails = [])
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->ccEmails = $ccEmails;
        $this->bccEmails = $bccEmails;
    }

    public function build()
    {
        $mail = $this->from('softmail@ccscomputers.co.in', 'ANUKUL')
                     ->subject($this->subject)
                     ->html($this->body);

        // Add CC and BCC if provided
        if (!empty($this->ccEmails)) {
            $mail->cc($this->ccEmails);
        }

        if (!empty($this->bccEmails)) {
            $mail->bcc($this->bccEmails);
        }

        return $mail;
    }
}
