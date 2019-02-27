<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function create()
    {
        return view('events.create');
    }
    public function store()
    {
        return request()->all();
        //TODO save
        
        return redirect('/events');
    }
    public function index()
    {
        return view('events.index');
    }

}
