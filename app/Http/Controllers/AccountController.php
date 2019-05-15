<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditProfileRequest;
use Illuminate\Http\Request;
use App\Gender;
use App\Event;
use App\EventHasParticipants;
use App\AccountHasFollowers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Mail\Follow as FollowMail;


class AccountController extends Controller
{
	public function publicProfile($id)
	{
		$isFollowing = false;
		$account = Account::where('id', $id)->firstOrFail();
		$myEvents = Event::where('owner_id', $id)->where('isDeleted', '==', 0);
		if($account->id != Auth::user()->id)
		{


			$isFollowing = true;
		}

		return view('accounts.public_profile', compact('account','isFollowing','myEvents'));
	}

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
}
