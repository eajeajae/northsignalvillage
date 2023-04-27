@extends('layouts.master')

@section('title')
	Scheduling Vaccination Form
@endsection 
@include('layouts.sidebar')
@section('content')
<div class="container">
    <div class="main-panel" id="main-panel">
        <div class="col-sm-12" id="banner-form">
            <h2>SCHEDULE VACCINATION</h2>
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
            <form method="post" action="{{route('schedulevaccine.store')}}" enctype="multipart/form-data" class="row g-3" id="schedulevaccineForm">
                @csrf
								<div class="col-sm-6">
									<h6 class="card_tags">REQUIREMENTS: </h6>
									<p>1. Bring Valid ID</p>
									<p>2. Screenshot of the email sent to you</p>
                </div>
                <div class="col-sm-6">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label text-md-end">{{ __('First Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="phone_num" class="form-label text-md-end">{{ __('Phone Number') }}</label>
                            <input id="phone_num"  type="phone_num" class="form-control" name="phone_num" value="{{ $user->phoneNum }}" >
                        </div>
												<div class="col-md-12">
                            <label for="email" class="form-label text-md-end">{{ __('Email') }}</label>
                            <input id="email"  type="email" class="form-control" name="email" value="{{$user->email}}">
                        </div>
                        <div class="col-md-12">
                            <label for="vaccine" class="form-label text-md-end">{{ __('Type of Vaccine') }}</label>
                            {{ Form::select('vaccine_id', $vaccine, null, ['class'=>'form-select', 'placeholder'=>'Select Vaccine:']) }}
                        </div>
                        <div class="col-md-6">
                            <label for="date" class="form-label text-md-end">{{ __('Registration Date') }}</label>
                            <input id="date"  type="date" class="form-control" name="date" >
                        </div>
                        <div class="col-md-6">
                            <label for="time" class="form-label text-md-end">{{ __('Registration Time') }}</label>
                            <input id="time"  type="time" class="form-control" name="time" >
                        </div>
												<div class="col-sm-12">
													<label for="address" class="form-label text-md-end">{{ __('Address ') }}</label>
												</div>
                        <div class="col-md-3">
                            <input id="addressNo"  type="address" class="form-control" name="addressNo" value="{{ $user->addressNo }}" >
                        </div>
                        <div class="col-sm-9">
                            <input id="street"  type="address" class="form-control" name="street" value="{{ $user->street }}" >
                        </div>
                    	</div>
                		</div>
                    <div class="d-grid gap-2 justify-content-md-end mx-auto">
                        <button type="submit"  class="btn btn-success" id="schedulevaccineSubmit">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection