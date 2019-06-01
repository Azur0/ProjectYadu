<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Follow extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $followRequest;
    public function __construct($user,$followRequest)
    {
        $this->user = $user;
        $this->followRequest = $followRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail/follow')->with([
            'ownerId'=>$this->followRequest->verification_string,
            'ownerName'=>$this->user->firstName
        ]);
    }
}
