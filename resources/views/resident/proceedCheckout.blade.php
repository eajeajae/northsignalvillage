@extends('layouts.master')

@section('title')
	Tech-service | My Requests
@endsection 
@include('layouts.sidebar')
@section('content')
<!-- Modal -->
@if($transactiondetail->modeofpayment == 'GCASH')
<div class="container">
  <div class="main-panel" id="main-panel">
    <div class="col-sm-12" id="banner-form">
      <h2>BARANGAY ID REQUEST FORM</h2>
    </div>
    @if(Session::get('success'))
    <div class = "alert alert-success text-center" style="font-weight: bolder;">
      {{ Session::get('success')}}
    </div>
    @endif
    @if(Session::get('fail'))
    <div class = "alert alert-danger">
      {{Session::get('fail')}}
    </div>
    @endif
    <div class="card card-form">
      <div class="card-body mx-5 my-5">
        <form method="post" id="gcashPaymentForm" class="form-group row g-3">
          <div class="col-md-12">
            <label for="gcashName" class="form-label card_tags">GCASH Name</label>
            <input type="text" class="form-control" id="gcashName" name="gcashName">
          </div>
          <div class="col-md-12">
            <label for="gcashNumebr" class="form-label card_tags">GCASH Number</label>
            <input type="text" class="form-control" id="gcashNumebr" name="gcashNumber">
          </div>
          <div class="col-12">
            <div class="mb-3">
              <label for="payment_img" class="form-label card_tags">Upload Receipt</label>
              <input class="form-control form-control-sm" id="payment_img" name="payment_img" type="file">
            </div>
          </div>
          <div class="d-grid gap-2 justify-content-end">
            <button class="btn btn-success" type="submit" id="gcashpaymentSubmit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@else
<div class="container">
  <div class="main-panel" id="main-panel">
    <div class="col-sm-12" id="banner-form">
      <h2>BARANGAY ID REQUEST FORM</h2>
    </div>
    @if(Session::get('success'))
    <div class = "alert alert-success text-center" style="font-weight: bolder;">
      {{ Session::get('success')}}
    </div>
    @endif
    @if(Session::get('fail'))
    <div class = "alert alert-danger">
      {{Session::get('fail')}}
    </div>
    @endif
    <div class="card card-form">
      <div class="card-body mx-5 my-5">
        
      </div>
    </div>
  </div>
</div>
@endif
@endsection

