<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
	public function create()
	{
		$genders = \App\Gender::all();

		return view('auth.register', ['genders' => $genders]);
	}

    public function store()
    {
    	$values = request()->validate([
    		'firstName' => ['Min:5','Max:45','Required'],
    		'middleName' => ['Min:5','Max:45'],
    		'lastName' => ['Min:5','Max:45'],
    		'dateOfBirth' => 'Date',
    		'email' => ['E-Mail','Required']
    	]);

    	Account::create($values);

    	redirect('/login');
    }

    
}
