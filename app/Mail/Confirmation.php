<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $information;

    /**
     * Create a new message instance.
     *
     * @param $account
     */
    public function __construct($account)
    {
        $this->information = $account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.confirmation-layout');
    }
}
