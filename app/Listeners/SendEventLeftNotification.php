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
        $executor = Account::findOrFail($event->userId);
        $this->sendMailToExecutor($event,$executor);
        $this->sendMailToOwner($event,$executor);
        $this->sendMailToParticipants($event,$executor);
        $this->sendMailToFollowers($event,$executor);
    }

    private function sendMailToExecutor($event,$executor){
        Mail::to($executor->email)->send(
            new EventLeftMail($event->event,$executor,$executor,1)
        );
    }

    private function sendMailToOwner($event,$executor){
        Mail::to($event->event->owner->email)->send(
            new EventLeftMail($event->event,$event->event->owner,$executor,0)
        );
    }

    private function sendMailToParticipants($event,$executor){
        if($event->event->participants->count() >0){
            foreach($event->event->participants as $participant){
                $isNotAFollower = true;
                foreach($executor->followers as $follower){
                    if($follower->follower_id == $participant->id){
                        if($follower->status == 'accepted'){
                            $isNotAFollower = false;
                        }
                    }
                }
                if($participant->id != $executor->id && $participant->id != $event->event->owner->id && $isNotAFollower){
                    Mail::to($participant->email)->send(
                        new EventLeftMail($event->event,$participant,$executor,0)
                    );
                }
            }
        }
    }

    private function sendMailToFollowers($event,$executor){
        if($executor->followers->count() >0){
            foreach($executor->followers as $follower){
                if($follower->status == 'accepted') {
                    $follower = $follower->follower;
                    if ($follower->id != $executor->id && $follower->id != $event->event->owner->id) {
                        Mail::to($follower->email)->send(
                            new EventLeftMail($event->event, $follower, $executor, 0)
                        );
                    }
                }
            }
        }
    }
}
