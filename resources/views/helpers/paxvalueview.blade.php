@foreach ($cal->rates as $rate)
  <td id="showResult" class="text-right">&euro; {{ number_format($rate->$paxValue, 2, ",", ".") }}</td>
@endforeach
