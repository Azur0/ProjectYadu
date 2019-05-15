<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\GetMonthlySharesRequest;
use App\Http\Requests\GetTotalEventsCreatedRequest;
use App\SharedEvent;
use App\SocialMediaPlatform;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function GetTotalEventsCreated(GetTotalEventsCreatedRequest $request){
        $fromDate = $request->fromDate;
        $fromMonth = (int)$fromDate->format('n');
        $fromYear = (int)$fromDate->format('Y');

        $toDate = $request->toDate;
        $toMonth = (int)$toDate->format('n');
        $toYear = (int)$toDate->format('Y');

        $fromDate = Carbon::create($fromYear, $fromMonth, 1, 0,0,0);

        $data = array();

        while($fromYear <= $toYear){

            //If the year is the same stop at target month, If not stop at 12
            if($fromYear == $toYear){
                $amountOfMonthsToCheck = $toMonth;
            } else{
                $amountOfMonthsToCheck = 12;
            }

            while($fromMonth <= $amountOfMonthsToCheck){

                $toDate = Carbon::create($fromYear, $fromMonth, 1, 0,0,0)->addMonth();
                $totalEvents = Event::where('isDeleted', 0)->where('created_at', '<', $toDate)->count();

                $entry = array(
                    'date' => $toDate->subMonth()->format('Y-m-d H:i:s'),
                    'month' => $toDate->format('M'),
                    'monthNumber' => $fromMonth,
                    'year' => $fromYear,
                    'totalEvents' => $totalEvents
                );
                array_push($data,$entry);

                $fromMonth++;
            }
            $fromMonth = 1;
            $fromYear++;
        }
        return $data;
    }

    public function GetMonthlyShares(GetMonthlySharesRequest $request){

        $data = array();
        $platforms = SocialMediaPlatform::all();

        $data['dateInfo'] = array(
            'fromDate' => $request->fromDate->toDateString(),
            'toDate' => $request->toDate->toDateString()
        );

        $data['shareData'] = array();

        foreach ($platforms as $platform){
            $entry = array(
                'platform' => ucfirst($platform->platform),
                'shareCount' => SharedEvent::where('platform', $platform->platform)->whereBetween('created_at', [$request->fromDate, Carbon::parse($request->toDate)->addDay()])->count(),
            );
            array_push($data['shareData'], $entry);
        }
        return $data;
    }

    public function GetActiveEventLocations(){

        // $fromDate = $request->fromDate;
        // $toDate = $request->toDate;
        
        $data = array();
        $events = Event::all();

        foreach ($events as $event){
            $entry = array(
                'lat' => $event->location->locLatitude,
                'lng' => $event->location->locLongtitude
            );
            array_push($data, $entry);
        }

        return $data;
    }
}
