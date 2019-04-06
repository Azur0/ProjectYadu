<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gender;
use App\Event;
use Auth;

class AccountController extends Controller
{
	public function create()
	{
		$genders = \App\Gender::all();

		return view('auth.register')->with('genders', $genders);;
	}

	public function myEvents()
	{
		if(Auth::check())
		{
			$events = Event::all()->where('owner_id', auth()->user()->id);

			return view('accounts/my_events', compact('events'));
		}
		else
		{
			return redirect('/');
		}
	}

	public function participating()
	{
		if(Auth::check())
		{
			$events = Event::all()->where('owner_id', auth()->user()->id);

			return view('accounts/participating', compact('events'));
		}
		else
		{
			return redirect('/');
		}
	}
}
