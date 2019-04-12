<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DateTimeController extends Controller
{
    public static function getDayNames($dayNumber)
    {
        //TODO: Change to lang files
        switch ($dayNumber) {
            case 1:
                return "Maandag";
                break;
            case 2:
                return "Dinsdag";
                break;
            case 3:
                return "Woensdag";
                break;
            case 4:
                return "Donderdag";
                break;
            case 5:
                return "Vrijdag";
                break;
            case 6:
                return "Zaterdag";
                break;
            case 7:
                return "Zondag";
                break;
        }
    }
}
