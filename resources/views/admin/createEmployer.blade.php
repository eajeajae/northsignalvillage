@extends('layouts.master')

@section('title')
	Employers (Job Fair)
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
    <div class="col-sm-6"id="banner-form">
		  <h2>EMPLOYERS</h2>
	  </div>
    <div class="col-sm-6">
      <div class="d-grid gap-2 justify-content-end">
        <br><a href="{{route('job.index')}}" role="button" type="button" class="btn btn-success">Add job offers</a>
      </div>
    </div>
  </div>
	
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="employerTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Company Logo</th>
          <th>Company Name</th>
          <th>Company Description</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <th>ID</th>
        <th>Company Logo</th>
        <th>Company Name</th>
        <th>Company Description</th>
      </tfoot>
    </table>
  	</div>
	</div>
</div>

<!-- Employer Modal -->
<div class="modal fade" id="employerModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="font-weight: bolder;">Add Employer</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="employerForm" method="post" action="{{route('admin.storeEmployer')}}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group"> 
            <label for="company_img" class="control-label" style="font-weight: bolder;">Company Logo</label>
            <input type="file" class="form-control" id="company_img" name="company_img">
          </div> 
          <div class="form-group"> 
            <label for="companyName" class="control-label" style="font-weight: bolder;">Company Name: </label>
            <input type="text" class="form-control" id="companyName" name="companyName">
          </div>
          <div class="form-group">
            <label for="companyDesc" class="control-label" style="font-weight: bolder;">Company Description</label>
            <textarea class="form-control" id="companyDesc" name="companyDesc" rows="3"></textarea>
          <div class="modal-footer">
            <button id="employerSubmit" type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
