@extends('layouts.master')

@section('title')
	Donation Form 
@endsection 
@include('layouts.sidebar')
@section('content')
<div class="container">
    <div class="main-panel" id="main-panel">
        
        <div class="row">
          <div class="col-md-7">
            <div class="col-sm-12" id="banner-form">
              <h2>DONATION FORM </h2>
              <h8 style="color: #234880"> Let's help our fellow residents by donating</h8>
            </div>
            <!-- Success message -->
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
                <form method="post" action="{{route('donation.store')}}" id="donationForm" enctype="multipart/form-data" class="row g-3">
                  @csrf
                  <h6 style="color: #234880; font-weight: bolder;">Cash Donation via G-Cash</h6>
                  
                  <h6 style="font-size: 12px;font-weight:bold;">Official G-Cash Number of the Barangay:  09xxxxxxxx24</h6>
                  <h6></h6>
                  <hr/>
                  <div class="form-group">
                    <label>G-Cash Full Name</label>
                    <input type="text" class="form-control"  name="gcashName" id="gcashName">
                  </div>
                  <div class="form-group">
                    <label>G-Cash Number</label>
                    <input type="text" class="form-control"  name="gcashPhoneNum" id="gcashPhoneNum">
                  </div>
                  <div class="form-group">
                    <label>Donor Name</label>
                    <input type="text" class="form-control" name="donorName" id="donorName" value="{{ $user->name }}" readonly>
                  </div>
                  <div class="form-group">
                    <label>Amount Donated</label>
                    <input type="text" class="form-control" name="amountDonated" id="amountDonated">
                  </div>
                  <div class="col-sm-12">
                        <label for="receipt_img" class="form-label">Upload your receipt :</label>
                        <input class="form-control" type="file" id="receipt_img" name="receipt_img">
                    </div>
                  <div class="d-grid gap-2 justify-content-md-end" style="padding-top:10px;">
                    <button class="btn btn-success" type="submit" id="donationSubmit">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-sm-5" id="banner-form">
            <h6 style="text-align: center; color: #234880; font-weight: bolder; padding-top:100px;"> OTHER DONATIONS</h6>
            
            <hr>
            <h6 style="text-align: center; color: #234880;">The donation for Food and Clothes will be over the barangay. The staff of the barangay will assist your donation.</h6> 
          </div>
        </div>
        
            
    </div>
</div>
@endsection