<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;
use Hamcrest\Type\IsArray;
use Illuminate\Support\Facades\Auth;
use App\socialmedia;

class EditLinksController extends Controller
{
    public function index()
    {   
        $socialmedia = socialmedia::all();
        return view("admin.links.editLinks",compact('socialmedia'));
    }

    public function saveLinks(Request $request){
        $socialmedia = socialmedia::findOrFail($request->name);
        $socialmedia->link = $request->link;
        $socialmedia->save();
        return back();
    }
    
}