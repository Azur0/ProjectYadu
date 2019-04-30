<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check())
		{
			if (Auth::user()->accountRole == 'Admin')
			{
				return view('admin.index');
			}
			else
			{
				abort(403);
			}
		}
		else
		{
			return redirect('/login');
		}
    }


}
