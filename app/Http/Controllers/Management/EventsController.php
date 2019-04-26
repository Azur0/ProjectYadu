<?php

namespace App\Http\Controllers\Management;

use App\Event;
use App\EventPicture;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\EventTag;
use Validator;
use Illuminate\Support\Carbon;
use Auth;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$events = Event::all();
        $tags = EventTag::all();
        $names = Event::distinct('eventName')->pluck('eventName');
        return view('admin/events.index', compact(['tags', 'names'],'events'));
    }

    public function welcome()
    {
        $events = Event::all();
        return view('welcome', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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

        //TODO: Set initial amount of items to load and add 'load more' button
        $events = new Collection();

        //TODO:3 Filters from Ruben

        //TODO:2 Filter the unfiltered events (Or so called pre-filtered events)
        //$filtered_events = $this->areEvenstInRange($unfiltered_events);

        foreach ($unfiltered_events as $event) {
            $date = self::dateToText($event->startDate);

            $postalcode = self::cityFromPostalcode($event->Location->postalcode);

            $Picture = eventPicture::where('id', '=', $event->event_picture_id)->get();
            $Pic = (base64_encode($Picture[0]->picture));

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
