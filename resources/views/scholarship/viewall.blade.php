@extends('layouts.master')

@section('title')
	Scholarship Applicants
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
	<div class="row">
		<div class="col-sm-4">
			@if(empty($waitinglists))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/img/waiting-list.png" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; height:50px; width:50px;"></img>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Waiting List (For Evaluation)</p>
							<h5 class="card-text">---</h5>
							<a href="{{route('scholarship.viewall')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/img/waiting-list.png" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; height:50px; width:50px;"></img>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Waiting List (For Evaluation)</p>
							<h2 class="card-text">{{$waitinglists}}</h2>
							<a href="{{route('scholarship.viewall')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="col-sm-4">
			@if(empty($grantedapplicants))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="far fa-check-circle fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Granted for Scholarship</p>
							<h5 class="card-text">---</h5>
							<a href="{{route('scholarship.viewGrantedApplicants')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="far fa-check-circle fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Approved</p>
							<h2 class="card-text">{{$grantedapplicants}}</h2>
							<a href="{{route('scholarship.viewGrantedApplicants')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
    <div class="col-sm-4">
			@if(empty($notgrantedapplicants))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="far fa-times-circle fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Not Granted for Scholarship</p>
							<h5 class="card-text">---</h5>
							<a href="{{route('scholarship.viewNotGrantedApplicants')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="far fa-times-circle fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Not Granted for Scholarship</p>
							<h2 class="card-text">{{$notgrantedapplicants}}</h2>
							<a href="{{route('scholarship.viewNotGrantedApplicants')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
  </div>
	<div id="banner-form">
		<h2>SCHOLARSHIP APPLICANTS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
			<table class="table table-hover" id="scholarshipTable">
	  	<thead>
			<tr>
		  	<th>ID</th>
				<th>Name</th>
		  	<th>Phone number</th>
				<th>School</th>
		  	<th>Course</th>
				<th>Email </th>
				<th>status</th>
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
				<th>status</th>
	  	</tfoot>
			</table>
  	</div>
	</div>
</div>
@include('scholarship.editScholarshipApplication')
@endsection
