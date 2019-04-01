<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param $account
     */

    public $information;

    public function __construct($account)
    {
        $this->information['mail'] = $account->mail;
        $this->information['gender'] = $account->gender;
        $this->information['middleName'] = $account->middleName;
        $this->information['lastName'] = $account->lastName;
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
