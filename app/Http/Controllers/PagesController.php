<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class PagesController extends Controller
{
    public function home(){
        return view('welcome');
    }

    public function about(){
        return view('about');
    }

    public function events(){
        $events = Event::take(18)->get();
        return view('events', compact('events'));
    }
}
