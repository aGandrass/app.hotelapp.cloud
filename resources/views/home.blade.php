@extends('layouts.app')
@include('layouts.navstart')
@section('content')
<div class="container">

  <div class="divider-100"></div>

  <div class="pricing-header mx-auto text-center">
    <h1 class="display-4">Please choose your department</h1>
  </div>

  <div class="divider-50"></div>

  <div class="card-deck mb-3 text-center">

    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Payments</h4>
      </div>
      <div class="card-body">
        <p>Create and monitor payments<br></p>
        <button onclick="window.location.href='{{ url('paymentsdashboard') }}'" type="button" class="btn btn-lg btn-block btn-outline-primary">Access Payments</button>
      </div>
    </div>

    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Rates & Availability</h4>
      </div>
      <div class="card-body">
        <p>Overview of Rates<br>Create Rate Enquiries</p>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Access Rates</button>
      </div>
    </div>

    <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Payments</h4>
      </div>
      <div class="card-body">
        <p>Create and monitor payments</p>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Access Payments</button>
      </div>
    </div>

  </div>
</div><!-- END CONTAINTER -->
@endsection
