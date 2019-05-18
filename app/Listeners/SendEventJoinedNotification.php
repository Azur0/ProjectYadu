<?php

namespace App\Listeners;

use App\Events\EventJoined;
use Illuminate\Support\Facades\Mail;
use App\Mail\Event\EventJoined as EventJoinedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Account;

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
        //Mail owner that someone joined his event -- You joined this event mail
        $executor = Account::findOrFail($event->userId);

        Mail::to($executor->email)->send(
            new EventJoinedMail($event->event,$executor,$executor,1)
        );

        //TODO: Mail owner that someone joined his event -- Someone joined your event mail
        /*
        Mail::to($event->event->owner->email)->send(
            new EventJoinedMail($event->event,$event->event->owner,$executor,0)
        );
        */
        //Mail the rest that someone joined that event -- Someone joined this event mail
        if($event->event->participants->count() >0){
            foreach($event->event->participants as $participant){
                //TODO: check of follower request is accepted

                if($participant->id != $executor->id && $participant->id != $event->event->owner->id && !$executor->followers->containts($participant)){
                    $event->event->owner->firstName = $participant->firstName;
                    Mail::to($participant->email)->send(
                        new EventJoinedMail($event->event,$participant,$executor,0)
                    );
                }
            }
        }

        //Mail if someone you follow joined?
        if($executor->followers->count() >0){
            foreach($executor->followers as $follower){
                //TODO: check of follower request is accepted

                if($follower->id != $executor->id && $follower->id != $event->event->owner->id){
                    $event->event->owner->firstName = $follower->firstName;
                    Mail::to($follower->email)->send(
                        new EventJoinedMail($event->event,$follower,$executor,0)
                    );
                }
            }
        }
    }
}
