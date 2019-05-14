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

}
