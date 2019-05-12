<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function LogEventShared($eventid, $platform){
        dd("hello");
        $array = array("eventid" => $eventid, "platform" => $platform);
        event(new EventShared($array));
    }
}
