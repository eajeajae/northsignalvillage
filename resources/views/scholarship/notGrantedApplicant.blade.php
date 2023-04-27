@extends('layouts.master')

@section('title')
	Applicants Rejected for Scholarship 
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
		<h2>REJECTED SCHOLARSHIP APPLICATION</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
			<table class="table table-hover" id="notGrantedApplicantTable">
	  	<thead>
			<tr>
		  	<th>ID</th>
				<th>Name</th>
		  	<th>Phone number</th>
				<th>School</th>
		  	<th>Course</th>
				<th>Email </th>
		  	<th class="actionsCol">Actions</th>
			</tr>
			</thead>
			<tfoot>
				<th>ID</th>
				<th>Name</th>
		  	<th>Phone number</th>
				<th>School</th>
		  	<th>Course</th>
				<th>Email </th>
	  	</tfoot>
			</table>
  	</div>
	</div>
</div>
@include('scholarship.comment')
@include('scholarship.editScholarshipApplication')
@endsection
