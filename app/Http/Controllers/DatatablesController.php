<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newpayment;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    public function indexDataTables()
    {
      $newpays = Newpayment::orderby('paymentid', 'desc');
      return Datatables::eloquent($newpays)->toJson();
    }

    public function index()
    {
      return view('paymentsdashboard');
    }
  }
