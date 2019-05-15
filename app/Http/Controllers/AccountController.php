<?php

namespace App\Http\Controllers;

use App\Account;
use App\BlockedUser;
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

    public function blockAccount($id){
        BlockedUser::create([
            'account_id' => Auth::id(),
            'blockedAccount_id' => $id,
        ]);
        return back();
    }

    public function unblockAccount(Request $request){
        BlockedUser::where('account_id','=',Auth::id())->where('blockedAccount_id','=',$request->id)->firstOrFail()->delete();
        return back();
    }
}
