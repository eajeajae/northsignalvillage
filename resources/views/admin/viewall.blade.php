@extends('layouts.master')

@section('title')
	Admins 
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
		<h2>ADMINS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="adminTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
					<th>Address</th>
					<th>Gender</th>
					<th>Age</th>	
					<th>Email</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
				<th>ID</th>
          <th>Name</th>
					<th>Address</th>
					<th>Gender</th>
					<th>Age</th>	
					<th>Email</th>
      </tfoot>
    </table>
  	</div>
	</div>
</div>
@include('admin.editAdmin')
@include('admin.createEmployee')
@endsection
