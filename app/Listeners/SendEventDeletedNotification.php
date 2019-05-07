<?php

namespace App\Listeners;


use App\Events\EventDeleted;
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
    public function handle(EventDeleted $event)
    {
        Mail::to($event->event->owner->email)->send(
            new EventDeletedMail($event->event)
        );
        if($event->event->participants->count() >0){
            foreach($event->event->participants as $participant){
                $event->event->owner->firstName = $participant->firstName;
                Mail::to($participant->email)->send(
                    new EventDeletedMail($event->event)
                );
            }
        }
    }
}
