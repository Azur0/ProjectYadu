<?php

use App\Events\EventShared;

function LogShareEvent($eventid, $platform){
    $array = array("eventid" => $eventid, "platform" => $platform);
    event(new EventShared($array));
}