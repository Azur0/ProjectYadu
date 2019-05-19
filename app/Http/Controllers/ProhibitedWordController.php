<?php

namespace App\Http\Controllers;

use App\ProhibitedWord;
use DB;


class ProhibitedWordController extends Controller
{
    //TODO: Delete deze controller!

    public static function deleteProhibitedWord($word)
    {
        ProhibitedWord::where('word', $word)->delete();
    }

    public static function updateProhibitedWord($oldWord, $newWord)
    {
        DB::table('prohibited_words')->where('word', $oldWord)->update(['word' => $newWord]);
    }
}
