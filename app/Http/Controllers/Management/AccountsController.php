<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;

class AccountsController extends Controller
{

    public function index()
    {

        $accounts = Account::all();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function show($id)
    {
        $account = Account::where('id', $id)->firstOrFail();

        return view('admin.accounts.show', compact('account'));
    }
}
