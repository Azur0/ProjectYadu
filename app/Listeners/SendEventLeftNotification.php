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
        //Mail owner that someone left his event -- You left this event mail
        $executor = Account::findOrFail($event->userId);
        //dd($executor->followers);
        Mail::to($executor->email)->send(
            new EventLeftMail($event->event,$executor,$executor,1)
        );

        //TODO: Mail owner that someone left his event -- Someone left your event mail
        /*
        Mail::to($event->event->owner->email)->send(
            new EventLeftMail($event->event,$event->event->owner,$executor,0)
        );
        */
        //Mail the rest that someone left that event -- Someone left this event mail
        if($event->event->participants->count() >0){
            foreach($event->event->participants as $participant){
                //TODO: check of follower request is accepted - to test
                $isNotAFollower = true;
                if($executor->followers->containts($participant)){
                    foreach($executor->followers as $follower){
                        if($follower->follower_id == $participant->id){
                            if($follower->status == 'accepted'){
                                $isNotAFollower = false;
                            }
                        }
                    }
                }
                if($participant->id != $executor->id && $participant->id != $event->event->owner->id && $isNotAFollower){
                    //$event->event->owner->firstName = $participant->firstName;
                    Mail::to($participant->email)->send(
                        new EventLeftMail($event->event,$participant,$executor,0)
                    );
                }
            }
        }

        //Mail if someone you follow left?
        if($executor->followers->count() >0){
            foreach($executor->followers as $follower){
                //TODO: check of follower request is accepted - to test
                if($follower->status == 'accepted') {
                    $follower = $follower->follower;
                    if ($follower->id != $executor->id && $follower->id != $event->event->owner->id) {
                        // $event->event->owner->firstName = $follower->firstName;
                        Mail::to($follower->email)->send(
                            new EventLeftMail($event->event, $follower, $executor, 0)
                        );
                    }
                }
            }
        }
    }
}
