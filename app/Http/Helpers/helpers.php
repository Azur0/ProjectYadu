<?php

use App\SharedEvent;

function LogShareEvent($eventid, $platform){
    event(new SharedEvent($eventid, $platform));
}