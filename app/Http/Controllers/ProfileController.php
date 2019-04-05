<?php

namespace App\Http\Controllers;

use App\Account;
use App\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function edit(){

        //If this function is called from POST request use the requests userId
        if(request()->userId != null){
            $userId = request()->userId;
        } else{
            //If the function is called from a GET request get the userId from Auth
            $userId = Auth::id();
        }

        isAuthorized($userId);

        $genders = Gender::all();
        $account = Account::where('id', $userId)
            ->firstOrFail();

        return view('profile.edit', compact(['account', 'genders']));
    }
}