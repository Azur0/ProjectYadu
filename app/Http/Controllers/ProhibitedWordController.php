<?php

namespace App\Http\Controllers;

use App\ProhibitedWord;
use DB;


class ProhibitedWordController extends Controller
{
    public static function deleteAccountFromId($word)
    {
        ProhibitedWord::where('word', $word)->delete();
    }

}
