<?php

namespace App\Http\Controllers;

use App\Account;
use App\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function edit($id){

        isAuthorized($id);
        $genders = Gender::all();
        $account = Account::where('id', $id)
            ->firstOrFail();

        return view('profile.edit', compact(['account', 'genders']));
    }
}