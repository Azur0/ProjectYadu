<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use App\Gender;

class AccountController extends Controller
{
	public function create()
	{
		$genders = \App\Gender::all();

		return view('auth.register')->with('genders', $genders);
	}

	public function changePassword(){

    }

    public function updateProfile(){
	    //TODO: Validate input
	    isAuthorized(request()->accountId);

	    $account = Account::where('id', request()->accountId)->firstOrFail();
	    $account->gender = request()->gender;
        $account->email = request()->email;
        $account->firstName = request()->firstName;
        $account->middleName = request()->middleName;
        $account->lastName = request()->lastName;
        $account->dateOfBirth = request()->dateOfBirth;

        $account->save();

        //TODO: Redirect to success page!
        return redirect('/');
    }
}
