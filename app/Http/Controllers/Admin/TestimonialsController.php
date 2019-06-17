<?php

namespace App\Http\Controllers;

use App\Testemonial;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests\CreateTestemonialRequest;

class TestemonialsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$testemonials = Testemonial::simplePaginate(10);
		return view('admin.testemonials.index', compact('testemonials'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$testemonial = Testemonial::findOrFail($id);
		return view('admin.testemonials.show', compact('testemonial'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.testemonials.create');
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
		return redirect('/admin/testemonials/'.$newTestemonial->id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$testemonial = Testemonial::findOrFail($id);
		return view('admin.testemonials.edit', compact('testemonial'));
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

		return redirect('/admin/testemonials/'.$newTestemonial->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$testemonial = Testemonial::findOrFail($id);
		
		if($testemonial->account_id == Auth::id() || Auth::user()->accountRole == 'Admin')
		{
			$testemonial->delete();
		}

		return redirect('/admin/testemonials');			
	}
}
