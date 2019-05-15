<?php

namespace App\Mail\Event;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;

class EventLeft extends Mailable
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
    public $type;
    public function __construct($event,$user,$executor,$type)
    {
        $this->event = $event;
        $this->user = $user;
        $this->executor = $executor;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $bodyText = "";
        if($this->type == 1){
            $bodyText = Lang::get('mail.leftEvent') ." ". $this->event->eventName ."". Lang::get('mail.event');
        }else if($this->event->owner->id == $this->user->id){
            $bodyText =
                $this->executor->firstName ." ". Lang::get('mail.leftYourEvent') . " " . $this->event->eventName ;
        }else {
            $bodyText =
                $this->executor->firstName ." ".Lang::get('mail.participantLeftEvent') . " " . $this->event->eventName;
        }

        return $this->markdown('mail/event.event-left')
            ->subject(Lang::get('mail.subjectEventLeft'))
            ->with([
            'headText' =>  Lang::get('mail.eventLeftHeader'),
            'salutation'=> Lang::get('mail.salutation'),
            'name'=>$this->user->firstName . ",",
            'bodyText'=>$bodyText
        ]);
    }
}
