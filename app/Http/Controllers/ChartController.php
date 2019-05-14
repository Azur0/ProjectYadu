<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\GetTotalEventsCreatedRequest;
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
        $totalEvents = 0;

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
                $eventsThisMonth = Event::where('isDeleted', 0)->whereBetween('created_at', [$fromDate, $toDate])->count();

                $entry = array(
                    'date' => $toDate->subMonth()->format('Y-m-d H:i:s'),
                    'month' => $toDate->format('M'),
                    'monthNumber' => $fromMonth,
                    'year' => $fromYear,
                    'totalEvents' => $totalEvents + $eventsThisMonth,
                    'fromDate' => $fromDate,
                    'toDate' => $toDate->addMonth(),
                );
                array_push($data,$entry);

                $fromMonth++;
            }
            $fromYear++;
        }

        return $data;
    }
}
