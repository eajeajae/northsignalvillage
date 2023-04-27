@extends('layouts.master')

@section('title')
	Applicants (Job Fair)
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
		<div class="col-sm-6">
			@if(empty($employers))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-building fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Employers</p>
							<h5 class="card-text">---</h5>
							<a href="{{route('admin.employer')}}" class="card-text"><small class="text-muted">Employer Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-building fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Employers</p>
							<h2 class="card-text">{{$employers}}</h2>
							<a href="{{route('admin.employer')}}" class="card-text"><small class="text-muted">Employer Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
    <div class="col-sm-6">
			@if(empty($joboffers))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-briefcase fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Job Offers</p>
							<h5 class="card-text">---</h5>
							<a href="{{route('job.index')}}" class="card-text"><small class="text-muted">Job Offer Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-briefcase fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Job Offers</p>
							<h2 class="card-text">{{$joboffers}}</h2>
							<a href="{{route('job.index')}}" class="card-text"><small class="text-muted">Job Offer Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
  </div>
	<div id="banner-form">
		<h2>APPLICANTS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
			<table class="table table-hover" id="applicantTable">
	  	<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
		  	<th>Company Name</th>
				<th>Job</th>
		  	<th class="actionsCol">Actions</th>
			</tr>
			</thead>
			<tfoot>
				<th>ID</th>
     	 	<th>Name</th>
		  	<th>Company Name</th>
				<th>Job</th>
			</tfoot>
			</table>
  	</div>
	</div>
</div>
@include('applicant.editApplication')
@endsection
