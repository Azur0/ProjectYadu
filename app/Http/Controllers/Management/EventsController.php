<?php

namespace App\Http\Controllers\Management;

use App\Event;
use App\EventPicture;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\EventTag;
use App\Account;
use Validator;
use Illuminate\Support\Carbon;
use Auth;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    public function index()
    {
        //$events = new Collection();
    	$events = Event::all();
        $tags = EventTag::all();
        $names = Event::distinct('eventName')->pluck('eventName');
        foreach($events as $event){
            $event->city = self::cityFromPostalcode($event->Location->postalcode);
        }
        return view('admin/events.index', compact(['tags', 'names'],'events'));
    }

    public function welcome()
    {
        $events = Event::all();
        return view('welcome', compact('events'));
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->hasVerifiedEmail()) {
            $Tags = EventTag::all();
            $Picture = EventPicture::all();
            return view('events.create')->withtags($Tags)->withpictures($Picture);
        }
        return redirect('/events');
    }

    public function action(Request $request)
    {
        $Picture = EventPicture::where('tag_id', '=', $request->input('query'))->get();
        foreach ($Picture as $x) {
            $x->picture = base64_encode($x->picture);
        }
        return json_encode($Picture);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activityName' => 'required|max:30',
            'description' => 'required|max:150',
            'people' => 'required', //min en max nog doen
            'tag' => 'required',
            'startDate' => 'required|date|after:now',
            'location' => 'required',
            'picture' => 'required'
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($this->isPictureValid($request['tag'], $request['picture'])) {
                $validator->errors()->add('picture', 'Something is wrong with this field!');
            }
        });

        if ($validator->fails()) {
            return redirect('/events/create')
                ->withErrors($validator)
                ->withInput();
        }

        Event::create(
            [
                'eventName' => $request['activityName'],
                'status' => 'created',
                'description' => $request['description'],
                'startDate' => $request['startDate'],
                'numberOfPeople' => $request['people'],
                'tag_id' => $request['tag'],
                'location_id' => '1',
                'owner_id' => auth()->user()->id,
                'event_picture_id'=> $request['picture']
            ]
        );
        return redirect('/events');
    }

    public function isPictureValid($tag, $picture){
        if (!EventPicture::where('id','=',  $picture)->exists()) {
            return true;
        } else {
            $eventPicture = EventPicture::all()->where('id','=',  $picture)->pluck('tag_id');
            if ($eventPicture[0] != $tag) {
                return true;
            }
            return false;
        }
    }

    public function show(Event $event)
    {
        if( Auth() )
        {
        	
        }
        else
        {
        	return redirect('/login');
        }
        //return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        //TODO: Should find a better way
        $account = Account::where('id',Auth::id())->get();
        if ($event->owner_id == Auth::id() || $account[0]->accountRole == 'Admin') 
        {
            $data = array(
                'event' => $event,
                'tags' => EventTag::all(),
                'picture' => EventPicture::all()
            );

            $datetime = explode(' ', $event->startDate);

            $event->startDate = $datetime[0];
            $event->startTime = $datetime[1];


            return view('admin/events.edit', compact('data'));
        } 
        else
        {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'activityName' => 'required|max:30',
            'description' => 'required|max:150',
            'numberOfPeople' => 'required', //TODO: min en max nog doen
            'tag' => 'required',
            'startDate' => 'required|date|after:now',
            'startTime' => 'required',
            'location' => 'required',
            'numberOfPeople' => 'required'
        ]);


        $request['startDate'] = $request['startDate'] . ' ' . $request['startTime'];

        $validator->after(function ($validator) use ($request) {
            if ($this->isPictureValid($request['tag'], $request['picture'])) {
                $validator->errors()->add('picture', 'Something is wrong with this field!');
            }
        });

        if ($validator->fails()) {
            return redirect("/events/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $event = Event::where('id', $id)->firstorfail();

        if (Auth::id() == $event->owner_id) {
            $event->update(
                [
                    'eventName' => $request['activityName'],
                    'description' => $request['description'],
                    'startDate' => $request['startDate'],
                    'numberOfPeople' => $request['numberOfPeople'],
                    'tag_id' => $request['tag'],
                    'location_id' => '1',
                    'event_picture_id' => $request['picture']
                ]
            );
            //TODO: set location
            return redirect('/events');
        }
        else {
            abort(403);
        }
    }


    public function destroy(Event $event)
    {
        //$this->authorize('update',$event);
        $event->delete();
        return redirect('admin/events');
    }

    // Remove this later ------------------------------------------------------------
    public function join($id)
    {

        if(Auth::user()->hasVerifiedEmail()) {
            $event = Event::findOrFail($id);
            if (!$event->participants->contains(auth()->user()->id) && ($event->owner->id != auth()->user()->id)) {
                $event->participants()->attach(auth()->user()->id);
            }
            //TODO: Add error 'You already joined!'
        }
        //TODO: Add error 'You are not logged in!'
        return redirect('/events/' . $id);
    }

    // Remove this later ------------------------------------------------------------
    public function leave($id)
    {
        if(Auth::check()) {
            $event = Event::findOrFail($id);
            if ($event->participants->contains(auth()->user()->id) && ($event->owner->id != auth()->user()->id)) {
                $event->participants()->detach(auth()->user()->id);
            }
            //TODO: Add error 'You are not joined!'
        }
        //TODO: Add error 'You are not logged in!'
        return redirect('/events/' . $id);
    }
    // -------------------------------------------------------------------------------
    private function formatDate()
    {
        $date = getdate();
        $formatted_date = $date['year'] . "/";
        $formatted_date .= $date['mon'] . "/";
        $formatted_date .= $date['mday'];
        return $formatted_date;
    }

    private function areEvenstInRange($events)
    {
        $locationController = new LocationController();
        return  $events = $locationController->areWithinReach($events, $this->distance);
    }

    private $distance = 0;

    public function actionDistanceFilter(Request $request)
    {

        $tags = EventTag::where('tag', 'like', '%' . $request->inputTag .'%')->pluck('id');
        $names = Event::where('eventName', 'like', '%' . $request->inputName .'%')->pluck('id');
        $this->distance = $request->input('distance');
        $unfiltered_events = Event::where('isDeleted', '==', 0)
            ->where('startDate', '>=', $this->formatDate())
            ->whereIn('id', $names)
            ->whereIn('tag_id', $tags)
            ->orderBy('startDate', 'asc')
            ->get();

        $events = new Collection();

        foreach ($unfiltered_events as $event) {
            $date = self::dateToText($event->startDate);

            $postalcode = self::cityFromPostalcode($event->Location->postalcode);

            $Picture = eventPicture::where('id', '=', $event->event_picture_id)->get();
            $Pic = (base64_encode($Picture[0]->picture));

            $owner = Account::where('id', '=', $event->owner_id)->get();
            $eventInfo = Event::where('id', '=', $event->id)->get();
            $ammount = 0;
            if($eventInfo[0]->participants->count() != 0){
                $ammount = $eventInfo[0]->participants->count();
            }
            $userDate = "";
            //TODO found out how the lang is set in our project
            if(true){
                $userDate = \Carbon\Carbon::parse($event->startDate)->format('d/m/Y - H:i');
            }else{
                $userDate = \Carbon\Carbon::parse($event->startDate)->format('m/d/Y - H:i');
            }
            $eventTag = EventTag::where('id', '=', $event->tag_id)->get();




            $event->setAttribute('tag', $eventTag[0]['tag']);
            $event->setAttribute('user_date', $userDate);
            $event->setAttribute('participants_ammount',$ammount);
            $event->setAttribute('owner_firstName', $owner[0]['firstName']);
            $event->setAttribute('owner_middleName', $owner[0]['middleName']);
            $event->setAttribute('owner_lastName', $owner[0]['lastName']);
            $event->setAttribute('picture', $Pic);
            $event->setAttribute('loc', $postalcode);
            $event->setAttribute('date', $date);
            $events->push($event);
        }
        return json_encode($events);
    }

    public function dateToText($timestamp)
    {
        setlocale(LC_ALL, 'nl_NL.utf8');
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp);
        $formatted_date = ucfirst($date->formatLocalized('%a %d %B %Y'));
        return $formatted_date;
    }

    public function cityFromPostalcode($postalcode)
    {
        if (!self::isValidPostalcode($postalcode)) {
            return "Invalid postal code";
        }

        $url = "https://nominatim.openstreetmap.org/search?q={$postalcode}&format=json&addressdetails=1";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($result, true);
        if (isset($json[0]['address']['suburb'])) {
            return $json[0]['address']['suburb'];
        } else {
            return "City not found";
        }
    }

    public function isValidPostalcode($postalcode)
    {
        $regex = '/^([1-8][0-9]{3}|9[0-8][0-9]{2}|99[0-8][0-9]|999[0-9])[a-zA-Z]{2}$/';
        return preg_match($regex, $postalcode);
    }
}
