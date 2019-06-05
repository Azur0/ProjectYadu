<?php

namespace App\Http\Controllers\Management;

use App\BannedIp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuspensionsController extends Controller
{
    //
	public function index()
    {
        $ips = BannedIp::all();
        return view('admin.suspensions.index', compact('ips'));
    }

}
