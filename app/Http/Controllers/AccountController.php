<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountSettings;
use App\BlockedUser;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\EditPrivacySettingsRequest;
use Illuminate\Http\Request;
use App\Gender;
use App\Event;
use App\EventHasParticipants;
use App\AccountHasFollowers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;
use Validator;
use App\Mail\Follow as FollowMail;


class AccountController extends Controller
{
	public function profileInfo($id, $contentType)
	{
		$account = Account::where('id', $id)->firstOrFail();
		if($account->id != Auth::user()->id)
		{
			$follow = AccountHasFollowers::where('account_id', $account->id)->where('follower_id', Auth::id())->first();
		}
		else
		{
			$follow = [];
		}

		switch ($contentType)
		{
			case 'events':
				$privacy = $account->eventsVisibility;

				if($account->id == Auth::id() || $privacy == 'public' || ($privacy == 'follower' && $follow->status == "accepted"))
				{
					$events = Event::all()->where('owner_id', auth()->user()->id)->where('isDeleted', '==', 0);

					return view('accounts.profile.events', compact('account','follow','events'));
				}
				else
				{
					return abort(403);
				}
							
				break;
			case 'participating':
				$privacy = $account->participatingVisibility;

				if($account->id == Auth::id() || $privacy == 'public' || ($privacy == 'follower' && $follow->status == "accepted"))
				{
					$events = array();
					$part = EventHasParticipants::get()->where('account_id', '==', $account->id);

					foreach($part as $par)
					{
						$event = Event::find($par->event_id);
						if($event->isDeleted == 0)
						{
							array_push($events, Event::find($par->event_id));
						}
					}

					return view('accounts.profile.participating', compact('account','follow','events'));
				}
				else
				{
					return abort(403);
				}
				break;
			case 'followers':
				$privacy = $account->followerVisibility;

				if($account->id == Auth::id() || $privacy == 'public' || ($privacy == 'follower' && $follow->status == "accepted"))
				{
					$followers = array();
					$get = AccountHasFollowers::get()->where('account_id', $account->id)->where('status', 'accepted');
					foreach($get as $fol)
					{
						array_push($followers, Account::find($fol->follower_id));
					}
					return view('accounts.profile.followers', compact('account','follow','followers'));
				}
				else
				{
					return abort(403);
				}
				break;
			case 'following':
				$privacy = $account->followingVisibility;

				if($account->id == Auth::id() || $privacy == 'public' || ($privacy == 'follower' && $follow->status == "accepted"))
				{
					$following = array();
					$get = AccountHasFollowers::get()->where('follower_id', $account->id)->where('status', 'accepted');
					foreach($get as $fol)
					{
						array_push($following, Account::find($fol->account_id));
					}
					return view('accounts.profile.following', compact('account','follow','following'));
				}
				else
				{
					return abort(403);
				}
				break;
			case 'info':
				$stats = array(0,0,0,0);

				$stats[0] = sizeof(Event::get()->where('owner_id', '==', $account->id));
				$stats[1] = sizeof(EventHasParticipants::get()->where('account_id', '==', $account->id));
				$stats[2] = sizeof(AccountHasFollowers::get()->where('account_id', '==', $account->id)->where('status', '==', 'accepted'));
				$stats[3] = sizeof(AccountHasFollowers::get()->where('follower_id', '==', $account->id)->where('status', '==', 'accepted'));

				return view('accounts.profile.info', compact('account','follow','stats'));
				break;
			default:
			return redirect('/account/'.$id.'/profile/info');
		}
	}

	public function create()
	{
		$genders = \App\Gender::all();

		return view('auth.register')->with('genders', $genders);
	}

	public function edit()
	{
		$genders = Gender::all();
		$account = Account::where('id', Auth::id())->firstOrFail();

		return view('accounts.profile.edit', compact(['account', 'genders']));
	}

	public function changePassword(ChangePasswordRequest $request)
	{
		$validated = $request->validated();

		$account = Account::where('id', Auth::id())->firstOrFail();
		$account->password = Hash::make($validated['newPassword']);
		$account->save();

		return redirect('/profile/edit');
	}

	public function activateAccount() {
		return redirect('/')->with('activationsuccess', 'test');
	}

	public function updateProfile(EditProfileRequest $request)
	{
		$account = Account::where('id', Auth::id())->firstOrFail();

		if($request['gender'] == "-")
		{
			$account->gender = null;
		}
		else
		{
			$account->gender = $request['gender'];
		}

		$account->email = $request['email'];
		$account->firstName = $request['firstName'];
		$account->middleName = $request['middleName'];
		$account->lastName = $request['lastName'];
		$account->dateOfBirth = $request['dateOfBirth'];

		$account->save();

		return redirect('/profile/edit');
	}

