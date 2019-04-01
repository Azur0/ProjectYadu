<?php

namespace App\Http\Controllers\API;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\IpApi;

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
        //$ip = self::get_ip();
        $ip = '145.49.103.72';
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            if($query && $query['status'] == 'success'){
             return $query;
            }else{
                return false;
            }
    }

    private function eventLonLat(Event $event){

        $eventZipCode = $event->location->postalcode;
        $query2 = "https://nominatim.openstreetmap.org/search?q=".$eventZipCode."&format=json&addressdetails=1";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $query2);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($result, true);
        return $json;
    }

    public function isWithinReach(Event $event, $distance){
        if($distance == 25){
            return true;
        }

        //$userLocation = self::getLocation();
        $eventLocation = self::eventLonLat($event);

        if($eventLocation != false /*&& $userLocation != false*/) {
            //$query3 = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=' . $userLocation['lat'] . ',' . $userLocation['lon'] . '&destinations=' . $eventLocation[0]['lat'] . ',' . $eventLocation[0]['lon'] . '&key=AIzaSyDL4ugHzrWMXq40HaC3KEUtdgoeTVX3JcU';
            $query3 = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=51.6886358,5.2870897&destinations=' . $eventLocation[0]['lat'] . ',' . $eventLocation[0]['lon'] . '&key=AIzaSyDL4ugHzrWMXq40HaC3KEUtdgoeTVX3JcU';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $query3);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($result, true);
            if($json['rows'][0]['elements'][0]['distance']['value'] <= ($distance*1000)){
            return true;
            }else{
            return false;
            }
        }
        return false;
    }

    public function areWithinReach($events, $distance){
        if($distance == 25){
            return true;
        }

        //$userLocation = self::getLocation();
        //TODO set foreach event lat and lon
        $eventLocation = self::eventLonLat($event);

        //
        //TODO remove all events that the location can't be found of
        //TODO foreach^
        if($eventLocation != false /*&& $userLocation != false*/) {


            //TODO make part set for events
                //TODO remove from list
                //TODO add to new collect of events to be controlled
            //
            //TODO make string with all the lons and lats of events

            //TODO add it to the Query3

            //TODO add api key to the end of the query
            //$query3 = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=' . $userLocation['lat'] . ',' . $userLocation['lon'] . '&destinations=' . $eventLocation[0]['lat'] . ',' . $eventLocation[0]['lon'] . '&key=AIzaSyDL4ugHzrWMXq40HaC3KEUtdgoeTVX3JcU';
            $query3 = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=51.6886358,5.2870897&destinations=' . $eventLocation[0]['lat'] . ',' . $eventLocation[0]['lon'] . '&key=AIzaSyDL4ugHzrWMXq40HaC3KEUtdgoeTVX3JcU';

            //TODO send request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $query3);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($result, true);

            //TODO keep events in distance (based on array place)
            //TODO make foreach^
                if($json['rows'][0]['elements'][0]['distance']['value'] <= ($distance*1000)){
                    //TODO add to list to return of events to show
                    return true;
                }else{
                    //TODO remove this
                    return false;
                }
        }
        //TODO return list of events to show
        return false;
    }
}
