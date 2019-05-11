<?php

namespace App\Listeners;

use App\Events\AccountEdited;
use Illuminate\Support\Facades\Mail;
use App\Mail\Account\AccountEdited as AccountEditedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAccountEditedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AccountEdited  $event
     * @return void
     */
    public function handle(AccountEdited $event)
    {
        Mail::to($event->account->email)->send(
            new AccountEditedMail($event->account)
        );
    }
}
