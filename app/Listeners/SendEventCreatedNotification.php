<?php

namespace App\Listeners;

use App\Events\EventCreated;
use App\Mail\Event\EventCreated as EventCreatedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEventCreatedNotification
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
     * @param  EventCreated  $event
     * @return void
     */
    public function handle(EventCreated $event)
    {
        Mail::to($event->event->owner->email)->send(
            new EventCreatedMail($event->event)
        );
    }
}
