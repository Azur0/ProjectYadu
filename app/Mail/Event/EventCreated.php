<?php

namespace App\Mail\Event;

use DateInterval;
use Faker\Provider\DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;
use App\Traits\DateToText;

class EventCreated extends Mailable
{
    use Queueable, SerializesModels,DateToText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $event;
    public $user;
    public function __construct($event,$user)
    {
        $this->event = $event;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail/event.event-created')
            ->subject(Lang::get('mail.eventCreatedTitle'))
            ->with([
                'title' => Lang::get('mail.eventCreatedTitle'),
                'salutation'=> Lang::get('mail.salutation'),
                'userName'=>$this->user->firstName . ",",
                'body' => Lang::get('mail.eventCreatedText1')
                    .$this->event->eventName,
                'infoTitle' => Lang::get('mail.eventInfoTitle'),
                'eventName' => Lang::get('events.show_title'). ": " . $this->event->eventName,
                'eventDate' => Lang::get('events.show_date').": " . \Carbon\Carbon::parse($this->event->startDate)
                        ->format(__('formats.dateTimeFormat')),
                'ownerName' => Lang::get('mail.eventOwner').": " . $this->event->owner->firstName,
                'numberOfPeople' => Lang::get('events.show_attendees_amount').": " . $this->event->participants->count(),
                'description' => Lang::get('events.show_description').": " . $this->event->description,
                'closing' => Lang::get('mail.closing')
        ]);
    }
}
