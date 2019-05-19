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
			}
            return view('admin/images.extra')->with(compact('images'));
		}
		else
		{
			return redirect('/login');
		}
	}

	public function addtype(Request $request) {
		$this->validate($request, [
			'typefile1' => 'required|image|mimes:jpg,png,jpeg|max:2048',
			'typefile2' => 'required|image|mimes:jpg,png,jpeg|max:2048',
			'filename' => 'required|string'
		]);
		$image1 = $request->file('typefile1');
		$image2 = $request->file('typefile2');
		$name = $request->input('filename');
		$event_tag = new EventTag;
		$event_tag->tag = $name;
		$event_tag->imageDefault = file_get_contents($image1);
		$event_tag->imageSelected = file_get_contents($image2);
		$event_tag->created_at = Carbon::now();
		$event_tag->save();
		return back()->with('success', 'placeholder successful');
	}

	public function update(Request $request) {
		$this->validate($request, [
			'selected' => 'required',
			'file' => 'required|image|mimes:jpg,png,jpeg|max:2048'
		]);
		$location = "images/".$request->selected;
		move_uploaded_file($request->file->getPathname(), $location);
		return back()->with('success', 'placeholder successful');
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

	public function deleteeventpicture(Request $request) {
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
