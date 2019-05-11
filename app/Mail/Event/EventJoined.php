<?php

namespace App\Mail\Event;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;

class EventJoined extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $event;
    public $user;
    public $executor;
    public function __construct($event,$user,$executor)
    {
        $this->event = $event;
        $this->user = $user;
        $this->executor = $executor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $bodyText = "";
        if($this->executor == 1){
            $bodyText = Lang::get('mail.joinedEvent') ." ". $this->event->name ."". Lang::get('mail.event');
        }else if($this->event->owner->id == $this->user->id){
            $bodyText = $this->user->firstName ." ". Lang::get('mail.joinedYourEvent');
        }else{
            $bodyText = $this->user->firstName ." ".Lang::get('mail.participantJoinedEvent') . " " . $this->event->name;
        }

        return $this->markdown('mail/event.event-joined')->with([
            'salutation'=> Lang::get('mail.salutation'),
            'name'=>$this->user->firstName,
            'bodyText'=>$bodyText
        ]);
    }
}
