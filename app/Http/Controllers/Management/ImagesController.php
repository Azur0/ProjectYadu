<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Management\ImagesController;
use Auth;
use App\Http\Controllers\Controller;
use App\EventTag;
use App\EventPicture;
use App\Event;
use Illuminate\Support\Facades\Input;	

class ImagesController extends Controller
{
    public function showextra()
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
            return view('admin/images.extra')->with(compact('images'));
		}
		else
		{
			return redirect('/login');
		}
	}

	public function check() {
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

			$selectedImage = Input::only('selected'); 

			if($selectedImage !== null) {
				if(in_array($fileActualExt, $allowed)) {
					if($fileError === 0) {
						if($fileSize < 5000) {
							$fileDestination = 'images/'.$selectedImg;
							move_uploaded_file($fileTmp, $fileDestination);
							return view('admin/images.extra');
						} else {
							$error = "Placeholder too large";
						}
					} else {
						$error = "Placeholder error";
					}
				} else {
					$error = "Placeholder wrong file";
				}
			} else {
				$error = "Placeholder no image selected";
			}
		}
		return ImagesController::showextra()->with($error);
	}

	public function showtype() {
		if (Auth::check())
		{
			$tags = EventTag::all();
			$pictures = EventPicture::all();
			return view('admin/images.category')->withtags($tags)->withpictures($pictures);
		}
		else
		{
			return redirect('/login');
		}
	}

	public function passthrough() {
		// set picture to database
		return view('admin/images.category');
	}
}
