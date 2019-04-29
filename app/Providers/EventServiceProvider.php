<?php

namespace App\Providers;

use App\Events\AccountCreatedEvent;
use App\Listeners\AccountCreatedListener;
use App\Events\EventDeleted;
use App\Events\EventEdited;
use App\Listeners\SendEventDeletedNotification;
use App\Listeners\SendEventEditedNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        EventDeleted::class => [
            SendEventDeletedNotification::class,
        ],

        EventEdited::class => [
            SendEventEditedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
