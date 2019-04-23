<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;


class EditLangController extends Controller
{
    public function index($lang, $page)
    {
        $currentLocale = app()->getLocale();
        App::setLocale($lang);
        $x = __($page);
        App::setLocale($currentLocale);
        return view("admin.editText", compact("x","page", "lang"));
    }

    public function saveFile(Request $request){
        $fileName = base_path()."/resources/lang/".$request->lang."/".$request->file.".php";
        $fileBegin = "<?php return [";
        $fileMiddle = "";

        $values = $request->all();
        unset($values["file"]);
        unset($values["_token"]);
        unset($values["lang"]);

        foreach ($values as $key => $value){
            $fileMiddle .=" '$key' => '$value', ";
        }

        $fileEnd = "];";
        file_put_contents($fileName, $fileBegin.$fileMiddle.$fileEnd);
        return redirect('/admin');
    }
}
