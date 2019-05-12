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
			$dir_path = "images/";
			$allowed = array('jpg', 'jpeg', 'png');
			$images = array();
			if(is_dir($dir_path)) {
				$files = scandir($dir_path);
				foreach($files as $file) {
					$fileExt = explode('.', $file);
					$fileActualExt = strtolower(end($fileExt));
					if(in_array($fileActualExt, $allowed)) {
						array_push($images, $file);
					}
				}
			} else {
				// incorrect dir_path
			}
            return view('admin/images.index')->with(compact('images'));
		}
		else
		{
			return redirect('/login');
		}
	}

	public function check() {
		return view('admin/images.index');
		if(isset($_POST['submit'])) {
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
						//TODO: selected file and the extension to write over the old image
						// $input = Input::only('name'); 
						// $name = $input['name'];
						$fileNameNew = uniqid('', true).".".$fileActualExt;
						$fileDestination = 'images/'.$fileNameNew;
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
