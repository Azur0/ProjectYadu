<?php

namespace App\Http\Controllers\Management;

use App\AccountRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Gender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Validator;

class AccountsController extends Controller
{

    public function index()
    {
        if (Auth::check() && Auth::user()->accountRole == 'Admin') {
            $accounts = Account::where('isDeleted', '0')->get();
            $deletedAccounts = Account::where('isDeleted', '1')->get();

            return view('admin.accounts.index', compact(['accounts', 'deletedAccounts']));
        } else {
            abort(403);
        }
    }

    public function show($id)
    {
        if (Auth::check() && Auth::user()->accountRole == 'Admin') {
            $account = Account::where('id', $id)->firstOrFail();

            $genders = Gender::all();

            $accountRoles = AccountRole::all();

            return view('admin.accounts.show', compact(['account', 'genders', 'accountRoles']));
        } else {
            abort(403);
        }
    }

    public function activate($id)
    {
        if (Auth::check() && Auth::user()->accountRole == 'Admin') {
            $account = Account::where('id', $id)->firstOrFail();

            $account->email_verified_at = date('Y-m-d H:i:s');

            $account->save();

            return Redirect::back();
        } else {
            abort(403);
        }
    }

    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->accountRole == 'Admin') {
            $account = Account::where('id', $id)->firstOrFail();

            $account->isDeleted = 1;

            $account->save();

            return redirect('admin/accounts');
        } else {
            abort(403);
        }
    }

    public function restore($id)
    {
        if (Auth::check() && Auth::user()->accountRole == 'Admin') {
            $account = Account::where('id', $id)->firstOrFail();

            $account->isDeleted = 0;

            $account->save();

            return redirect('admin/accounts');
        } else {
            abort(403);
        }
    }

    public function update($id)
    {
        if (Auth::check() && Auth::user()->accountRole == 'Admin') {
            $account = Account::where('id', $id)->firstOrFail();

            request()->validate([
                'email' => 'required|email',
                'firstName' => 'required',
                'accountRole' => 'required',
            ]);

            $account->email = request()->email;
            $account->firstName = request()->firstName;
            $account->middleName = request()->middleName;
            $account->lastName = request()->lastName;
            $account->dateOfBirth = request()->dateOfBirth;
            $account->accountRole = request()->accountRole;

            if (request()->gender == "-") {
                $account->gender = null;
            } else {
                $account->gender = request()->gender;
            }

            $account->save();

            return redirect('admin/accounts');
        } else {
            abort(403);
        }
    }
}
