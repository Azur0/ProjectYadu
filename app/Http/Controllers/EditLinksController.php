<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditLinkRequest;
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

    public function saveLinks(EditLinkRequest $request){
        $socialmedia = socialmedia::findOrFail($request['name']);

        if($request['type'] == "email"){
            $socialmedia->link = $request['email'];
        }else{
            $socialmedia->link = $request['link'];
        }
        $socialmedia->save();
        
        return back();
    }
    
}