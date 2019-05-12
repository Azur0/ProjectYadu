<?php

namespace App\Http\Controllers;

use App\Events\EventShared;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function LogEventShared(Request $request){

        $eventid = $request['eventid'];
        $platform = $request['platform'];

        $array = array("eventid" => $eventid, "platform" => $platform);
        event(new EventShared($array));
    }
}
