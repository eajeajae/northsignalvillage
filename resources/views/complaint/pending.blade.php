@extends('layouts.master')

@section('title')
	Filed Complaints (Pending)
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
		<h2>PENDING COMPLAINTS</h2>
	</div>
	<div class="container">
		<div class="table-responsive">
      <table class="table table-hover" id="pendingComplaintTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Case No</th>
            <th>Case Title</th>
            <th>Complaint Title/Nature</th>
            <th>Date Filed</th>
            <th>Date of first hearing</th>
            <th class="actionsCol">Actions</th>
          </tr>
        </thead>
      </table>
		</div>
	</div>
</div>
@include('complaint.editComplaint')
@include('complaint.createComplaint')
@endsection
