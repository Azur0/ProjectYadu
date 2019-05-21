<?php

namespace Illuminate\Auth\Notifications;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;

class VerifyEmail extends Notification
{
    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('activationmail.email_reset_password_title'))
            ->greeting(Lang::getFromJson(Crypt::decrypt($this->user['firstName'])))
            ->line(Lang::getFromJson('activationmail.email_reset_password_start'))
            ->action(
                Lang::getFromJson('activationmail.email_reset_password_action'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('activationmail.email_reset_password_instruction'))
            ->line(Lang::getFromJson(' '))
            ->line(Lang::getFromJson('activationmail.email_reset_password_closing'))
            ->salutation(Lang::getFromJson('activationmail.email_reset_password_signee'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
        );
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
