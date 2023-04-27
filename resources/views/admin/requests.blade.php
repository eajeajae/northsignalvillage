@extends('layouts.master')

@section('title')
	Tech-service | Requests
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
		<h2>REQUESTS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="requestdocumentTable">
      <thead>
        <tr>
          <th>ID</th>
					<th>Requests</th>
          <th>Price</th>
					<th>Mode of Delivery</th>
					<th>Mode of Payment</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
				<th>ID</th>
					<th>Requests</th>
          <th>Price</th>
					<th>Mode of Delivery</th>
					<th>Mode of Payment</th>
      </tfoot>
    </table>
  	</div>
	</div>
</div>
@endsection