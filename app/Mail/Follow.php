<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;

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
        return $this->markdown('mail/follow')
            ->subject($this->user->firstName . ' ' .  Lang::get('profile.follow_request'))
            ->with([
            'ownerId'=>$this->followRequest->verification_string,
            'ownerName'=>$this->user->firstName . ' ' .  Lang::get('profile.follow_request'),
            'acceptButtonText' => Lang::get('profile.follow_request_accept'),
            'declineButtonText' => Lang::get('profile.follow_request_decline'),
        ]);
    }
}
