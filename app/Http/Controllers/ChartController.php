<?php

namespace App\Http\Controllers;

use App\Account;
use App\Event;
use App\EventTag;
use App\Http\Requests\GetChartDateRangeRequest;
use App\Http\Requests\GetTotalEventsCreatedRequest;
use App\Message;
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

    public function GetChatmessages(GetChartDateRangeRequest $request){
        $data = $this->MakeDataArray($request['toDate'], $request['fromDate']);
        $messageCount = Message::whereBetween('created_at', [$request->fromDate, Carbon::parse($request->toDate)->addDay()])->count();
        $data['messageData'] = array('messageCount' => $messageCount);
        return $data;
    }

    public function GetAccountsCreated(GetChartDateRangeRequest $request){
        $data = $this->MakeDataArray($request['toDate'], $request['fromDate']);
        $accountCount = Account::where('isDeleted',0)->whereBetween('created_at', [$request->fromDate, Carbon::parse($request->toDate)->addDay()])->count();
        $data['accountData'] = array('accountCount' => $accountCount);
        return $data;
    }

    public function GetShares(GetChartDateRangeRequest $request){

        $data = $this->MakeDataArray($request['toDate'], $request['fromDate']);
        $platforms = SocialMediaPlatform::all();
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

    public function GetCategories(GetChartDateRangeRequest $request){
        $data = $this->MakeDataArray($request['toDate'], $request['fromDate']);
        $categories = EventTag::pluck('tag');
        $data['categoryData'] = array();

        for($i = 0; $i < sizeof($categories); $i++ ){
            $tag_id = EventTag::where('tag', $categories[$i])->pluck('id');
            $entry = array(
                'category' => ucfirst($categories[$i]),
                'count' => Event::where('tag_id', $tag_id)->whereBetween('created_at', [$request->fromDate, Carbon::parse($request->toDate)->addDay()])->count()
            );

            if($entry['count'] > 0){
                array_push($data['categoryData'], $entry);
            }
        }
        return $data;
    }

    public function GetActiveEventLocations(){

        //TODO: Add dates
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

    private function MakeDataArray($toDate, $fromDate){
        $data = array();
        $data['dateInfo'] = array(
            'fromDate' => $fromDate->toDateString(),
            'toDate' => $toDate->toDateString()
        );
        return $data;
    }
}
