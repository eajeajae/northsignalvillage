@extends('layouts.master')

@section('title')
  Apply for a job
@endsection 
@include('layouts.sidebar')
@section('content')

<!-- main panel -->
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="homeToken">
<div class="container" id="home">
  <div class="main-panel" id="main-panel">
    <div class="col-sm-12" id="banner-form">
			<h2>APPLY FOR A JOB</h2>
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
    <div class="row">
      @if(count($employers) > 0)
      @foreach ($employers as $employer)
      <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <img src="{{ asset($employer->company_img) }}" class="card-img-top"  width="100px" height="250px">
            <div class="card-body">
              <h5 class="card-title" style="font-weight:bolder;">{{ $employer->companyName }}</h5>
              <p class="card-text" style="font-weight:100px;">Looking for: {{ $employer->job }}</p>
                <div class="d-grid gap-2">
                  <a href="{{route('applicant.viewJobdetails', $employer->id)}}" type="button" class="btn btn-success mb-3">View Details</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      
      @else
      <div class="col-sm-12 text-center">
        <h2>No employers yet...</h2>
      </div>
      @endif

      <div class="col-lg-4 col-md-6" id="card-employers" style="display:none;">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Employers</h5>
            <h6 class="card-title" id="company-name"><a href="#"></a></h6>
          </div>
          <div class="card-body">
            <img src="#" width="100px" height="100px" id="company_img">
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69 articleCreatedAt"></i> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection