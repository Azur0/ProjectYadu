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

    //private $ip;

    private function get_ip(){
        $test = '145.49.118.11';

        return $test;
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
    private function getLocation(){
        //if (navigator.geolocation) {
            //$test = navigator.geolocation.getCurrentPosition();
        //} else {
        $ip = self::get_ip();
        $ip = '145.130.187.157';
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            if($query && $query['status'] == 'success'){
             return $query;
            }else{
                return false;
            }
        //}
    }

    private function eventLonLat(Event $event){
        dd($event->location()->postalcode);
        $eventZipCode = $event->location()->postalcode;
        //$eventZipCode = '5222AS';
        //https://wiki.openstreetmap.org/wiki/Nominatim#Examples for getting the lat and lon for the zip code

        //https://nominatim.openstreetmap.org/search/5222AS?format=json&limit=1
        //$query2 = file_get_contents('https://nominatim.openstreetmap.org/search/5222AS?format=json&limit=1');
        $query2 = "https://nominatim.openstreetmap.org/search?q=".$eventZipCode."&format=json&addressdetails=1";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $query2);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($result, true);
        dd($json);
        return $json;
    }

    public function isWithinReach(Event $event, $distance ){
        $userLocation = self::getLocation();
        //dd($userLocation['lon']);
        $eventLocation = self::eventLonLat($event);
        //dd($eventLocation[0]['lon']);
        if($eventLocation != false && $userLocation != false) {
            //https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=52.057201385498,5.287700176239&destinations=51.7046726630435,5.26834251304348&key=AIzaSyDL4ugHzrWMXq40HaC3KEUtdgoeTVX3JcU
            //https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=5.287700176239,52.057201385498&destinations=5.26834251304348,51.7046726630435&key=AIzaSyDL4ugHzrWMXq40HaC3KEUtdgoeTVX3JcU
            //dd('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=' . $userLocation['lon'] . ',' . $userLocation['lat'] . '&destinations=' . $eventLocation[0]['lon'] . ',' . $eventLocation[0]['lat'] . '&key=AIzaSyDL4ugHzrWMXq40HaC3KEUtdgoeTVX3JcU');
            $query3 = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=' . $userLocation['lat'] . ',' . $userLocation['lon'] . '&destinations=' . $eventLocation[0]['lat'] . ',' . $eventLocation[0]['lon'] . '&key=AIzaSyDL4ugHzrWMXq40HaC3KEUtdgoeTVX3JcU';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $query3);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($result, true);
            //$json['rows'][0]['elements'][0]['distance']['value'];
            if($json['rows'][0]['elements'][0]['distance']['value'] <= ($distance*1000)){
            return true;
            }else{
            return false;
            }
        }
        //Should this return false if we can't get a distance?
        return false;
        //return view('temp.testLocation', compact(['userLocation','eventLocation']));
    }
}
