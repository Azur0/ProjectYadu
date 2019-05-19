<?php

namespace App\Http\Controllers\Management;

use Auth;
use App\Http\Controllers\Controller;
use App\EventTag;
use App\EventPicture;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Collection;

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

	public function addtype() {
		if(isset($_POST['submittype'])){
			if(isset($_FILES['file'])){
				// $name = Input::All();
				$name = "test";
				$event_tag = new EventTag;
				$event_tag->tag = $name;
				$event_tag->imageDefault = $_FILES['file']['tmp_name'];
				$event_tag->created_at = Carbon::now();
				$event_tag->save();
				return redirect('/admin/images/category')->withErrors("IS IT UPLOADED?");
			}
			return redirect('/admin/images/category')->withErrors("fucking file is empty?");
		}
		return redirect('/admin/images/category')->withErrors("no submit pressed");
	}

	public function check() {
		$error = "";
		if(isset($_POST['submit'])) {
			if (!isset($_FILES['file'])) {
				return redirect('/admin/images/extra')->withErrors("no file set");
			}
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

	public function overrideremove(Request $request) {
		// events are connected but still remove the image
		$events = Event::where('tag_id', '=', $request->input('query'))->get();
		return;
	}	

	public function removetype(Request $request) {
		// no events are connected.
		$events = Event::where('tag_id', '=', $request->input('query'))->get();
		return $events;
	}

	public function checkforevent(Request $request) {
		$events = Event::where('tag_id', '=', $request->input('query'))->get();
		return json_encode($events);
	}

	public function deleteCategoryPicture(Request $request) {
		$selectedPicture = EventPicture::where('id', '=', $request->input('query'))->firstOrFail();
		try{
			$selectedPicture->delete();
		} catch(Exception $e) {
			return json_encode($e);
		}
		return json_encode("");
	}

	public function passthrough() {
		// set picture to database
		// return view('admin/images.category');
	}
}
