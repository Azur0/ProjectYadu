<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gender;

class AccountController extends Controller
{
	public function create()
	{
		$genders = \App\Gender::all();

		return view('auth.register')->with('genders', $genders);;
	}
}
