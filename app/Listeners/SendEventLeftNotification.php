<?php

namespace App\Listeners;

use App\Events\EventLeft;
use Illuminate\Support\Facades\Mail;
use App\Mail\Event\EventLeft as EventLeftMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEventLeftNotification
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
     * @param  EventLeft  $event
     * @return void
     */
    public function handle(EventLeft $event)
    {

    }
}
