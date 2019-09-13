@extends('layouts.app')
@section('content')
@include('layouts.navrates')
<div class="loader"></div>
<div class="divider-30"></div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="selectBox">

        <div class="row">
          <div class="col-md-6">
            <div class="selectBoxLabel">
              Select Month
            </div>
            <form class="" action="/dateChange" method="post" id="dateForm">
              {{ csrf_field() }}
              <input class="form-control" type="text" name="showMonth" id="showMonth" value="{{ date('M Y', strtotime($selectedMonth)) }}" autocomplete="off">
              <input type="hidden" name="hiddenPaxDate" id="hiddenPaxDate" value="">
              <input type="hidden" name="hiddenRatecodeDate" id="hiddenRatecodeDate" value="">
            </form>
          </div><!-- END COL -->

          <div class="col-md-6">
            <div class="selectBoxLabel">
              Select Persons
            </div>
            <form class="" action="/paxChange" method="post" id="paxForm">
              {{ csrf_field() }}
              <select class="custom-select" name="showPax" id="showPax">
                <option value="1" @if ($paxV == 'ratesgl') selected @else '' @endif>1 Person</option>
                <option value="2" @if ($paxV == 'ratedbl') selected @else '' @endif>2 Persons</option>
              </select>
              <input type="hidden" name="hiddenMonthPax" id="hiddenMonthPax" value="">
              <input type="hidden" name="hiddenRatecodePax" id="hiddenRatecodePax" value="">
            </form>

            <div class="selectBoxLabel">
              Select Ratecode
            </div>
            <form class="" action="/ratecodeChange" method="post" id="ratecodeForm">
              {{ csrf_field() }}
              <select class="custom-select" name="showRatecode" id="showRatecode">
                @foreach ($ratesControllerRatecodes as $ratecode)
                  <option value="{{ $ratecode->ratecodeID }}" @if ($getRatecode == $ratecode->ratecodeID) selected @else '' @endif>{{ $ratecode->ratecodeID }}</option>
                @endforeach
              </select>
              <input type="hidden" name="hiddenMonthRatecode" id="hiddenMonthRatecode" value="">
              <input type="hidden" name="hiddenPaxRatecode" id="hiddenPaxRatecode" value="">
            </form>
          </div><!-- END COL -->
        </div><!-- END ROW -->

      </div><!-- END SELECTBOX -->
    </div><!-- END COL -->
  </div><!-- END ROW -->

  <div class="divider-10"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Rate Calendar
        </div>
        <div class="card-body">
          <table class="table table-sm table-hover" id="rateTable">
            <thead>
              <tr>
                <th class="align-middle">Date</th>
                <th></th>
                <th class="align-middle text-left">Level</th>
                @foreach ($ratesControllerCategories as $cat)
                  <th class="align-middle text-right">{{ $cat->categoryID }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
            @foreach ($ratesControllerMaintable as $cal)
            <tr class="@if ($cal->daterate == \Carbon\Carbon::now()->toDateString()) font-weight-bold text-success @elseif (\Carbon\Carbon::parse($cal->daterate)->dayOfWeek == 6 || \Carbon\Carbon::parse($cal->daterate)->dayOfWeek == 0) text-primary @endif">
              <td width="8px" class="text-left">{{ date('d/m', strtotime($cal->daterate)) }}</td>
              <td width="80px" class="text-left">{{ date('D', strtotime($cal->daterate)) }}</td>
              <td width="8px" class="text-left">{{ $cal->_level }}</td>
              @foreach ($cal->rates as $rate)
                @php
                if ($ratesControllerRatecodeValue->discount == 0)
                {
                    $rateResult = number_format($rate->$paxV, 2, ",", ".");
                } else {
                    $rateResult = number_format(($rate->$paxV * ((100-$ratesControllerRatecodeValue->discount)/100)), 2, ",", ".");
                }
                @endphp
                <td class="text-right">&euro; {{ $rateResult }}</td>
              @endforeach
             </tr>
            @endforeach
            </tbody>
          </table>
        </div><!-- END CARD BODY -->
      </div><!-- END CARD -->
    </div><!-- END COL MD 12 -->
  </div><!-- END ROW -->
</div><!-- END CONTAINER -->

<script>
$(document).ready(function() {

  $(function () {
    $('#showMonth').datepicker({
      startView: 'months',
      minViewMode: 'months',
      locale: 'en',
      format: 'M yyyy',
      autoHide: true,
      autoPick: true,
    });
  });

  $(function() {
    $('#showMonth').change(function(e) {
      e.preventDefault();
      var getPax      = $('#showPax').val();
      var getRatecode = $('#showRatecode').val();
      $('#hiddenPaxDate').val(getPax);
      $('#hiddenRatecodeDate').val(getRatecode);
      $('.loader').show();
      $('#dateForm').submit();
    })
  })

  $(function() {
    $('#showPax').change(function(e) {
      e.preventDefault();
      var getMonth    = $('#showMonth').val();
      var getRatecode = $('#showRatecode').val();
      $('#hiddenMonthPax').val(getMonth);
      $('#hiddenRatecodePax').val(getRatecode);
      $('.loader').show();
      $('#paxForm').submit();
    })
  });

  $(function() {
    $('#showRatecode').change(function(e) {
      e.preventDefault();
      var getMonth = $('#showMonth').val();
      var getPax   = $('#showPax').val();
      $('#hiddenMonthRatecode').val(getMonth);
      $('#hiddenPaxRatecode').val(getPax);
      $('.loader').show();
      $('#ratecodeForm').submit();
    })
  });

});
</script>
@endsection
