<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = ['activityName','description', 'startDate', 'status', 'location_id', 'owner_id'];
}
