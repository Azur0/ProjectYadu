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

    public function contact(){
        return view('contact');
    }

    public function events(){

        $events = Event::where('startDate','>=', $this->formatDate())->take(18)->get();
        return view('events', compact('events'));
    }

    private function formatDate(){
        //TODO Should private functions be here?
        $date = getdate();
        $formatted_date = $date['year'] . "/";
        $formatted_date .= $date['mon'] . "/";
        $formatted_date .= $date['mday'];
        return $formatted_date;
    }
}
