<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountSettings;
use App\Gender;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function edit(){

        $genders = Gender::all();
        $account = Account::where('id', Auth::id())
            ->firstOrFail();

        return view('profile.edit', compact(['account', 'genders']));
    }

    public function update(Request $request, $id){
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
}