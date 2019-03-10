<?php

namespace App\Http\Controllers\API;

use App\Event;
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
        $ip = self::get_ip();
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            if($query && $query['status'] == 'success'){
             return $query['zip'];
            }else{
                return false;
            }
        //}
    }

    public function evenLonLat(Event $event){
        $eventZipCode = $event->location()->postalcode;
        //https://wiki.openstreetmap.org/wiki/Nominatim#Examples for getting the lat and lon for the zip code
        $query2 = @unserialize(file_get_contents('https://nominatim.openstreetmap.org/search/'.$eventZipCode.'?format=json&limit=1'));
        return $query2;
    }

    public function isWithinReach(Event $event){
        $eventLocation = self::eventLonLat($event);
        dd($eventLocation);
        $userLocation = self::getLocation();
        // Do not forget to get the google API key
        $query3 = @unserialize(file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$userLocation['lat'].','.$userLocation['lon'].'&destinations='.$eventLocation['lat'].'%'.$eventLocation['lon'].'&key=YOUR_API_KEY'));
        dd($query3['distance']);

        //Some black magic for getting the distance value
        //if(){
            //return true;
        //}else{
            //return false;
        //}
    }
}
