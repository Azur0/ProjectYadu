<?php

namespace App\Http\Controllers\Management;

use App\Event;
use App\EventPicture;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\EventTag;
use App\ProhibitedWord;
use App\Account;
use Validator;
use Illuminate\Support\Carbon;
use Auth;
use App\Http\Controllers\Controller;

class ProhibitedWordController extends Controller
{
	public function index()
	{
		if (Auth::check())
		{
			if (Auth::user()->accountRole == 'Admin')
			{
                $ProhibitedWords = ProhibitedWord::orderBy('word','asc')->get();

                return view('admin.swearWords.index', compact(['ProhibitedWords']));
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