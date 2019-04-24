<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventHasParticipants;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = Event::where('owner_id', auth()->user()->id)->where('isDeleted', '==', 0)->take(5)->get();
        $participation = array();        
        $part = EventHasParticipants::get()->where('account_id', '==', auth()->user()->id);

        foreach($part as $par)
		{
			$event = Event::find($par->event_id);

			if($event->isDeleted == 0)
			{
				array_push($participation, $event);
			}
		}
        return view('home', compact('events','participation'));
    }
}
