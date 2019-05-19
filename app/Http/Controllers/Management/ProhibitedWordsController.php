<?php

namespace App\Http\Controllers\Management;


use App\Http\Requests\CreateProhibitedWordRequest;
use App\ProhibitedWord;
use App\Http\Controllers\ProhibitedWordController;
use Validator;
use Auth;
use App\Http\Controllers\Controller;

class ProhibitedWordsController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->accountRole == 'Admin') {
                $ProhibitedWords = ProhibitedWord::orderBy('word', 'asc')->get();

                return view('admin.swearWords.index', compact(['ProhibitedWords']));
            } else {
                abort(403);
            }
        } else {
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

    public function update($oldWord, CreateProhibitedWordRequest $request)
    {
        if (preg_match('/^[a-z0-9 .\-]+$/i', $request->updatedProhibitedWord))
            if (!ProhibitedWord::where('word', '=', $request->updatedProhibitedWord)->exists())
                ProhibitedWordController::updateProhibitedWord($oldWord, $request->updatedProhibitedWord);

        return redirect('admin/swearWords');
    }

    public function create(CreateProhibitedWordRequest $request)
    {

        //Deze logic hoort in de request, niet in de controller. Daar zijn ze immers voor bedoeld.
//        if (preg_match('/^[a-z0-9 .\-]+$/i', $request->newProhibitedWord)) {
//            if (!ProhibitedWord::where('word', '=', $request->newProhibitedWord)->exists())
//              // Waarom?? Je hebt hier al een controller...
//                ProhibitedWordController::createProhibitedWord($request->newProhibitedWord);
//            }
//        }

        $prohibitedWord = new prohibitedWord();
        $prohibitedWord->word = $request['newProhibitedWord'];
        $prohibitedWord->save();

        return redirect('admin/swearWords');
    }
}