	public function updatePrivacySettings(EditPrivacySettingsRequest $request)
	{
		$account = Account::where('id', Auth::id())->firstOrFail();

		$account->followerVisibility = $request['followerVisibility'];
		$account->followingVisibility = $request['followingVisibility'];
		$account->infoVisibility = $request['infoVisibility'];
		$account->eventsVisibility = $request['eventsVisibility'];
		$account->participatingVisibility = $request['participatingVisibility'];

		$account->save();

		return redirect('/profile/edit');
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

	public function follow($id) {
		if($id == Auth::id()) {
			return redirect('/');
		}
		else {
			$account = Account::where('id', $id)->first();

			try {
				$followRequest = AccountHasFollowers::create([
					'account_id' => $id,
					'follower_id' => Auth::id()
			]);
			} catch (\Exception $exception){
				return back()->withError($exception->getMessage());
			}

			Mail::to($account->email)->send(new FollowMail(Auth::user()));
		}

		return back();
	}

	public function accept($id) {
		$followRequest = AccountHasFollowers::where('account_id', Auth::id())->where('follower_id', $id)->first();
		if(!is_null($followRequest)) {
			if($followRequest->status == 'pending') {
				$followRequest->status = 'accepted';
				$followRequest->save();
			}
		}

		return redirect('/');
	}

    public function updateSettings(Request $request, $id){
        if (Auth::check())
        {
            $validator = Validator::make($request->all(),
                [
                    'FollowNotificationCreateEvent' => 'nullable|string',
                    'FollowNotificationJoinAndLeaveEvent' => 'nullable|string',
                    'NotificationEventEdited' => 'nullable|string',
                    'NotificationEventDeleted' => 'nullable|string',
                    'NotificationJoinAndLeaveEvent' => 'nullable|string',
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
            $FollowNotificationJoinAndLeaveEvent = 0;
            if($request['FollowNotificationJoinAndLeaveEvent'] == "on")
            {
                $FollowNotificationJoinAndLeaveEvent = 1;
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
            $NotificationJoinAndLeaveEvent = 0;
            if($request['NotificationJoinAndLeaveEvent'] == "on")
            {
                $NotificationJoinAndLeaveEvent = 1;
            }

            $account = Account::where('id', $id)->firstorfail();
            $accountSettings = AccountSettings::where('account_id', $id)->firstorfail();

            $accountSettings->update(
                [
                    'FollowNotificationCreateEvent' => $FollowNotificationCreateEvent,
                    'FollowNotificationJoinAndLeaveEvent' => $FollowNotificationJoinAndLeaveEvent,
                    'NotificationEventEdited' => $NotificationEventEdited,
                    'NotificationEventDeleted' => $NotificationEventDeleted,
                    'NotificationJoinAndLeaveEvent' => $NotificationJoinAndLeaveEvent,
                ]
            );
            return back();
        }
    }

	public function decline($id) {
		$followRequest = AccountHasFollowers::where('account_id', Auth::id())->where('follower_id', $id)->first();
		
		if(!is_null($followRequest)) {
			if($followRequest->status == 'pending') {
				$followRequest->status = 'rejected';
				$followRequest->save();
			}
		}


		return redirect('/');
	}

	public function unfollow($id) {
		$unfollowRequest = AccountHasFollowers::where('account_id', $id)->where('follower_id', Auth::id())->first();
		$unfollowRequest->delete();

		return back();
	}

	public function blockAccount(Request $request){
		$request->validate([
			'id' => 'required',
		]);
		if(Auth::id()!=$request['id']){

			if(Auth::user()->followers->pluck('id')->contains($request->id)){
				AccountHasFollowers::where('account_id', '=', Auth::id())->where('follower_id', '=', $request->id)->delete();
			}

			if(Auth::user()->following->pluck('id')->contains($request->id)){
				AccountHasFollowers::where('follower_id', '=', Auth::id())->where('account_id', '=', $request->id)->delete();
			}

			BlockedUser::create([
				'account_id' => Auth::id(),
				'blockedAccount_id' => $request->id,
			]);
			return back();
		}
		return abort(404);
	}

	public function unblockAccount(Request $request){
		$request->validate([
			'id' => 'required',
		]);
		if(Auth::id()!=$request['id']){
			BlockedUser::where('account_id','=',Auth::id())->where('blockedAccount_id','=',$request->id)->firstOrFail()->delete();
			return back();
		}
		return abort(404);
	}

}
