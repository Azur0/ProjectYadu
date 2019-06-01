<?php

namespace App\Http\Controllers\Universal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\SetLanguageRequest;
use Cookie;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLanguage(SetLanguageRequest $request)
    {
        Cookie::queue(Cookie::forever('language', $request['language']));
        return back();
    }
}
