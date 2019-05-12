<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\EventTag;
use App\EventPicture;
use App\Event;
use Illuminate\Support\Facades\Input;	

class ImagesController extends Controller
{
    public function index()
	{
		if (Auth::check())
		{
            $tags = EventTag::all();
			$names = Event::distinct('eventName')->pluck('eventName');
            return view('admin/images.index', compact(['tags', 'names']));
		}
		else
		{
			return redirect('/login');
		}
	}

	public function check() {
		if(isset($_POST['submit'])) {
			// $input = Input::only('name'); 
			
			$file = $_FILES;

			$fileName = $_FILES['file']['name'];
			$fileTmp = $_FILES['file']['tmp_name'];
			$fileSize = $_FILES['file']['size'];
			$fileError = $_FILES['file']['error'];
			$fileType = $_FILES['file']['type'];
		
			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
		
			$allowed = array('jpg', 'jpeg', 'png');
		
			if(in_array($fileActualExt, $allowed)) {
				if($fileError === 0) {
					if($fileSize < 5000) {
						$fileNameNew = uniqid('', true).".".$fileActualExt;
						$fileDestination = $fileNameNew;
						move_uploaded_file($fileTmp, $fileDestination);
						$message = "successful";
						return view('admin/images.index');
					} else {
						$error = "Placeholder too large";
					}
				} else {
					$error = "Placeholder error";
				}
			} else {
				$error = "Placeholder wrong file";
			}
		}
	}
}
