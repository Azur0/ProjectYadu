<?php

namespace App\Http\Controllers\Management;


use App\ProhibitedWord;
use App\Http\Controllers\ProhibitedWordController;
use Validator;
use Auth;
use App\Http\Controllers\Controller;

class ProhibitedWordsController extends Controller
{
	public function index()
	{
		if (Auth::check())
		{
			if (Auth::user()->accountRole == 'Admin')
			{
                $ProhibitedWords = ProhibitedWord::orderBy('word','asc')->get();

                return view('admin.swearWords.index', compact(['ProhibitedWords']));
			}
			else
			{
				abort(403);
			}
		}
		else
		{
			return redirect('/login');
		}
	}

    public function destroy($word)
    {
        if (ProhibitedWord::where('word', $word)->firstOrFail()->accountRole != 'Admin') {
            ProhibitedWordController::deleteAccountFromId($word);
        } else {
            return Redirect::back()->with('adminError', __('validation.Delete_ProhibitedWord_error'));
        }

        return redirect('admin/swearWords');
    }
}