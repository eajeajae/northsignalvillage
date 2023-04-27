@extends('layouts.master')

@section('title')
  Apply for a job (job offer)
@endsection 
@include('layouts.sidebar')
@section('content')

<!-- main panel -->
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="homeToken">
<div class="container" id="home">
  <div class="main-panel" id="main-panel">
    <div class="col-sm-12" id="banner-form">
		  <h2>{{$employer->companyName}}</h2>
      <h6>Hiring: {{$joboffer->job}}</h6>
    </div>
		<!-- Success message -->
		@if(Session::get('success'))
		<div class = "alert alert-success text-center" style="font-weight: bolder;">
			{{ Session::get('success')}}
		</div>
        @endif
		@if(Session::get('fail'))
		<div class = "alert alert-danger">
			{{Session::get('fail')}}
		</div>
		@endif
    <div class="content">
    <table class="table" id="jobfairTable">
      <tbody>
        <tr>
          <td><img src="{{ asset($employer->company_img) }}" width="200px" height="200px"></td>
        </tr>
        <tr>
          <td>{{$employer->companyDesc}}</td>
        </tr>
      </tbody>
    </table>
    <form method="post" id="applicantForm" enctype="multipart/form-data" class="row g-3">
      @csrf
      <input type="hidden" name="get_joboffer_id" value="{{$employer->id}}" id="get_joboffer_id">
      <div class="mb-3">
        <input class="form-control form-control-sm" id="resume_file" type="file" name="resume_file">
      </div>
      <div class="d-grid gap-2">
        <button id="applicantSubmit" type="submit" class="btn btn-success">Submit Resume</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection