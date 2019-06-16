<?php

namespace App\Http\Controllers;

use App\Account;
use App\EventPicture;
use App\Event;
use App\BlockedUser;
use App\Events\EventJoined;
use App\Events\EventLeft;
use App\EventHasParticipants;
use App\Http\Controllers\API\LocationController;
use App\Traits\DateToText;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\EventTag;
use Illuminate\Support\Facades\App;
use Validator;
use Illuminate\View\View;
use function PhpParser\filesInDir;
use Illuminate\Support\Carbon;
use App\Location;
use Auth;
use App\AccountHasFollowers;


class EventsController extends Controller
{
    use DateToText;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = EventTag::all();
        $names = Event::distinct('eventName')->pluck('eventName');
        return view('events.index', compact(['tags', 'names']));
    }

    public function welcome()
	{
        $blockedUsers = [];
        $UsersBlockedYou = [];

        if(Auth::id()){
            $blockedUsers = BlockedUser::where('account_id', '=', Auth::id())->pluck('blockedAccount_id');
            $UsersBlockedYou = BlockedUser::where('blockedAccount_id', '=', Auth::id())->pluck('account_id');
        }

		$events = Event::take(6)
            ->where('isDeleted', '==', 0)
            ->whereNotIn('owner_id', $blockedUsers)
            ->whereNotIn('owner_id', $UsersBlockedYou)
			->orderBy('isHighlighted', 'desc')
			->orderBy('startDate', 'desc')
            ->get();
            
		$regular_events = Event::take(3)
            ->where('isDeleted', '==', 0)
            ->whereNotIn('owner_id', $blockedUsers)
            ->whereNotIn('owner_id', $UsersBlockedYou)
			->where('isHighlighted', '==', 0)
			->orderBy('startDate', 'desc')
			->get();

		foreach($events as $event)
		{
			$event->city = $event->location->locality;
			$event->writtenDate = self::dateToShortText($event->startDate);
		}
		foreach($regular_events as $event)
		{
			$event->city = $event->location->locality;
			$event->writtenDate = self::dateToShortText($event->startDate);
		}
		
		return view('welcome', compact('events', 'regular_events'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        if (Auth::check() && Auth::user()->hasVerifiedEmail()) {
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
            'people' => 'required', //TODO: min en max nog doen
            'tag' => 'required',
            'startDate' => 'required|date|after:now',
            'startTime' => 'required',
            'lng' => 'required|max:45',
            'lat' => 'required|max:45',
            'houseNumber' => 'required|max:10',
            'postalCode' => 'required|max:45',
            'location' => 'required',
            'route'=> 'required',
            'locality' => 'required',
            'picture' => 'required'
        ]);

        $request['startDate'] = $request['startDate'] . ' ' . $request['startTime'];

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

        $location = Location::create([
            'locLongtitude' => $request['lng'],
            'locLatitude' => $request['lat'],
            'houseNumber' => $request['houseNumber'],
            'postalcode' => str_replace(' ', '', $request['postalCode']),
            'route' => $request['route'],
            'locality' => $request['locality'],
        ]);

        Event::create(
            [
                'eventName' => $request['activityName'],
                'description' => $request['description'],
                'startDate' => $request['startDate'],
                'numberOfPeople' => $request['people'],
                'tag_id' => $request['tag'],
                'location_id' => $location->id,
                'owner_id' => auth()->user()->id,
                'event_picture_id' => $request['picture']
            ]
        );
        return redirect('/events');
    }

    public function isPictureValid($tag, $picture)
    {
        if (!EventPicture::where('id', '=', $picture)->exists()) {
            return true;
        } else {
            $eventPicture = EventPicture::all()->where('id', '=', $picture)->pluck('tag_id');
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
        $follow = null;
        if(Auth::check()){
            $follow = AccountHasFollowers::where('account_id', $event->owner_id)->where('follower_id', Auth::id())->first();
        }
        $event->writtenDate = $this->dateToLongText($event->startDate);
        return view('events.show', compact('event', 'follow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if ($event->owner_id == Auth::id()) {
            $data = array(
                'event' => $event,
                'tags' => EventTag::all(),
                'picture' => EventPicture::all()
            );

            $datetime = explode(' ', $event->startDate);

            $event->startDate = $datetime[0];

            $event->startTime = $datetime[1];


            return view('events.edit', compact('data'));
        } else {
            abort(403);
        }
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

        $validator = Validator::make($request->all(), [
            'activityName' => 'required|max:30',
            'description' => 'required|max:150',
            'numberOfPeople' => 'required', //TODO: min en max nog doen
            'tag' => 'required',
            'startDate' => 'required|date|after:now',
            'startTime' => 'required',
            'lng' => 'required|max:45',
            'lat' => 'required|max:45',
            'houseNumber' => 'required|max:10',
            'postalCode' => 'required|max:45',
            'route'=> 'required',
            'locality' => 'required',
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
            $location = Location::where('id', $event->location_id)->firstorfail();
            $event->update(
                [
                    'eventName' => $request['activityName'],
                    'description' => $request['description'],
                    'startDate' => $request['startDate'],
                    'numberOfPeople' => $request['numberOfPeople'],
                    'tag_id' => $request['tag'],
                    'event_picture_id' => $request['picture']
                ]
            );
            
            $location->update([
                'locLongtitude' => $request['lng'],
                'locLatitude' => $request['lat'],
                'houseNumber' => $request['houseNumber'],
                'postalcode' => str_replace(' ', '', $request['postalCode']),
                'route'=> $request['route'],
                'locality' => $request['locality'],
            ]);

            return redirect('/events');
        }
        else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        if($event->owner_id == Auth::id()) {
            $event->update([
                'isDeleted' => 1
            ]);;
        }

        return redirect('account/myevents');
    }

    public function join($id)
    {

        if (Auth::user()->hasVerifiedEmail()) {
            $event = Event::findOrFail($id);
            if (!$event->participants->contains(auth()->user()->id) && ($event->owner->id != auth()->user()->id)) {
                $event->participants()->attach(auth()->user()->id);
                event(new EventJoined($event,auth()->user()->id));
            }
            //TODO: Add error 'You already joined!'
        }
        //TODO: Add error 'You are not logged in!'
        return redirect('/events/' . $id);
    }

    public function leave($id)
    {
        if (Auth::check()) {
            $event = Event::findOrFail($id);
            if ($event->participants->contains(auth()->user()->id) && ($event->owner->id != auth()->user()->id)) {
                $event->participants()->detach(auth()->user()->id);
                event(new EventLeft($event,auth()->user()->id));
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
        return $events = $locationController->areWithinReach($events, $this->distance);
    }

    private $distance = 0;

    public function actionDistanceFilter(Request $request)
    {

        $tags = EventTag::where('tag', 'like', '%' . $request->inputTag . '%')->pluck('id');
        $names = Event::where('eventName', 'like', '%' . $request->inputName . '%')->pluck('id');
        $pageNumber= $request->pageNumber;

        $blockedUsers = [];
        $UsersBlockedYou = [];
        if(Auth::id()){
            $blockedUsers = BlockedUser::where('account_id', '=', Auth::id())->pluck('blockedAccount_id');
            $UsersBlockedYou = BlockedUser::where('blockedAccount_id', '=', Auth::id())->pluck('account_id');
        }
        

        $this->distance = $request->input('distance');
        $unfiltered_events = Event::where('isDeleted', '==', 0)
            ->where('startDate', '>=', $this->formatDate())
            ->whereNotIn('owner_id', $blockedUsers)
            ->whereNotIn('owner_id', $UsersBlockedYou)
            ->whereIn('id', $names)
            ->whereIn('tag_id', $tags)
            ->orderBy('startDate', 'asc')
            ->take(24)->skip(($pageNumber-1)*24)->get();

        $events = new Collection();

        $filtered_events = $this->areEvenstInRange($unfiltered_events);

        foreach ($filtered_events as $event) {
            $date = self::dateToShortText($event->startDate);

            $postalcode = $event->location->locality;

            $Picture = eventPicture::where('id', '=', $event->event_picture_id)->get();
            $Pic = (base64_encode($Picture[0]->picture));

            $event->setAttribute('picture', $Pic);
            $event->setAttribute('loc', $postalcode);
            $event->setAttribute('date', $date);
            $events->push($event);
        }
        $events2 = Event::where('isDeleted', '==', 0)
        ->where('startDate', '>=', $this->formatDate())
        ->whereNotIn('owner_id', $blockedUsers)
        ->whereNotIn('owner_id', $UsersBlockedYou)
        ->whereIn('id', $names)
        ->whereIn('tag_id', $tags)->get();
        $data = array();
        $data['events'] = $events;
        $data['total_length'] = count($events2);
        
        return json_encode($data);
    }
}