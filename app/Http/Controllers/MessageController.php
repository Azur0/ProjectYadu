<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Message;
use Auth;

class MessageController extends Controller
{
    public function index(Event $event) {
        return response()->json($event->messages()->with(['account' => function ($query) {
            return $query->select(['id', 'firstName', 'lastName']);
        }])->get());
    }

    public function store(Request $request, Event $event) {
        $message = $event->messages()->create([
           'body' => $request->body,
            'user_id' => Auth::id()
        ]);

        $message = Message::where('id', $message->id)->with('account')->first();

        return $message->toJson();
    }
}
