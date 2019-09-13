<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Category;
use App\Calendar;
use App\Ratesuperior;
use App\Rate;
use App\Ratecode;

class RatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $start         = Carbon::today();
      $startMonth    = $start->startOfMonth()->toDateString();
      $endMonth      = $start->endOfMonth()->toDateString();
      $selectedMonth = $startMonth;
      $paxV        = 'ratedbl';
      $getRatecode = 'BAR';
      $ratesControllerMaintable     = Calendar::whereBetween('daterate', array($startMonth, $endMonth))->with('rates:' . $paxV)->get();
      $ratesControllerCategories    = Category::orderBy('sort', 'asc')->get();
      $ratesControllerRatecodes     = Ratecode::orderBy('ratecodeID', 'asc')->get();
      $ratesControllerRatecodeValue = Ratecode::where('ratecodeID', 'BAR')->first();
      return view('/ratesdashboard', compact('ratesControllerCategories', 'ratesControllerMaintable', 'ratesControllerRatecodes', 'ratesControllerRatecodeValue', 'paxV', 'selectedMonth', 'getRatecode'));
    }

    public function dateChange(Request $request)
    {
      $getMonth    = new Carbon($request['showMonth']);
      $paxValue    = $request['hiddenPaxDate'];
      $getRatecode = $request['hiddenRatecodeDate'];
      if ($paxValue == 1)
      {
        $paxV = 'ratesgl';
      } elseif ($paxValue == 2)
      {
        $paxV = 'ratedbl';
      }
      $startMonth    = $getMonth->startOfMonth()->toDateString();
      $endMonth      = $getMonth->endOfMonth()->toDateString();
      $selectedMonth = $startMonth;
      $ratesControllerMaintable     = Calendar::whereBetween('daterate', array($startMonth, $endMonth))->with('rates:' . $paxV)->get();
      $ratesControllerCategories    = Category::orderBy('sort', 'asc')->get();
      $ratesControllerRatecodes     = Ratecode::orderBy('ratecodeID', 'asc')->get();
      $ratesControllerRatecodeValue = Ratecode::where('ratecodeID', $getRatecode)->first();
      return view('/ratesdashboard', compact('ratesControllerCategories', 'ratesControllerMaintable', 'ratesControllerRatecodes', 'ratesControllerRatecodeValue', 'paxV', 'selectedMonth', 'getRatecode'));
    }

    public function paxChange(Request $request)
    {
      $getMonth    = new Carbon($request['hiddenMonthPax']);
      $paxValue    = $request['showPax'];
      $getRatecode = $request['hiddenRatecodePax'];
      if ($paxValue == 1)
      {
        $paxV = 'ratesgl';
      } elseif ($paxValue == 2)
      {
        $paxV = 'ratedbl';
      }
      $startMonth    = $getMonth->startOfMonth()->toDateString();
      $endMonth      = $getMonth->endOfMonth()->toDateString();
      $selectedMonth = $startMonth;
      $ratesControllerMaintable     = Calendar::whereBetween('daterate', array($startMonth, $endMonth))->with('rates:' . $paxV)->get();
      $ratesControllerCategories    = Category::orderBy('sort', 'asc')->get();
      $ratesControllerRatecodes     = Ratecode::orderBy('ratecodeID', 'asc')->get();
      $ratesControllerRatecodeValue = Ratecode::where('ratecodeID', $getRatecode)->first();
      return view('/ratesdashboard', compact('ratesControllerCategories', 'ratesControllerMaintable', 'ratesControllerRatecodes', 'ratesControllerRatecodeValue', 'paxV', 'selectedMonth', 'getRatecode'));
    }

    public function ratecodeChange(Request $request)
    {
      $getMonth    = new Carbon($request['hiddenMonthRatecode']);
      $paxValue    = $request['hiddenPaxRatecode'];
      $getRatecode = $request['showRatecode'];
      if ($paxValue == 1)
      {
        $paxV = 'ratesgl';
      } elseif ($paxValue == 2)
      {
        $paxV = 'ratedbl';
      }
      $startMonth    = $getMonth->startOfMonth()->toDateString();
      $endMonth      = $getMonth->endOfMonth()->toDateString();
      $selectedMonth = $startMonth;
      $ratesControllerMaintable     = Calendar::whereBetween('daterate', array($startMonth, $endMonth))->with('rates:' . $paxV)->get();
      $ratesControllerCategories    = Category::orderBy('sort', 'asc')->get();
      $ratesControllerRatecodes     = Ratecode::orderBy('ratecodeID', 'asc')->get();
      $ratesControllerRatecodeValue = Ratecode::where('ratecodeID', $getRatecode)->first();
      return view('/ratesdashboard', compact('ratesControllerCategories', 'ratesControllerMaintable', 'ratesControllerRatecodes', 'ratesControllerRatecodeValue', 'paxV', 'selectedMonth', 'getRatecode'));
    }
}
