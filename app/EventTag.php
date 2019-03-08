<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTag extends Model
{
    public function eventPictures()
    {
        return $this->hasMany(EventPicture::class);
    }
}
