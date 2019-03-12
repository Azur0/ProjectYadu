<?php

namespace App\Http\Controllers;

use App\Account;
use App\Event;
use App\Http\Controllers\API\LocationController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\EventTag;
use Illuminate\View\View;
use function PhpParser\filesInDir;

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
            ->where('startDate','>=', $this->formatDate())
            ->orderBy('startDate', 'asc')
            ->get();
        
        //TODO: Set initial amount of items to load and add 'load more' button

        $events = new Collection();
        foreach ($unfiltered_events as $event){
            if($this->isEventInRange($event)){
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
        //
        $Tags = EventTag::all();
        return view('events.create')->withtags($Tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
        $attributes = request()->validate([
            'activityName' => 'required|max:30',
            'description' => 'required|max:150',
            'people' => 'required', //min en max nog doen
            'tag' => 'required',
            'startDate' => 'required',
            'location' => 'required'

        ]);
        Event::create(
            [
                'eventName' => $attributes['activityName'],
                'status' => 'bezig',
                'description' => $attributes['description'],
                'startDate' => $attributes['startDate'],
                'numberOfPeople' => $attributes['people'],
                'tag' => $attributes['tag'],
                'location_id' => '1',
                'owner_id' => '1'
            ]
        );

        return redirect('/events');
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
        $event = Event::findOrFail($id);
        if (!$event->participants->contains(5)) {
            $event->participants()->attach(5); //TODO: Change the 5 to the id of the active account
        }
        return redirect('/events/' . $event->id);
        //TODO: Add error 'You already joined!'
    }

    public function leave($id)
    {
        $event = Event::findOrFail($id);
        if ($event->participants->contains(5)) {
            $event->participants()->detach(5); //TODO: Change the 5 to the id of the active account
        }
        return redirect('/events/' . $id);
        //TODO: Add error 'You already joined!'
    }

    private function formatDate(){
        $date = getdate();
        $formatted_date = $date['year'] . "/";
        $formatted_date .= $date['mon'] . "/";
        $formatted_date .= $date['mday'];
        return $formatted_date;
    }

    private function isEventInRange(Event $event){
        //Some more code is need to define the distance with the slider.
        $locationController = new LocationController();
        $shouldBeShown = $locationController->isWithinReach($event,10);
        if($shouldBeShown){
            return true;
        }
        return false;
    }
}
