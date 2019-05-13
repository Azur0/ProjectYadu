<?php

namespace App\Http\Controllers\Management;

use App\Event;
use App\EventPicture;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\EventTag;
use App\Account;
use Validator;
use Illuminate\Support\Carbon;
use Auth;
use App\Http\Controllers\Controller;

class SwearWordsController extends Controller
{
	public function index()
	{
		if (Auth::check())
		{
			if (Auth::user()->accountRole == 'Admin')
			{
				return view('admin/swearWords.index', compact(['tags', 'names'],'events'));
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