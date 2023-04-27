@extends('layouts.master')

@section('title')
	Donations 
@endsection 
@include('layouts.sidebaradmin')
@section('content')
<div class="container">
  <div class="main-panel" id="main-panel" style="padding-bottom:100px;">
	@if(Session::get('success'))
	<div class = "alert alert-success text-center" style="font-weight: bolder;">
		{{ Session::get('success')}}
	</div>
	@endif
	<div id="banner-form">
		<h2>CASH DONATIONS (GCASH)</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="cashdonationTable">
      <thead>
        <tr>
          <th>ID</th>
					<th>Donor</th>
          <th>Amount Donated</th>
					<th>GCASH Details</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <th>ID</th>
				<th>Donor</th>
        <th>Amount Donated</th>
				<th>GCASH Details</th>
      </tfoot>
    </table>
  	</div>
	</div>
  <div id="banner-form">
		<h2>OTHER DONATIONS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="otherdonationTable">
      <thead>
        <tr>
          <th>ID</th>
					<th>Category</th>
          <th>Items</th>
					<th>Quantity</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <th>ID</th>
				<th>Category</th>
        <th>Items</th>
				<th>Quantity</th>
      </tfoot>
    </table>
  	</div>
	</div>
</div>
@include('donation.showCashdonation')
@include('donation.createotherdonation')
@include('donation.editOtherdonation')
@endsection
