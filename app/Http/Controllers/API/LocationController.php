<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\IpApi;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private $ip;

    public function get_ip(){


        if(isset($_SERVER['HTTP_CLIENT_IP'])){
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            return (isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '');
        }
    }

    // Should i use one of the commonly used names such as show or something els?
    public function getLocation(){
        //if (navigator.geolocation) {
            //$test = navigator.geolocation.getCurrentPosition();
        //} else {
       // IpApi::$apikey;

        $test = self::get_ip();
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$test));
            if($query && $query['status'] == 'success'){
            $test = $query['zip'];
            }else{
                echo 'Something is wrong';
            }
        //}
        return view('temp\testLocation',compact('test'));
    }
}
