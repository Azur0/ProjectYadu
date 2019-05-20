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
}