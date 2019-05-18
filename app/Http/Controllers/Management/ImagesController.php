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
		$error = "";
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

			if(empty(implode($selectedImage))) {
				$error = "ERROR NOTHING CHOSEN";
				return redirect('/admin/images/extra')->withErrors($error);
			} else {
				if(in_array($fileActualExt, $allowed)) {
					if($fileError === 0) {
						if($fileSize < 5000) {
							$test = implode($selectedImage);
							$fileDestination = 'images/'.$test;
							move_uploaded_file($fileTmp, $fileDestination);
							$error = "success";
							return redirect('/admin/images/extra')->withErrors($error);
						} else {
							$error = "Placeholder too large";
						}
					} else {
						$error = "Placeholder error";
					}
				} else {
					$error = "Placeholder ext not allowed";
				}
			}
		}
		return redirect('/admin/images/extra')->withErrors($error);
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

	public function removeextra() {
		// remove image
		return redirect('/admin/images/extra')->withErrors("penis");
	}

	public function removetype($id) {
		$tag = EventTag::findOrFail($id);
		return redirect('admin/images/category')->withErrors("test".$id);;
	}

	public function passthrough() {
		// set picture to database
		// return view('admin/images.category');
	}
}
