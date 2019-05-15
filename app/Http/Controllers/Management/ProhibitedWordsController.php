<?php

namespace App\Http\Controllers\Management;


use App\Http\Requests\AddProhibitedWordRequest;
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
            ProhibitedWordController::deleteProhibitedWord($word);
        } else {
            return Redirect::back()->with('adminError', __('validation.Delete_ProhibitedWord_error'));
        }

        return redirect('admin/swearWords');
    }

    public function update($oldWord, AddProhibitedWordRequest $request)
    {
//        print_r($oldWord);
//        print_r(" ");
//        print_r($request->updatedProhibitedWord);

        if(!ProhibitedWord::where('word', '=', $request->updatedProhibitedWord)->exists())
            ProhibitedWordController::updateProhibitedWord($oldWord, $request->updatedProhibitedWord);

        return redirect('admin/swearWords');
    }

    public function create(AddProhibitedWordRequest $request)
    {
        if(!ProhibitedWord::where('word', '=', $request->newProhibitedWord)->exists())
            ProhibitedWordController::createProhibitedWord($request->newProhibitedWord);

        return redirect('admin/swearWords');
    }
}