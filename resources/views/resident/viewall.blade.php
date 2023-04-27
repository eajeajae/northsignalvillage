@extends('layouts.master')

@section('title')
	Residetnts
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
			@if(empty($notVerifiedResidents))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-user-times fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; color:#234880;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Not Verified Residents</p>
							<h2 class="card-text">---</h2>
							<small class="text-muted">Total Count</small>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-user-times fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; color:#234880;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Not Verified Residents</p>
							<h2 class="card-text">{{$notVerifiedResidents}}</h2>
							<small class="text-muted">Total Count</small>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="col-sm-6">
			@if(empty($verifiedResidents))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-user-check fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; color:#234880;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Verified Residents</p>
							<h2 class="card-text">---</h2>
							<small class="text-muted">Total Count</small>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-user-check fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; color:#234880;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Verified Residents</p>
							<h2 class="card-text">{{$verifiedResidents}}</h2>
							<small class="text-muted">Total Count</small>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
  </div>
	<div id="banner-form">
		<h2>RESIDENTS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="residentTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
					<th>Gender</th>
					<th>Age</th>	
					<th>Email</th>
          <th>Status</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
				<th>ID</th>
          <th>Name</th>
					<th>Gender</th>
					<th>Age</th>	
					<th>Email</th>
          <th>Status</th>
      </tfoot>
    </table>
  	</div>
	</div>
</div>
@include('resident.edit')
@endsection
