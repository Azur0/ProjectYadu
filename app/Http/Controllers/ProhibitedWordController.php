<?php

namespace App\Http\Controllers;

use App\ProhibitedWord;
use DB;


class ProhibitedWordController extends Controller
{
    public static function deleteProhibitedWord($word)
    {
        ProhibitedWord::where('word', $word)->delete();
    }

    public static function updateProhibitedWord($oldWord, $newWord)
    {
        DB::table('prohibited_words')->where('word', $oldWord)->update(['word' => $newWord]);
    }

    public static function createProhibitedWord($word)
    {
        $prohibitedWord = new prohibitedWord;

        $prohibitedWord->word = $word;

        $prohibitedWord->save();
    }
}
