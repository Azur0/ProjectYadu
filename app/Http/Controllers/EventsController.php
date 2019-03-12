<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\EventTag;
use App\EventPicture;
use Validator;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events.index');
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
        $Picture = EventPicture::all();
        return view('events.create')->withtags($Tags)->withpictures($Picture);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
                'status' => 'bezig',
                'description' => $request['description'],
                'startDate' => $request['startDate'],
                'numberOfPeople' => $request['people'],
                'tag_id' => $request['tag'],
                'location_id' => '1',
                'owner_id' => '1',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}