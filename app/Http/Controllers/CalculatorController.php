<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Childrenage;
use App\Calendar;
use App\Category;
use App\Rate;

class CalculatorController extends Controller
{
    public function index()
    {
      $maximalRooms  = Setting::where('settingsType', 'maximalselectrooms')->first();
      $maximalAdults = Setting::where('settingsType', 'maximalselectadults')->first();
      $maximalKids   = Setting::where('settingsType', 'maximalselectkids')->first();
      $kidsAge       = Childrenage::orderBy('sort', 'asc')->get();
      return view('/ratecalculator', compact('maximalRooms', 'maximalAdults', 'maximalKids', 'kidsAge'));
    }

    public function cal(Request $request)
    {
      if($request->ajax()) {
        $arrivalDate   = date('Y-m-d', strtotime($request['arrival']));
        $departureDate = date('Y-m-d', strtotime($request['departure'])-1);
        $rooms         = $request['rooms'];
        $adults        = $request['adults'];
        $kids          = $request['kids'];
        $kidsage1      = $request['kidsage1'];
        $kidsage2      = $request['kidsage2'];
        $DR1           = 'DR1';
        if ($adults == 1) {
          $adultsValue = 'ratesgl';
        } else if ($adults == 2) {
          $adultsValue = 'ratedbl';
        }
        $testquery = Rate::orderBy('_category', 'asc')->groupBy('_category')->sum(ratedbl);
        $calculateCategories = Category::orderBy('sort', 'asc')->get();
        $calculateMain = \DB::table('calendar_rate')
              ->join('calendars', function($join) use($arrivalDate, $departureDate)
              {
                $join->on('calendars.id', '=', 'calendar_rate.calendar_id')
                    ->whereBetween('calendars.daterate', array($arrivalDate, $departureDate));
              })
              ->join('rates', function($join) use ($DR1)
              {
                $join->on('rates.id', '=', 'calendar_rate.rate_id');
              })
              ->join('categories', function($join)
              {
                $join->on('categories.categoryID', '=', 'rates._category');
              })
              ->select('rates.*', 'calendars.*', 'categories.*')
              ->get();
        return response()->json(array($calculateCategories, $calculateMain));
      } else {
        return redirect('/home');
      }
    }
}
