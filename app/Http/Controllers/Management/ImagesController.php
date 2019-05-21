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
		if($request->file('defaultImage')->getSize() > 10240 || $request->file('selectedImage')->getSize() > 10240){
			return back()->withErrors('File too large');
		}
		$thing = $this->validate($request, [
			'defaultImage' => 'required|image|max:10240|mimes:jpg,png,jpeg',
			'selectedImage' => 'required|image|max:10240|mimes:jpg,png,jpeg',
			'naam' => 'required|string|min:1|max:45'
		]);

		$image1 = $request->file('defaultImage');
		$image2 = $request->file('selectedImage');
		$name = $request->input('naam');
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
			'default' => 'required|image|max:10240|mimes:jpg,png,jpeg'
			]);
		if($request->file('default')->getSize() > 10240){
			return back()->withErrors('File too large');
		}
		$location = "images/".$request->selected;
		move_uploaded_file($request->file('default'), $location);
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
		$pictures = EventPicture::where('tag_id', '=', $request->input('query'))->get();
		if($events->isEmpty() && $pictures->isEmpty()) {
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
		// rechange tag events
		$events = Event::where('tag_id', '=', $request->input('query'))->get();
		$pictures = EventPicture::where('tag_id', '=', $request->input('query'))->get();
		if(!$events->isEmpty() || !$pictures->isEmpty()){
			// set different tag_id in table events
			$tag = EventTag::where('id', '!=', $request->input('query'))->firstOrFail();
			$picture = EventPicture::where('tag_id', '=', $tag->id)->firstOrFail();
			foreach($events as $e){
				// check event tag_id with a different id in database
				$e->tag_id = $tag->id;
				$e->event_picture_id = $picture->id;
				$e->save();
			}
			// delete all pictures from previous tag 
			$eventpictures = EventPicture::where('tag_id', '=', $request->input('query'))->get();
			foreach($eventpictures as $picture){
				$picture->delete();
			}
			// finally delete the tag itself
			$tag = EventTag::where('id', '=', $request->input('query'))->firstOrFail();
			$tag->delete();
		}
		return json_encode("");
	}

	public function addeventpicture(Request $request, $id) {
		$this->validate($request, [
			'default' => 'required|image|mimes:jpg,png,jpeg|max:2048'
		]);
		$event_picture = new EventPicture;
		$event_picture->tag_id = $id;
		$event_picture->picture = file_get_contents($request->file('default'));
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
