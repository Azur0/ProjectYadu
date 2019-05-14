<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\GetTotalEventsCreatedRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function GetTotalEventsCreated(GetTotalEventsCreatedRequest $request){

        $creationDateOfFirstEvent = Carbon::parse(Event::min('created_at'));
        $month = (int)$creationDateOfFirstEvent->format('n');
        $year = (int)$creationDateOfFirstEvent->format('Y');
        $currentMonth = (int)Carbon::now()->format('n');
        $currentYear = (int)Carbon::now()->format('Y');

        $fromDate = Carbon::create($year, $month, 1, 0,0,0);
        $totalEvents = 0;

        $data = array();

        while($year <= $currentYear){

            while($month <= $currentMonth){

                $toDate = Carbon::create($year, $month, 1, 0,0,0)->addMonth();
                $eventsThisMonth = Event::where('isDeleted', 0)->whereBetween('created_at', [$fromDate, $toDate])->count();

                $entry = array(
                    'date' => $toDate->subMonth()->format('Y-m-d H:i:s'),
                    'month' => $toDate->subMonth()->format('M'),
                    'monthNumber' => $month,
                    'year' => $year,
                    'totalEvents' => $totalEvents + $eventsThisMonth,
                );
                array_push($data,$entry);

                $month++;
            }
            $year++;
        }

//        $entry->month = $creationDateOfFirstAccount->format('M');
//        $entry->year = $creationDateOfFirstAccount->format('Y');

        return $data;
    }
}
