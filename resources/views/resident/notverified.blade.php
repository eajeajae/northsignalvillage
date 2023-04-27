@extends('layouts.master')

@section('title')
	Not Verified Residents in E-Public Service
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
		<h2>NOT VERIFIED RESIDENTS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="notverifiedResidentTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
					<th>Gender</th>
					<th>Age</th>	
					<th>Email</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
				<th>ID</th>
          <th>Name</th>
					<th>Gender</th>
					<th>Age</th>	
					<th>Email</th>
      </tfoot>
    </table>
  	</div>
	</div>
</div>
@include('resident.edit')
@endsection
