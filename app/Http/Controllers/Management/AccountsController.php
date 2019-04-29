<?php

namespace App\Http\Controllers\Management;

use App\AccountRole;
use App\Http\Controllers\AccountController;
use function foo\func;
use Illuminate\Database\Eloquent\Collection;
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

            return view('admin.accounts.index', compact(['accounts']));
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

            AccountController::deleteAccountFromId($id);

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

    public function action(Request $request)
    {
        $string = $request['inputName'];

        $accounts = Account::where('isDeleted', '0')
            ->where(function ($query) use ($string) {
                return $query->where('email', 'like', '%' . $string . '%')
                    ->orWhere('accountRole', $string);
            });


        $accounts = $accounts->get();


        foreach ($accounts as $account) {
            $account['fullName'] = $account['firstName'] . " " . $account['middleName'] . " " . $account['lastName'];


            $account['avatar'] = base64_encode($account['avatar']);

            if ($account['email_verified_at'] != null) {
                $account['email_verified_at'] = "<span class=\"text-success\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i></span>";
            } else {
                $account['email_verified_at'] = "<span class=\"text-danger\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span>";
            }

//            $account['created_at'] = date('d-m-Y', strtotime($account['created_at']));

            $account['url'] = url('/admin/accounts/' . $account['id']);
        }

        return json_encode($accounts);
    }
}
