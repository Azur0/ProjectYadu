<?php

namespace App\Http\Controllers\Management;

use App\AccountRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Gender;
use Illuminate\Support\Facades\Redirect;

class AccountsController extends Controller
{

    //todo: add checks if user is the right role

    public function index()
    {

        $accounts = Account::where('isDeleted', '0')->get();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function show($id)
    {
        $account = Account::where('id', $id)->firstOrFail();

        $genders = Gender::all();

        $accountRoles = AccountRole::all();

        return view('admin.accounts.show', compact(['account', 'genders', 'accountRoles']));
    }

    public function activate($id)
    {
        $account = Account::where('id', $id)->firstOrFail();

        $account->email_verified_at = date('Y-m-d H:i:s');

        $account->save();

        return Redirect::back();
    }

    public function destroy($id)
    {
        $account = Account::where('id', $id)->firstOrFail();

        $account->isDeleted = 1;

        $account->save();

        return redirect('admin/accounts');
    }

    public function restore($id)
    {
        $account = Account::where('id', $id)->firstOrFail();

        $account->isDeleted = 0;

        $account->save();

        return redirect('admin/accounts');
    }
}
