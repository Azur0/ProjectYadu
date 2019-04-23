<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;


class EditLangController extends Controller
{
    public function index($page)
    {
        $x = __($page);
        return view("admin.editText", compact("x","page"));
        // dd($x);
    }

    public function saveFile(Request $request){
        $fileName = base_path()."/resources/lang/nl/".$request->file.".php";
        $fileBegin = "<?php return [";
        $fileMiddle = "";

        $values = $request->all();
        unset($values["file"]);
        unset($values["_token"]);
        foreach ($values as $key => $value){
            $fileMiddle .=" '$key' => '$value', ";
        }

        // dd($fileMiddle);
        $fileEnd = "];";
        file_put_contents($fileName, $fileBegin.$fileMiddle.$fileEnd);
        return redirect('/admin');
    }
}
