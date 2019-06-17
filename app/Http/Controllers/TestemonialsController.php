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
		$testemonials = Testemonial::orderBy('created_at', 'desc')->simplePaginate(10);
		return view('testemonials.index', compact('testemonials'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return redirect('/home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('testemonials.create');
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
		$newTestemonial->name = "";
		$newTestemonial->experience = $request['experience'];
		$newTestemonial->account_id = auth()->user()->id;
		
		if(Auth::user()->accountRole == 'Admin')
		{
			$newTestemonial->accepted = true;
		}

		$newTestemonial->save();

		return redirect('/home');
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
		return view('testemonials.edit', compact('testemonial'));
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
		$newTestemonial->experience = $request['experience'];

		$newTestemonial->save();

		return redirect('/home');
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
		
		if($testemonial->account_id == Auth::id())
		{
			$testemonial->delete();
		}

		return redirect('/testemonials');	
	}
}
