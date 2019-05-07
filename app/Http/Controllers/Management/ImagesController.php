<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\EventTag;
use App\EventPicture;
use App\Event;

class ImagesController extends Controller
{
    public function index()
	{
		if (Auth::check())
		{
            $tags = EventTag::all();
            $names = Event::distinct('eventName')->pluck('eventName');
            return view('admin/images.index', compact(['tags', 'names']));
		}
		else
		{
			return redirect('/login');
		}
	}
}
