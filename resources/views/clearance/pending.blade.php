@extends('layouts.master')

@section('title')
	Pending Requests for Clearance
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
		<h2>PENDING CLEARANCE REQUESTS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="pendingTable">
      <thead>
        <tr>
          <th>ID</th>
					<th>Purpopse</th>
					<th>Name</th>
					<th>Contact</th>
					<th>Address</th>
          <th>Clearance</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <th>ID</th>
				<th>Purpopse</th>
				<th>Name</th>
				<th>Contact</th>
				<th>Address</th>
        <th>Clearance</th>
      </tfoot>
    </table>
  	</div>
	</div>
</div>
@include('clearance.editPendingClearance')
@include('clearance.generateClearance')
@endsection
