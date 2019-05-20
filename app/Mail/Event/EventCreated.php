<?php

namespace App\Mail\Event;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;

class EventCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $event;
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail/event.event-created')
            ->subject(Lang::get('mail.subjectEventCreated'))
            ->with([
                'title' => Lang::get('mail.eventCreatedTitle'),
                'salutation'=> Lang::get('mail.salutation'),
                'ownerName'=>$this->event->owner->firstName,
                'body' => Lang::get('mail.eventCreatedText1')
                    .$this->event->eventName,
                'closing' => Lang::get('mail.closing')
        ]);
    }
}
