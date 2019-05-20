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
		return back()->with('success', __('image.adding_successsful'));
	}

	public function update(Request $request) {
		$this->validate($request, [
			'selected' => 'required',
			'file' => 'required|image|mimes:jpg,png,jpeg|max:2048'
		]);
		$location = "images/".$request->selected;
		move_uploaded_file($request->file->getPathname(), $location);
		return back()->with('success', __('image.update_successful'));
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

	public function removetype(Request $request) {
		$events = Event::where('tag_id', '=', $request->input('query'))->get();
		if($events->isEmpty()) {
			$tag = EventTag::where('id', '=', $request->input('query'))->firstOrFail();
			$tag->delete();
			return json_encode("success");
		} 
		return json_encode($events);
	}

	public function checktiedpictures(Request $request) {
		$eventpictures = EventPicture::where('tag_id', '=', $request->input('query'))->get();
		foreach ($eventpictures as $pic) {
			$pic->picture = base64_encode($pic->picture);
		}
		return json_encode($eventpictures);
	}

	public function trueremove(Request $request) {
		return $request;
	}

	public function addeventpicture(Request $request, $id) {
		$this->validate($request, [
			'eventfile' => 'required|image|mimes:jpg,png,jpeg|max:2048'
		]);
		$event_picture = new EventPicture;
		$event_picture->tag_id = $id;
		$event_picture->picture = file_get_contents($request->file('eventfile'));
		$event_picture->save();
		return back()->with('eventsuccess', __('image.update_successful'));
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
}
