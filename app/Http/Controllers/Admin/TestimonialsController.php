<?php

namespace App\Http\Controllers;

use App\Testemonial;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests\CreateTestemonialRequest;

class TestimonialsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$testimonials = Testemonial::simplePaginate(10);
		return view('admin.testimonials.index', compact('testimonials'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$testimonial = Testemonial::findOrFail($id);
		return view('admin.testimonials.show', compact('testimonial'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.testimonials.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateTestemonialRequest $request)
	{
		$newTestemonial = new Testemonial;
		$newTestemonial->name = $request['name'];
		$newTestemonial->experience = $request['experience'];

		$newTestemonial->accepted = true;
		$newTestemonial->save();
		return redirect('/admin/testimonials/'.$newTestemonial->id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$testimonial = Testemonial::findOrFail($id);
		return view('admin.testimonials.edit', compact('testimonial'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(CreateTestemonialRequest $request, $id)
	{
		$newTestemonial = Testemonial::findOrFail($id);
		$newTestemonial->name = $request['name'];
		$newTestemonial->experience = $request['experience'];
		$newTestemonial->accepted = $request['accepted'];

		$newTestemonial->save();

		return redirect('/admin/testimonials/'.$newTestemonial->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$testimonial = Testemonial::findOrFail($id);
		
		if($testimonial->account_id == Auth::id() || Auth::user()->accountRole == 'Admin')
		{
			$testimonial->delete();
		}

		return redirect('/admin/testimonials');
	}
}
