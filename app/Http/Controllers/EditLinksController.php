<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;
use Hamcrest\Type\IsArray;
use Illuminate\Support\Facades\Auth;

class EditLinksController extends Controller
{
    public function index()
    {   
        return view("admin.links.editLinks");
    }

    public function saveLinks(Request $request){
        return redirect('/admin');
    }
    
}
