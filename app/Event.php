<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\EventDeleted;

class Event extends Model
{
    protected $fillable = ['eventName','description', 'startDate', 'status', 'location_id', 'owner_id', 'tag_id', 'numberOfPeople', 'event_picture_id'];

    protected $dispatchesEvents = [
        'deleting' => EventDeleted::class
    ];

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
        return $this->belongsToMany('App\Account', 'event_has_participants', 'event_id', 'account_id');
    }

    public function tag(){
        return $this->belongsTo('App\EventTag', 'tag_id','id');
    }
	
	public function location(){
        //return $this->hasOne('App\Location','location_id','id');
        return $this->belongsTo('App\Location','location_id','id');
        //return $this->belongsTo(Location::class);
	}
	
}
