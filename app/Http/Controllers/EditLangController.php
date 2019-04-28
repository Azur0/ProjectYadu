<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;
use Hamcrest\Type\IsArray;

class EditLangController extends Controller
{
    public function index($lang, $page)
    {
        $currentLocale = app()->getLocale();
        App::setLocale($lang);
        $x = __($page);
        App::setLocale($currentLocale);
        // dd($x);
        return view("admin.editText", compact("x","page", "lang"));
    }

    public function saveFile(Request $request){
        $request->validate([
            'lang' => 'required',
            'lang_file' => 'required',
        ]);
        $currentLocale = app()->getLocale();
        App::setLocale($request->lang);
        $langArrayFromFile = __($request->lang_file);
        App::setLocale($currentLocale);
        // dd($langArrayFromFile);

        $fileName = base_path()."/resources/lang/".$request->lang."/".$request->lang_file.".php";
        $fileBegin = "<?php return [";
       

        $values = $request->all();
        // dd($values);
        unset($values["lang"]);
        unset($values["_token"]);
        unset($values["lang_file"]);
        
        $fileMiddle = $this->makeMiddle($values, $langArrayFromFile, "", "");
        
        // dd($fileMiddle);

        $fileEnd = "];";
        file_put_contents($fileName, $fileBegin.$fileMiddle.$fileEnd);
        return redirect('/admin');
    }
    function makeMiddle($input, $baseFile, $fileMiddle, $baseKey){
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        
        foreach ($baseFile as $key => $value){
            
            // if($baseKey!=""){
            //     dd($baseFile);
            // }
            
            if(is_array($value)){
             
                // if($baseKey!=""){
                //     dd($baseFile);
                // }
                $fileMiddle .= "'$key' => [";
               
                
                $fileMiddle = $this->makeMiddle($input, $value, $fileMiddle, $key);
                
                $fileMiddle .= " ], "; 
            }else{
                // $out->writeln("--> key ".$key);
                // $out->writeln("--> value ".$value);
                if($baseKey != ""){
                    $valueFromInput = $input["$baseKey;$key"];
                }
                else{
                    $valueFromInput = $input["$key"];    
                }
                
                $fileMiddle .=" '$key' => '$valueFromInput', ";
                // dd($fileMiddle);
            }
        }
        // if($baseKey==""){
        //     dd($fileMiddle);
        // }
        //  dd($fileMiddle);
        return $fileMiddle;
    }
}
