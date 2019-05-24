<?php

namespace App\Listeners;

use App\Events\EventDeleted;
use App\Events\EventEdited;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\EventDeleted as EventDeletedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEventDeletedNotification
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
     * @param  EventDeleted  $event
     * @return void
     */
    public function handle(EventEdited $event)
    {
        if($event->event->isDeleted == 1) {
            $event->event->userName = $event->event->owner->firstName;
            Mail::to($event->event->owner->email)->send(
                new EventDeletedMail($event->event)
            );
            if ($event->event->participants->count() > 0) {
                foreach ($event->event->participants as $participant) {
                    if ($participant->id != $event->event->owner->id) {
                        $event->event->userName = $participant->firstName;
                        Mail::to($participant->email)->send(
                            new EventDeletedMail($event->event)
                        );
                    }
                }
            }
        }
    }
}
