<?php

namespace App\Listeners;

use App\Events\EventCreated;
use App\Mail\Event\EventCreated as EventCreatedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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
            new EventCreatedMail($event->event,$event->event->owner)
        );

        //TODO: for when followers is merged - test this
        /*
        foreach($event->event->owner->follower as $follower){
            if($follower->status == 'accepted'){
                Mail::to($follower->follower->email)->send(
                    new EventCreatedMail($event->event,$follower->follower)
                );
            }
        }
        */
    }
}
