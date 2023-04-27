@extends('layouts.master')

@section('title')
	My Requests
@endsection 
@include('layouts.sidebar')
@section('content')
<div class="container">
  <div class="main-panel" id="main-panel">
    <div class="col-sm-12" id="banner-form">
      <h2>MY REQUESTS</h2>
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
    <div class="card card_payment">
      <div class="card-body">
				<div class="row g-3">
				  @if(count($barangayids) > 0 || count($certificaterequests) > 0 || count($clearancerequests) > 0)
				  <div class="col-sm-6">
						<p>Here is the list of the documents you requested in our tech-service. If you wish to pay using Gcash, you can send the payment to the given gcash details below: </p>
						<p><span class="card_tags">Gcash number:</span> 09976355154</p>
        		<p><span class="card_tags">Gcash Name:</span> Abbygale Mendoza</p>
						<hr style="border: none;
            height: 2px;
            background: #234880;"
            >
						<div class="row g-3">
            @php $barangayidTotal = 0; $certificateTotal = 0;  $clearanceTotal = 0; $totalAmount = 0; @endphp
						  @foreach($barangayids as $barangayid)
							<div class="col-sm-8">
								<h7>Barangay ID</h7>
							</div>
							<div class="col-sm-4">
								<button class="btn btn-xs btn-primary editMyBarangayIdbtn" value="{{$barangayid->id}}"id='button-edit-request'><i class='fas fa-edit'></i></button>
								<button type="button" class="btn btn-primary deleteMyBarangayidbtn" id="button-delete-request"name="certificate_delete" value="{{$barangayid->id}}">
									<i class="fas fa-trash-alt" type="button"></i>
								</button>
							</div>
							<div class="col-sm-4 card_tags">
								<h7>Price: </h7>
							</div>
							<div class="col-sm-4">
								<h7>P{{$barangayid->price}}.00</h7>
							</div>
							<div class="col-sm-4">
                
							</div>
							<hr style="border: none;
              height: 2px;
              background: #234880;"
              >
							@endforeach
              @foreach($certificaterequests as $certificate)
                <div class="col-sm-8">
                  <h7>{{$certificate->typeofdoc}}</h7>
                </div>
                <div class="col-sm-4">
                  <button class="btn btn-xs btn-primary editMyCertificaterequestbtn" value="{{$certificate->id}}"id='button-edit-request'><i class='fas fa-edit'></i></button>
                  <button type="button" class="btn btn-primary deleteMyCertificaterequestbtn" id="button-delete-request"name="certificate_delete" value="{{$certificate->id}}">
                    <i class="fas fa-trash-alt" type="button"></i>
                  </button>
                </div>
                <div class="col-sm-4 card_tags">
                  <h7>Price: </h7>
                </div>
                <div class="col-sm-4">
                  <h7>P{{$certificate->price}}.00</h7>
                </div>
                <div class="col-sm-4">

                </div>
                <hr style="border: none;
                height: 2px;
                background: #234880;"
                >
							@endforeach
              @foreach($clearancerequests as $clearance)
                <div class="col-sm-8">
                  <h7>{{$clearance->typeofdoc}}</h7>
                </div>
                <div class="col-sm-4">
                  <button class="btn btn-xs btn-primary editMyClearancerequestbtn" value="{{$clearance->id}}"id='button-edit-request'><i class='fas fa-edit'></i></button>
                  <button type="button" class="btn btn-primary deleteMyClearancerequestbtn" id="button-delete-request"name="certificate_delete" value="{{$clearance->id}}">
                    <i class="fas fa-trash-alt" type="button"></i>
                  </button>
                </div>
                <div class="col-sm-4 card_tags">
                  <h7>Price: </h7>
                </div>
                <div class="col-sm-4">
                  <h7>P{{$clearance->price}}.00</h7>
                </div>
                <div class="col-sm-4">

                </div>
                <hr style="border: none;
                height: 2px;
                background: #234880;"
                >
							@endforeach
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card card-payment">
							<div class="card-body card-payment-body">
								<h7 class="card_tags">Transaction Summary</h7>
								<form class="row g-3"class="form-group row g-3" method="post" id="submitForm" enctype="multipart/form-data">
         	 			  {{ csrf_field() }}
                  <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
									@foreach($barangayids as $barangayid)
									<input type="hidden" id="barangayid_id" name="barangayid_id" value="{{$barangayid->id}}">
									<div class="col-sm-6">
										<h7>Barangay ID</h7>
									</div>
									<div class="col-sm-6">
										<h7>P{{$barangayid->price}}</h7>
									</div>
                  @php $barangayidTotal += ((int)$barangayid->price) @endphp 
									@endforeach
                  @foreach($certificaterequests as $certificate)
                  <input type="hidden" id="certificate_id" name="certificate_id" value="{{$certificate->id}}">
									<div class="col-sm-6">
										<h7>{{$certificate->typeofdoc}}</h7>
									</div>
									<div class="col-sm-6">
										<h7>P{{$certificate->price}}</h7>
									</div>
									@php $certificateTotal += ((int)$certificate->price) @endphp
									@endforeach
                  @foreach($clearancerequests as $clearance)
                  <input type="hidden" id="clearance_id" name="clearance_id" value="{{$clearance->id}}">
									<div class="col-sm-6">
										<h7>{{$clearance->typeofdoc}}</h7>
									</div>
									<div class="col-sm-6">
										<h7>P{{$clearance->price}}</h7>
									</div>
									@php $clearanceTotal += ((int)$clearance->price) @endphp
									@endforeach
                  
                  @php $totalAmount += $barangayidTotal + $certificateTotal + $clearanceTotal @endphp
									
									<hr style="border: none;
                    height: 2px;
                    background: #234880;"
                    >
										
									<div class="col-sm-6">
										<h7 class="card_tags">Total Amount:</h7>
									</div>
									<div class="col-sm-6">
										<input style="border: none; background-color:transparent;" type="text" id="total_amount" name="total_amount" value="{{$totalAmount}}">
									</div>
									<hr style="border: none;
                    height: 2px;
                    background: #234880;"
                    >
									<div class="col-sm-12 card_tags">
                    <label for="modeofdelivery" class="form-label">Mode of delivery:</label>
                  </div>
                  <div class="col-sm-12">
										@foreach($mod as $mod)
										<div class="form-check form-check-inline">
											<input class="form-check-input mod" type="radio" name="modeofdelivery_id" id="modeofdelivery_id" value="{{$mod->id}}">
											<label class="form-check-label" for="modeofdelivery_id">{{$mod->modeofdelivery}} {{$mod->fee}}</label>
										</div>
										@endforeach
									</div>
									<hr style="border: none;
											height: 2px;
											background: #234880;"
											>
                  <div class="col-sm-12 card_tags">
                    <label for="modeofdelivery" class="form-label">Mode of payment:</label>
                  </div>
									<div class="col-sm-12">
										<div class="form-check form-check-inline">
											<input class="form-check-input mop-cash" type="radio" name="modeofpayment" id="modeofpayment" value="Cash">
											<label class="form-check-label" for="modeofpayment">Cash</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input mop" type="radio" name="modeofpayment" id="modeofpayment-gcash" value="GCASH">
											<label class="form-check-label" for="modeofpayment">GCASH</label>
										</div>
									</div>
									<div class="d-grid gap-2 justify-content-end">
										<button class="btn btn-success" type="submit" id="proceedBtn">Proceed</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				
				@else
				<div class="col-sm-12 text-center">
					<h2>You do not have requests yet</h2>
				</div>
				@endif
				</div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="proceedGcashpaymentModal" tabindex="-1" aria-labelledby="proceedGcashpaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">GCASH PAYMENT</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="gcashpaymentForm" class="form-group row g-3">
        {{ csrf_field() }}
          <input type="text" name="transactiondetail_id" id="transactiondetail_id">
          <div class="col-md-12">
            <label for="gcashName" class="form-label card_tags">GCASH Name</label>
            <input type="text" class="form-control" id="gcashName" name="gcashName">
          </div>
          <div class="col-md-12">
            <label for="gcashNumber" class="form-label card_tags">GCASH Number</label>
            <input type="text" class="form-control" id="gcashNumber" name="gcashNumber">
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
@include('barangayid.editMybarangayid')
@include('certificate.editMycertificate')
@include('clearance.editMyclearance')
@endsection



