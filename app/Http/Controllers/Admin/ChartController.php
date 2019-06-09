<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Account;
use App\ChatMessage;
use App\Event;
use App\EventTag;
use App\Http\Requests\GetChartDateRangeRequest;
use App\SharedEvent;
use App\SocialMediaPlatform;
use Carbon\Carbon;


class ChartController extends Controller
{
    public function UpdateDateString(GetChartDateRangeRequest $request){
        $format = __('formats.dateFormat');
        $fromDate = strtotime($request['fromDate']);
        $toDate = strtotime($request['toDate']);

        return array(__('charts.report_date', ['from' => date($format, $fromDate), 'till' => date($format, $toDate)]));
    }

    public function GetChatmessages(GetChartDateRangeRequest $request)
    {
        $data = $this->MakeDataArray($request['toDate'], $request['fromDate']);
        $messageCount = ChatMessage::whereBetween('created_at', [$request->fromDate, Carbon::parse($request->toDate)->addDay()])->count();
        $data['messageData'] = array('messageCount' => $messageCount);
        return $data;
    }

    public function GetAccountsCreated(GetChartDateRangeRequest $request)
    {
        $data = $this->MakeDataArray($request['toDate'], $request['fromDate']);
        $accountCount = Account::where('isDeleted', 0)->whereBetween('created_at', [$request->fromDate, Carbon::parse($request->toDate)->addDay()])->count();
        $data['accountData'] = array('accountCount' => $accountCount);
        return $data;
    }

    public function GetTotalEventsCreated(GetChartDateRangeRequest $request)
    {
        $fromDate = Carbon::parse($request['fromDate']);
        $toDate = Carbon::parse($request['toDate'])->addDay();
        $difference = $toDate->diffInDays($fromDate);
        $data = array();
        $previousTotalEvents = 0;
        $firstRun = true;

        for($i = 0; $i < $difference; $i++){
            $totalEvents = Event::where('isDeleted', 0)->where('created_at', '<', $fromDate->copy()->addDays($i))->count();
            $entry = array(
                'date' => $fromDate->copy()->addDays($i)->format('c'),
                'totalEvents' => $totalEvents
            );

            if($previousTotalEvents < $totalEvents || $firstRun) {
                array_push($data, $entry);
                $firstRun = false;
            }
            $previousTotalEvents = $totalEvents;
        }
        return $data;
    }

    public function GetShares(GetChartDateRangeRequest $request)
    {
        $data = $this->MakeDataArray($request['toDate'], $request['fromDate']);
        $platforms = SocialMediaPlatform::all();
        $data['shareData'] = array();

        foreach ($platforms as $platform) {
            $entry = array(
                'platform' => ucfirst($platform->platform),
                'shareCount' => SharedEvent::where('platform', $platform->platform)->whereBetween('created_at', [$request->fromDate, Carbon::parse($request->toDate)->addDay()])->count(),
            );

            if ($entry['shareCount'] > 0) {
                array_push($data['shareData'], $entry);
            }
        }
        return $data;
    }

    public function GetCategories(GetChartDateRangeRequest $request)
    {
        $data = $this->MakeDataArray($request['toDate'], $request['fromDate']);
        $categories = EventTag::pluck('tag');
        $data['categoryData'] = array();

        for ($i = 0; $i < sizeof($categories); $i++) {
            $tag_id = EventTag::where('tag', $categories[$i])->pluck('id');
            $entry = array(
                'category' => ucfirst($categories[$i]),
                'count' => Event::where('tag_id', $tag_id)->whereBetween('created_at', [$request->fromDate, Carbon::parse($request->toDate)->addDay()])->count()
            );

            if ($entry['count'] > 0) {
                array_push($data['categoryData'], $entry);
            }
        }
        return $data;
    }

    public function GetActiveEventLocations(GetChartDateRangeRequest $request)
    {
        $data = array();
        $events = Event::where('isDeleted',0)->whereBetween('startDate', [$request->fromDate, Carbon::parse($request->toDate)->addDay()])->get();

        foreach ($events as $event) {
            $entry = array(
                'lat' => $event->location->locLatitude,
                'lng' => $event->location->locLongtitude
            );
            array_push($data, $entry);
        }
        return $data;
    }

    private function MakeDataArray($toDate, $fromDate)
    {
        $data = array();
        $data['dateInfo'] = array(
            'fromDate' => $fromDate->toDateString(),
            'toDate' => $toDate->toDateString()
        );
        return $data;
    }
}