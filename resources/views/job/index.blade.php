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
  <div id="banner-form">
		<h2>JOB OFFERS</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
    <table class="table table-hover" id="jobofferTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Employer</th>
					<th>Job</th>
          <th>Job Description</th>
          <th class="actionsCol">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <th>ID</th>
        <th>Heading</th>
				<th>Job</th>
        <th>Job Description</th>
      </tfoot>
    </table>
  	</div>
	</div>
</div>

<!-- Employer Modal -->
<div class="modal fade" id="jobModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Job offer for this company</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="jobForm" method="post" action="{{route('job.storeJoboffer')}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group" style="padding-bottom: 20px;">
            <label for="employer_id" class="form-label" style="font-weight: bolder;">{{ __('Employer') }}</label><br>
              {{ Form::select('employer_id', $employer, null, ['class'=>'form-select', 'placeholder'=>'Select employer:']) }}
          </div>
            <div class="form-group">
                <label for="job" class="control-label">Job: </label>
                <input type="text" class="form-control" id="job" name="job">

            </div>
            <div class="form-group"> 
                <label for="jobDesc" class="control-label">Job Description: </label>
                <input type="text" class="form-control " id="jobDesc" name="jobDesc"  >

            </div> 
                <div class="modal-footer">
                	<button id="jobSubmit" type="submit" class="btn btn-primary">Add Job</button>
                </div>  
            </div> 
          </form>
        </div>
    </div>
  </div>
</div>
<!-- end show company modal  -->

@endsection

