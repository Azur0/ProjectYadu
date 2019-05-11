<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;

class AccountEdited extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $account;
    public function __construct($account)
    {
        $this->account = $account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $bodyText = '';
        //TODO: Password changed
        if(true){
            $bodyText = '';
            //TODO: Email changed
        }else if(false){
            $bodyText = '';
            //TODO: Something else changed
        }else{
            $bodyText = '';
        }

        return $this->markdown('mail/account.account-edited')->with([
            'salutation'=> Lang::get('mail.salutation'),
            'name'=>$this->account->firstName,
            'bodyText' => $bodyText
        ]);
    }
}
