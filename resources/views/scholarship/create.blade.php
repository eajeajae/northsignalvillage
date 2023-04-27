@extends('layouts.master')

@section('title')
	Scholarship Application Form
@endsection 
@include('layouts.sidebar')
@section('content')
<div class="container">
    <div class="main-panel" id="main-panel">
        <div class="col-sm-12" id="banner-form">
            <h2>SCHOLARSHIP FORM</h2>
        </div>
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
        <div class="card card-form">
            <div class="card-body">
            <form method="post" action="{{route('scholarship.store')}}" enctype="multipart/form-data" class="row g-3" id="scholarshipForm">
                @csrf
                    <div class="col-md-8">
                        <label for="scholarFname" class="form-label text-md-end">{{ __('Full Name (Ex: Juan P. Dela Cruz') }}</label>
                        <input id="scholarFname" type="text" class="form-control @error('scholarFname') is-invalid @enderror" name="scholarFname" value="{{ $user->name }}" autocomplete="scholarFname" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="scholarPhonenum" class="form-label text-md-end">{{ __('Phone Number') }}</label>
                        <input id="scholarPhonenum"  type="scholarPhonenum" class="form-control @error('scholarPhonenum') is-invalid @enderror" name="scholarPhonenum" value="{{ $user->phoneNum }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="scholarSchool" class="form-label text-md-end">{{ __('School') }}</label>
                        <input id="scholarSchool"  type="scholarSchool" class="form-control @error('scholarSchool') is-invalid @enderror" name="scholarSchool" value="{{ old('scholarSchool') }}" >
                    </div>
                    <div class="col-md-6">
                        <label for="scholarCourse" class="form-label text-md-end">{{ __('Course') }}</label>
                        <input id="scholarCourse"  type="scholarCourse" class="form-control @error('scholarCourse') is-invalid @enderror" name="scholarCourse" value="{{ old('scholarCourse') }}" >
                    </div>
                    <div class="col-md-12">
                        <label for="scholarEmail" class="form-label text-md-end">{{ __('Email') }}</label>
                        <input id="scholarEmail"  type="address" class="form-control @error('scholarEmail') is-invalid @enderror" name="scholarEmail" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="form-group">
                    <label for="scholarCor_img" class="form-label">Upload COR:</label>
                    <input class="form-control" type="file" id="scholarCor_img" name="scholarCor_img">
                  </div>
                  <div class="form-group">
                    <label for="scholarGrade_img" class="form-label">Upload Grades :</label>
                    <input class="form-control" type="file" id="scholarGrade_img" name="scholarGrade_img">
                  </div>
                    <div class="d-grid gap-2 justify-content-md-end mx-auto">
                        <button type="submit"  class="btn btn-success" id="scholarshipSubmit">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection