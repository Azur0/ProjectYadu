<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;

class EventDeleted extends Mailable
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
        return $this->markdown('admin/mail.event-deleted')
            ->subject(Lang::get('mail.subjectEventDeleted'))
            ->with([
                'title' => Lang::get('mail.deleteTitle'),
            'salutation'=> Lang::get('mail.salutation'),
            'userName'=>$this->event->userName . ",",
                'body' => Lang::get('mail.deleteText1').$this->event->eventName . Lang::get('mail.deleteText2'),
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
