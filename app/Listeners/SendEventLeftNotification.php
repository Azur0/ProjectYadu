<?php

namespace App\Listeners;

use App\Events\EventLeft;
use Illuminate\Support\Facades\Mail;
use App\Mail\Event\EventLeft as EventLeftMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Account;

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
        //TODO: Mail owner that someone left his event -- You left this event mail
        $user = Account::findOrFail($event->userId);
        Mail::to($user->email)->send(
            new EventLeftMail($event->event,$user)
        );

        //TODO: Mail owner that someone left his event -- Someone left your event mail
        Mail::to($event->event->owner->email)->send(
            new EventLeftMail($event->event,$event->event->owner)
        );

        //TODO: Mail the rest that someone left that event -- Someone left this event mail
        if($event->event->participants->count() >0){
            foreach($event->event->participants as $participant){
                if($participant->id != $user->id && $participant->id != $event->event->owner->id){
                    $event->event->owner->firstName = $participant->firstName;
                    Mail::to($participant->email)->send(
                        new EventLeftMail($event->event,$participant)
                    );
                }
            }
        }

        //TODO: Mail if someone you follow left?
    }
}
