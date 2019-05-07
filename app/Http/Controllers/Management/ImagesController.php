<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    public function index()
	{
		if (Auth::check())
		{
			return view('admin/images.index');  
		}
		else
		{
			return redirect('/login');
		}
	}
}
