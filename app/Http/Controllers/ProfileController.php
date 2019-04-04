<?php

namespace App\Http\Controllers;

use App\Account;
use App\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function edit($id){

        $this->isAuthorized($id);
        $genders = Gender::all();
        $account = Account::where('id', $id)
            ->firstOrFail();

        return view('profile.edit', compact(['account', 'genders']));
    }

    private function isAuthorized(int $id){
        if(Auth::id() == $id){
            return true;
        }

        //Return Status code - 401: Unauthorized
        return abort(401);
    }
}