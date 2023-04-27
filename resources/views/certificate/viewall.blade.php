@extends('layouts.master')

@section('title')
	Barangay Certificate Requests
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
			@if(empty($incartcertificateRequests))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-file-import fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Incoming Requests</p>
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
						<i class="fas fa-file-import fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Incoming Requests</p>
							<h2 class="card-text">{{$incartcertificateRequests}}</h2>
							<small class="text-muted">Total Count</small>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="col-sm-4">
			@if(empty($pendingcertificateRequests))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/img/waiting-list.png" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; height:50px; width:50px;">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Pending Requests</p>
							<h2 class="card-text">---</h2>
							<a href="{{route('certificate.pending')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/img/waiting-list.png" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; height:50px; width:50px;">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Pending Requests</p>
							<h2 class="card-text">{{$pendingcertificateRequests}}</h2>
							<a href="{{route('certificate.pending')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="col-sm-4">
			@if(empty($donecertificateRequests))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-clipboard-check fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Received by the residents</p>
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
						<i class="fas fa-clipboard-check fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Received by the residents</p>
							<h2 class="card-text">{{$donecertificateRequests}}</h2>
							<small class="text-muted">Total Count</small>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
  </div>
	<div id="banner-form">
		<h2>REQUESTED CERTIFICATES</h2>
	</div>
	<div class="container">
		<div class="table-responsive">
			<table class="table table-hover" id="certificateTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Purpopse</th>
						<th>Name</th>
						<th>Contact</th>
						<th>Address</th>
            <th>Certificate</th>
						<th class="actionsCol">Actions</th>
					</tr>
				</thead>
				<tfoot>
          <th>ID</th>
					<th>Purpopse</th>
					<th>Name</th>
					<th>Contact</th>
					<th>Address</th>
          <th>Certificate</th>
				</tfoot>
			</table>
  	</div>
	</div>
</div>
@include('certificate.editCertificate')
@include('certificate.editPendingCertificate')
@include('certificate.generateCertificate')
@endsection
