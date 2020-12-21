<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    private $token;
    private $baseUrl = "http://localhost:4200";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public
    function build()
    {
        return $this->markdown('Email.mailVerification')->with(['token' => $this->token,'url'=>$this->baseUrl.'/response-mail-verification?token='.$this->token]);
    }
}