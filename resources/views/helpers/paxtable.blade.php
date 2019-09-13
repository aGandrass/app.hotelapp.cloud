@foreach ($ratesControllerMaintable as $cal)
<tr class="@if ($cal->daterate == \Carbon\Carbon::now()->toDateString()) font-weight-bold text-success @elseif (\Carbon\Carbon::parse($cal->daterate)->dayOfWeek == 6 || \Carbon\Carbon::parse($cal->daterate)->dayOfWeek == 0) text-primary @endif">
  <td width="8px" class="text-left">{{ date('d/m', strtotime($cal->daterate)) }}</td>
  <td width="80px" class="text-left">{{ date('D', strtotime($cal->daterate)) }}</td>
  <td width="8px" class="text-left">{{ $cal->_level }}</td>
  @foreach ($cal->rates as $rate)
    <td class="text-right">&euro; {{ $rate->$paxValue }}</td>
  @endforeach
 </tr>
@endforeach
