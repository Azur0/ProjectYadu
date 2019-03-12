<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    protected $fillable = ['eventName', 'description', 'startDate', 'status', 'location_id', 'owner_id', 'tag', 'numberOfPeople'];

    public function eventPicture()
    {
        return $this->hasOne('App\EventPicture', 'id', 'event_picture_id');
    }

    public function owner()
    {
        return $this->belongsTo('App\Account', 'owner_id', 'id');
    }

    public function participants()
    {
        return $this->belongsToMany('App\Account', 'event_has_patricipants', 'event_id', 'account_id');
        //TODO: Fix the typo of patricipants
    }
	
	public function location(){
        return $this->belongsTo(Location::class);
	}
	
}
