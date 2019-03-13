<?php

namespace App\Http\Controllers;

use App\Account;
use App\EventPicture;
use App\Event;
use App\Http\Controllers\API\LocationController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\EventTag;
use Validator;
use Illuminate\View\View;
use function PhpParser\filesInDir;
use Illuminate\Support\Carbon;
use App\Location;
use Auth;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unfiltered_events = Event::where('isDeleted', '==', 0)
            ->where('startDate', '>=', $this->formatDate())
            ->orderBy('startDate', 'asc')
            ->get();

        //TODO: Set initial amount of items to load and add 'load more' button

        $events = new Collection();
        foreach ($unfiltered_events as $event) {
            if ($this->isEventInRange($event)) {
                $events->push($event);
            }
        }

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()) {
        //
        $Tags = EventTag::all();
        $Picture = EventPicture::all();
        return view('events.create')->withtags($Tags)->withpictures($Picture);
        }
        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $eventPicture = EventPicture::all()->where('id','==',  $picture)->pluck('tag_id');
        if($eventPicture[0] != $tag){
            return true;
        }
        return false;
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
        if(Auth::check()) {
            $event = Event::findOrFail($id);
            if (!$event->participants->contains(auth()->user()->id) && ($event->owner->id != auth()->user()->id)) {
                $event->participants()->attach(auth()->user()->id);
            }
            //TODO: Add error 'You already joined!'
        }
        //TODO: Add error 'You are not logged in!'
        return redirect('/events/' . $event->id);
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
    private function isEventInRange(Event $event)
    {
        $locationController = new LocationController();
        $shouldBeShown = $locationController->isWithinReach($event, $this->distance);
        if ($shouldBeShown) {
            return true;
        }
        return false;
    }

    private $distance = 0;

    public function actionDistanceFilter(Request $request)
    {

        $this->distance = $request->input('distance');

        $unfiltered_events = Event::where('isDeleted', '==', 0)
            ->where('startDate', '>=', $this->formatDate())
            ->orderBy('startDate', 'asc')
            ->get();

        //TODO: Set initial amount of items to load and add 'load more' button

        $events = new Collection();
        foreach ($unfiltered_events as $event) {
            if ($this->isEventInRange($event)) {
                $date = self::dateToText($event->startDate);

                $postalcode = self::cityFromPostalcode($event->Location->postalcode);

                $Picture = eventPicture::where('id', '=', $event->event_picture_id)->get();
                $Pic = (base64_encode($Picture[0]->picture));

                $event->setAttribute('picture', $Pic);
                $event->setAttribute('loc', $postalcode);
                $event->setAttribute('date', $date);
                $events->push($event);
            }
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
