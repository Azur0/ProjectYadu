<?php

namespace App\Listeners;

use App\Events\AccountCreatedEvent;
use App\Mail\Confirmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class AccountCreatedListener
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
     * @param  AccountCreatedEvent  $event
     * @return void
     */
    public function handle(AccountCreatedEvent $event)
    {
        Mail::to($event->account['email'])->send(
            new Confirmation($event->account)
        );
    }
}
