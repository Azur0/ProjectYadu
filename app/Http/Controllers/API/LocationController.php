<?php

namespace App\Http\Controllers\API;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\IpApi;
use Illuminate\Database\Eloquent\Collection;

class LocationController extends Controller
{
    private function get_ip(){
        if(isset($_SERVER['HTTP_CLIENT_IP'])){
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            return (isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '');
        }
    }

    private function getLocation(){
        $ip = self::get_ip();
        //$ip = '145.49.103.72';
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            if($query && $query['status'] == 'success'){
             return $query;
            }else{
                return false;
            }
    }

    public function areWithinReach($events, $distance)
    {
        if ($distance == 25) {
            return $events;
        }
        $userLocation = self::getLocation();
        $front = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=52.161436,5.416094&destinations=';
        //$front = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=';
        $userLocation = $userLocation['lat'] . ',' . $userLocation['lon'];
        $destination = '&destinations=';
        $EndapiKey = '&key=AIzaSyClxGzJPExYO1V4f3u-EexDfqAQvtPleDU';
        $eventsToReturn = new Collection();
        for ($i = 0; $i <= ceil(count($events) / 25); $i++) {
            $slicedArray = $events->splice(25 * $i, 25);
            $locations = "";
            foreach ($slicedArray as $slice) {
                $locations .= $slice->location->locLatitude . '%2C' . $slice->location->locLongtitude . '%7C';
            }
            $locations = substr($locations, 0, -3);
            //$request = $front . $userLocation . $destination .$locations . $EndapiKey;
            $request = $front . $locations . $EndapiKey;
            $eventDistances = $this->googleRequest($request);
            //dd($eventDistances);
            for ($j = 0; $j < count($slicedArray); $j++) {
                if($eventDistances['status'] == 'OK'){
                    if ($eventDistances['rows'][0]['elements'][$j]['distance']['value'] <= ($distance * 1000)) {
                        $eventsToReturn->push($slicedArray[$j]);
                    }
                }
            }
        }
        return $eventsToReturn;
    }

    public function googleRequest($request){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($result, true);
        return $json;
    }
}
