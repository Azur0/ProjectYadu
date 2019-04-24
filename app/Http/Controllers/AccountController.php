<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditProfileRequest;
use Illuminate\Http\Request;
use App\Gender;
use App\Event;
use App\EventHasParticipants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;


class AccountController extends Controller
{
	public function create()
	{
		$genders = \App\Gender::all();

		return view('auth.register')->with('genders', $genders);
	}

	public function myEvents()
	{
		if(Auth::check())
		{
			$events = Event::all()->where('owner_id', auth()->user()->id)->where('isDeleted', '==', 0);

			return view('accounts/my_events', compact('events'));
		}
		else
		{
			return redirect('/');
		}
	}

	public function participating()
	{
		if(Auth::check())
		{
			$events = array();
			$part = EventHasParticipants::get()->where('account_id', '==', auth()->user()->id);

			foreach($part as $par)
			{
				$event = Event::find($par->event_id);

				if($event->isDeleted == 0)
				{
					array_push($events, Event::find($par->event_id));
				}
			}
			return view('accounts/participating', compact('events'));
		}
		else
		{
			return redirect('/');
		}
	}

	public function changePassword(ChangePasswordRequest $request)
    {
        $validated = $request->validated();

        $account = Account::where('id', Auth::id())
            ->firstOrFail();

        $account->password = Hash::make($validated['newPassword']);

        $account->save();

        return redirect('/profile/edit');
    }

    public function updateProfile(EditProfileRequest $request)
    {
	    $validated = $request->validated();

	    $account = Account::where('id', Auth::id())->firstOrFail();

	    if($validated['gender'] == "-"){
            $account->gender = null;
        }
	    else {
            $account->gender = $validated['gender'];
        }

        $account->email = $validated['email'];
        $account->firstName = $validated['firstName'];
        $account->middleName = $validated['middleName'];
        $account->lastName = $validated['lastName'];
        $account->dateOfBirth = $validated['dateOfBirth'];

        $account->save();

        return redirect('/profile/edit');
    }


    public function deleteAccount(){

	    $ID = Auth::user()->id;
        Auth::logout();

        $account = Account::where('id', $ID)->firstOrFail();

        $account->email = $ID;
        $account->password = '';
        $account->firstname = 'Deleted user';
        $account->middlename = null;
        $account->lastname = null;
        $account->avatar = null;
        $account->isDeleted = 1;
        $account->bio = null;
        $account->remember_token = null;

        $account->save();

        return redirect('/');
    }

}
