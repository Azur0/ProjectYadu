<?php

namespace App\Listeners;

use App\Events\EventJoined;
use Illuminate\Support\Facades\Mail;
use App\Mail\Event\EventJoined as EventJoinedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEventJoinedNotification
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
     * @param  EventJoined  $event
     * @return void
     */
    public function handle(EventJoined $event)
    {
        Mail::to($event->event->owner->email)->send(
            new EventJoinedMail($event->event)
        );
    }
}
