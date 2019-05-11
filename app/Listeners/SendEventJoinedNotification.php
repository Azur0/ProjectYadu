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
        //TODO: Mail owner that someone joined his event -- You joined this event mail
        $user = Account::findOrFail($event->userId);
        Mail::to($user->email)->send(
            new EventJoinedMail($event->event,$user,0)
        );

        //TODO: Mail owner that someone joined his event -- Someone joined your event mail
        Mail::to($event->event->owner->email)->send(
            new EventJoinedMail($event->event,$event->event->owner,1)
        );

        //TODO: Mail the rest that someone joined that event -- Someone joined this event mail
        if($event->event->participants->count() >0){
            foreach($event->event->participants as $participant){
                if($participant->id != $user->id && $participant->id != $event->event->owner->id){
                    $event->event->owner->firstName = $participant->firstName;
                    Mail::to($participant->email)->send(
                        new EventJoinedMail($event->event,$participant,0)
                    );
                }
            }
        }

        //TODO: Mail if someone you follow joined?

        //TODO: Mail The people who follow you?
    }
}
