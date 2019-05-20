<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountSettings;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditProfileRequest;
use Illuminate\Http\Request;
use App\Gender;
use App\Event;
use App\EventHasParticipants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class AccountController extends Controller
{
	public function create()
	{
		$genders = \App\Gender::all();

		return view('auth.register')->with('genders', $genders);
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

    public function updateSettings(Request $request, $id){
        if (Auth::check())
        {
            $validator = Validator::make($request->all(),
                [
                    'FollowNotificationCreateEvent' => 'nullable|string',
                    'FollowNotificationJoinEvent' => 'nullable|string',
                    'NotificationInvite' => 'nullable|string',
                    'NotificationEventEdited' => 'nullable|string',
                    'NotificationEventDeleted' => 'nullable|string',
                ]);
            if ($validator->fails())
            {
                return redirect("")
                    ->withErrors($validator)
                    ->withInput();
            }

            $FollowNotificationCreateEvent = 0;
            if($request['FollowNotificationCreateEvent'] == "on")
            {
                $FollowNotificationCreateEvent = 1;
            }
            $FollowNotificationJoinEvent = 0;
            if($request['FollowNotificationJoinEvent'] == "on")
            {
                $FollowNotificationJoinEvent = 1;
            }
            $NotificationInvite = 0;
            if($request['NotificationInvite'] == "on")
            {
                $NotificationInvite = 1;
            }
            $NotificationEventEdited = 0;
            if($request['NotificationEventEdited'] == "on")
            {
                $NotificationEventEdited = 1;
            }
            $NotificationEventDeleted = 0;
            if($request['NotificationEventDeleted'] == "on")
            {
                $NotificationEventDeleted = 1;
            }


            $account = Account::where('id', $id)->firstorfail();
            $accountSettings = AccountSettings::where('account_id', $id)->firstorfail();

            $accountSettings->update(
                [
                    'FollowNotificationCreateEvent' => $FollowNotificationCreateEvent,
                    'FollowNotificationJoinEvent' => $FollowNotificationJoinEvent,
                    'NotificationInvite' => $NotificationInvite,
                    'NotificationEventEdited' => $NotificationEventEdited,
                    'NotificationEventDeleted' => $NotificationEventDeleted,
                ]
            );
            $genders = Gender::all();
            return view('profile.edit', compact(['account', 'genders']));
        }
    }

    public function deleteAccount(){

	    $ID = Auth::user()->id;
        Auth::logout();

        $this->deleteAccountFromId($ID);

        return redirect('/');
    }

    public static function deleteAccountFromId($id)
    {
        $account = Account::where('id', $id)->firstOrFail();

        $account->email = $id;
        $account->password = '';
        $account->firstname = encrypt('Deleted user');
        $account->middlename = encrypt(null);
        $account->lastname = encrypt(null);
        $account->avatar = null;
        $account->isDeleted = 1;
        $account->bio = null;
        $account->remember_token = null;

        $account->save();
    }

}
