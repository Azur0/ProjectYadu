<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;

class EventEdited extends Mailable
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
        return $this->markdown('admin/mail.event-edited')
            ->subject(Lang::get('mail.subjectEventEdited'))
            ->with([
                'title' => Lang::get('mail.editTitle'),
            'salutation'=> Lang::get('mail.salutation'),
            'ownerName'=>$this->event->owner->firstName . ",",
                'body' => Lang::get('mail.editText1').$this->event->eventName . Lang::get('mail.editText2'),
                'closing' => Lang::get('mail.closing')

        ]);
    }
}
