@extends('layouts.app')
@section('content')
@include('layouts.navrates')
<div class="loader"></div>
<div class="divider-30"></div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="selectBox">
        <form class="" action="" method="POST" id="calculatorForm">
        {{ csrf_field() }}

          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="selectBoxLabel">
                    Select Arrival
                  </div>
                  <input class="form-control" type="text" name="arrival" id="arrival" value="" autocomplete="off">
                </div>
                <div class="col-md-6">
                  <div class="selectBoxLabel">
                    Select Departure
                  </div>
                  <input class="form-control" type="text" name="departure" id="departure" value="" autocomplete="off">
                </div>
              </div><!-- END ROW -->
            </div><!-- END COL -->

            <div class="col-md-6">
              <div class="selectBoxLabel">
                Select Rooms
              </div>
              <select class="custom-select" name="rooms" id="rooms">
                {{ $sum = 0 }}
                @for ($i = 1; $i<=$maximalRooms->settingsValue; $i++)
                  <option value="{{ $sum + $i }}">{{ $sum + $i }}</option>
                @endfor
              </select>
            </div><!-- END COL -->
          </div><!-- END ROW -->

          <div class="row">
            <div class="col-md-3">
              <div class="selectBoxLabel">
                Select Adults
              </div>
              <select class="custom-select" name="adults" id="adults">
                {{ $sum = 0 }}
                @for ($i = 1; $i<=$maximalAdults->settingsValue; $i++)
                  <option value="{{ $sum + $i }}" @if (($sum + $i) == 2) selected="selected" @endif>{{ $sum + $i }}</option>
                @endfor
              </select>
            </div>
            <div class="col-md-3">
              <div class="selectBoxLabel">
                Select Kids
              </div>
              <select class="custom-select" name="kids" id="kids">
                {{ $sum = 0 }}
                @for ($i = 0; $i<=$maximalKids->settingsValue; $i++)
                  <option value="{{ $sum + $i }}">{{ $sum + $i }}</option>
                @endfor
              </select>
            </div>
            <div class="col-md-3">
              <div class="selectBoxLabel">
                Select Kids Age
              </div>
              <select class="custom-select" name="kidsage1" id="kidsage1" disabled>
                <option value="0"></option>
                @foreach ($kidsAge as $age)
                  <option value="{{ $age->childrenageID }}">{{ $age->title }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <div class="selectBoxLabel">
                Select Kids Age
              </div>
              <select class="custom-select" name="kidsage2" id="kidsage2" disabled>
                <option value="0"></option>
                @foreach ($kidsAge as $age)
                  <option value="{{ $age->childrenageID }}">{{ $age->title }}</option>
                @endforeach
              </select>
            </div><!-- END COL -->
          </div><!-- END ROW -->

          <div class="divider-30"></div>

          <div class="row justify-content-center">
            <div class="col-4">
              <button class="btn btn-outline-primary btn-lg btn-block" type="button" name="sendCal" id="sendCal">Start Enquiry</button>
            </div>
          </div>

        </form><!-- END FORM -->
      </div><!-- END SELECTBOX -->
    </div><!-- END COL -->
  </div><!-- END ROW -->

  <div class="divider-10"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Rate Enquiry
        </div>
        <div class="card-body">
          <div class="accordion" id="calculateAccordion">
            <div class="resultAccordion">
            </div>
          </div>
        </div><!-- END CARD BODY -->
      </div><!-- END CARD -->
    </div><!-- END COL MD 12 -->
  </div><!-- END ROW -->
</div><!-- END CONTAINER -->

<script>
$(document).ready(function() {
  moment.locale('de');

  $(function () {
    var date = new Date();
    date.setDate(date.getDate());

    $('#arrival').datepicker({
      language: 'en',
      format: 'dd-mm-yyyy',
      todayBtn: 'linked',
      todayHighlight: true,
      autoclose: true,
      startDate: date,
    });
    $('#arrival').datepicker().on('changeDate', function() {
      $('#departure').datepicker('destroy');
      var temp = $(this).datepicker('getDate');
      var d    = new Date(temp);
      d.setDate(d.getDate() + 1);
      $('#departure').datepicker({
        language: 'en',
        format: 'dd-mm-yyyy',
        autoclose: true,
        startDate: d,
      }).datepicker('setDate', d);
    });
  });

  $(function() {
    $('#kids').change(function() {
      var val = $(this).val();
      if (val == 1) {
        $('#kidsage1').removeAttr('disabled');
        $('#kidsage2').attr('disabled', true);
        $('#kidsage2').val('');
      } else if (val == 2) {
        $('#kidsage1').removeAttr('disabled');
        $('#kidsage2').removeAttr('disabled');
      } else if (val == 0) {
        $('#kidsage1').attr('disabled', true);
        $('#kidsage2').attr('disabled', true);
        $('#kidsage1').val('');
        $('#kidsage2').val('');
      }
    });
  });

  $(function() {
    $('#sendCal').click(function(e) {
      e.preventDefault();
      $('.loader').show();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var arrival   = $('#arrival').val();
      var departure = $('#departure').val();
      var rooms     = $('#rooms').val();
      var adults    = $('#adults').val();
      var kids      = $('#kids').val();
      var kidsage1  = $('#kidsage1').val();
      var kidsage2  = $('#kidsage2').val();
      $.ajax({
        method: 'POST',
        url: '/ratecalculate',
        datatype: 'JSON',
        data: { arrival: arrival, departure: departure, rooms: rooms, adults: adults, kids: kids, kidsage1: kidsage1, kidsage2: kidsage2 },
          success: function(data) {
            $('.loader').hide();
            console.log(data[0], date[1]);




            }
        });
      });
    });

});
</script>
@endsection
