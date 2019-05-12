<?php

namespace App\Listeners;

use App\SharedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\EventShared;
use Illuminate\Support\Facades\Auth;

class LogEventShared
{
    public function __construct()
    {
        //
    }

    public function handle(EventShared $event)
    {
        $userid = 0;

        if(Auth::check()){
            $userid = Auth::id();
        }

        $sharedEvent = new SharedEvent();
        $sharedEvent->eventid = $event->eventid;
        $sharedEvent->userid = $userid;
        $sharedEvent->platform = $event->platform;

        $sharedEvent->save();
    }
}
