<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function eventPicture()
    {
        return $this->hasOne(EventPicture::class, 'id');
    }
}
