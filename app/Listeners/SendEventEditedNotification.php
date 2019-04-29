<?php

namespace App\Listeners;

use App\Events\EventEdited;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\EventEdited as EventEditedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEventEditedNotification
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
     * @param  EventEdited  $event
     * @return void
     */
    public function handle(EventEdited $event)
    {
        Mail::to($event->event->owner->email)->send(
            new EventEditedMail($event->event)
        );
    }
}
