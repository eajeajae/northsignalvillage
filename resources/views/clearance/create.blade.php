@extends('layouts.master')

@section('title')
	Request for Barangay Clearance
@endsection 
@include('layouts.sidebar')
@section('content')
<div class="container">
	<div class="main-panel" id="main-panel">
    <div class="row g-3">
      <div class="col-sm-6" id="banner-form">
        <h2>BARANGAY CLEARANCE FORM</h2>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#requirementsModal">
          Requirements
        </button>
      </div>
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
			<div class="card-body mx-5 my-5">
			  <form class="form-group row g-3" action="{{route('clearance.store')}}" method="post" enctype="multipart/form-data" id="clearanceForm">
          {{ csrf_field() }}
          <!-- barangay clearance -->
            <div id="barangayClearance">
              <div class="card-body row">
                @foreach($typeofrequest_id as $typeofrequest_id)
                <div class="col-md-6">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$typeofrequest_id->id}}" id="typeofrequest_id[]" name="typeofrequest_id[]">
                    <label class="form-check-label" for="typeofrequest_id">{{$typeofrequest_id->typeofdoc}}</label>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          <!-- end of barangay clearance --> 
          <hr style="border: none;
                    height: 2px;
                    background: #234880;"
                    >
          <div id="instruction-form">
            <h6 class="text-center" style="color: #234880; font-weight: bolder;">Reminder: All blanks or questions must be fill up (Dapat punan at sagutan ang lahat ng sumusunod)</h6>
          </div>
          <hr style="border: none;
                    height: 2px;
                    background: #234880;"
                    >
          <div class="row g-3">
            <div class="col-sm-12">
              <div class="input-group">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="purpose">Purpose of Clearance/Certificate:</span>
                  <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="purpose" id="purpose" name="purpose">
                </div>
              </div>
            </div>
            <div class="col-sm-9">
              <span class="input-group-text">Are you a registered voter of this barangay?(Rehistrado ka ba?): </span>
            </div>
            <div class="col-sm-3">
              <div class="input-group"> 
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="isRegistered" id="isRegistered" value="yes">
                  <label class="form-check-label" for="isRegistered">YES</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="isRegistered" id="isRegistered" value="no">
                  <label class="form-check-label" for="isRegistered">NO</label>
                </div>
              </div>
            </div>
            <div class="col-sm-9">
              <span class="input-group-text">Do you have pending case before the Barangay/Lupon Tagamayapa?: </span>  
            </div>
            <div class="col-sm-3">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="havePendingCase" id="havePendingCase" value="yes">
                <label class="form-check-label" for="havePendingCase">YES</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="havePendingCase" id="havePendingCase" value="no">
                <label class="form-check-label" for="havePendingCase">NO</label>
              </div>
            </div>
          </div> 
          <!-- end of row g-3 -->
          <hr style="border: none;
                    height: 2px;
                    background: #234880;"
                    >
          <!-- start of personal information -->
            <div class="col-sm-8">
              <label for="name" class="form-label">Name :</label>
              <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" readonly>
            </div>
            <div class="col-sm-3">
              <label for="gender" class="form-label">Gender :</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="female" {{$user->gender == "female" ? 'checked' : ''}} disabled>
                <label class="form-check-label" for="gender">Female</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="male" {{$user->gender == "male" ? 'checked' : ''}} disabled>
                <label class="form-check-label" for="gender">Male</label>
              </div>
            </div>
            <div class="col-sm-4">
              <label for="birthdate" class="form-label">Birthday :</label>
              <input type="date" class="datepicker form-control" data-date-format="mm/dd/yyyy" class="form-control" id="birthdate" name="birthdate" value="{{$user->birthdate}}" readonly>
            </div>
            <div class="col-sm-4">
              <label for="p_birth" class="form-label">Place of Birth :</label>
              <input type="text" class="form-control" id="p_birth" name="p_birth">
            </div>
            <div class="col-sm-4">
              <label for="nationality" class="form-label">Nationality :</label>
              <input type="text" class="form-control" id="nationality" name="nationality">
            </div>
            <div class="col-sm-6">
              <label for="contact_num" class="form-label">Contact No. :</label>
              <input type="text" class="form-control" id="contact_num" name="contact_num" value="{{$user->phoneNum}}" readonly>
            </div>
            <div class="col-sm-6">
              <label for="c_status" class="form-label">Civil Status :</label>
              <select id="c_status" class="form-select" name="c_status">
                <option selected>Choose civil status</option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="widowed">Widowed</option>
                <option value="divorced">Divorced</option>
              </select>
            </div>
            <div class="col-sm-12">
              <label for="address" class="form-label">Address :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="addressNo" name="addressNo" placeholder="No." value="{{$user->addressNo}}" readonly>
            </div>
            <div class="col-sm-8">
              <select id="street" name="street" class="form-select" disabled>
                <option value="1st Ave."{{$user->street == "1st Ave." ? 'selected' : ''}}>1st Ave.</option>
                <option value="10th Ave."{{$user->street == "10th Ave." ? 'selected' : ''}}>10th Ave.</option>
                      <option value="10th St."{{$user->street == "10th St." ? 'selected' : ''}}>10th St.</option>
                      <option value="11th Ave."{{$user->street == "11th Ave." ? 'selected' : ''}}>11th Ave.</option>
                      <option value="11th St."{{$user->street == "11th St." ? 'selected' : ''}}>11th St.</option>
                      <option value="2nd Ave."{{$user->street == "2nd Ave." ? 'selected' : ''}}>2nd Ave.</option>
                      <option value="3rd Ave."{{$user->street == "3rd Ave." ? 'selected' : ''}}>3rd Ave.</option>
                      <option value="4th Ave."{{$user->street == "4th Ave." ? 'selected' : ''}}>4th Ave.</option>
                      <option value="4th St."{{$user->street == "4th St." ? 'selected' : ''}}>4th St.</option>
                      <option value="5th Ave."{{$user->street == "5th Ave." ? 'selected' : ''}}>5th Ave.</option>
                      <option value="5th St."{{$user->street == "5th St." ? 'selected' : ''}}>5th St.</option>
                      <option value="6th Ave."{{$user->street == "6th Ave." ? 'selected' : ''}}>6th Ave.</option>
                      <option value="6th St."{{$user->street == "6th St." ? 'selected' : ''}}>6th St.</option>
                      <option value="7th Ave."{{$user->street == "7th Ave." ? 'selected' : ''}}>7th Ave.</option>
                      <option value="7th St."{{$user->street == "7th St." ? 'selected' : ''}}>7th St.</option>
                      <option value="8th Ave."{{$user->street == "8th Ave." ? 'selected' : ''}}>8th Ave.</option>
                      <option value="8th St."{{$user->street == "8th St." ? 'selected' : ''}}>8th St.</option>
                      <option value="9th Ave."{{$user->street == "9th Ave." ? 'selected' : ''}}>9th Ave.</option>
                      <option value="9th St."{{$user->street == "9th St." ? 'selected' : ''}}>9th St.</option>
                      <option value="Aguho St."{{$user->street == "Aguho St." ? 'selected' : ''}}>Aguho St.</option>
                      <option value="Anonas St."{{$user->street == "Anonas." ? 'selected' : ''}}>Anonas St.</option>
                      <option value="Atis St."{{$user->street == "Atis St." ? 'selected' : ''}}>Atis St.</option>
                      <option value="Balimbing Ext."{{$user->street == "Balimbing Ext." ? 'selected' : ''}}>Balimbing Ext.</option>
                      <option value="Balimbing St."{{$user->street == "Balimbing St." ? 'selected' : ''}}>Balimbing St.</option>
                      <option value="Bravo St."{{$user->street == "Bravo St." ? 'selected' : ''}}>Bravo St.</option>
                      <option value="Chesa St."{{$user->street == "Chesa St." ? 'selected' : ''}}>Chesa St.</option>
                      <option value="Chico St."{{$user->street == "Chico St." ? 'selected' : ''}}>Chico St.</option>
                      <option value="Durian Ext."{{$user->street == "Durian Ext." ? 'selected' : ''}}>Durian Ext.</option>
                      <option value="Durian St."{{$user->street == "Durian St." ? 'selected' : ''}}>Durian St.</option>
                      <option value="Guiho St."{{$user->street == "Guiho St." ? 'selected' : ''}}>Guiho St.</option>
                      <option value="Guyabano St."{{$user->street == "Guyabano St." ? 'selected' : ''}}>Guyabano St.</option>
                      <option value="Ilang-ilang St."{{$user->street == "Ilang-ilang St." ? 'selected' : ''}}>Ilang-ilang St.</option>
                      <option value="Ipil-ipil St."{{$user->street == "Ipil-ipil St." ? 'selected' : ''}}>Ipil-ipil St.</option>
                      <option value="Kaimito St."{{$user->street == "Kaimito St." ? 'selected' : ''}}>Kaimito St.</option>
                      <option value="Kasoy St."{{$user->street == "Kasyo St." ? 'selected' : ''}}>Kasoy St.</option>
                      <option value="Karamay St."{{$user->street == "Karamay St." ? 'selected' : ''}}>Karamay St.</option>
                      <option value="Kawayan St.."{{$user->street == "Kawayan St." ? 'selected' : ''}}>Kawayan St..</option>
                      <option value="Langka St."{{$user->street == "Langka St." ? 'selected' : ''}}>Langka St.</option>
                      <option value="Mabolo Ext."{{$user->street == "Mabolo Ext." ? 'selected' : ''}}>Mabolo Ext.</option>
                      <option value="Mabolo St."{{$user->street == "Mabolo St." ? 'selected' : ''}}>Mabolo St.</option>
                      <option value="Macopa Ext."{{$user->street == "Macopa Ext." ? 'selected' : ''}}>Macopa Ext.</option>
                      <option value="Macopa St."{{$user->street == "Macopa St." ? 'selected' : ''}}>Macopa St.</option>
                      <option value="Mangga St."{{$user->street == "Mangga St." ? 'selected' : ''}}>Mangga St.</option>
                      <option value="Mangustan St."{{$user->street == "Mangustan St." ? 'selected' : ''}}>Mangustan St.</option>
                      <option value="Mansanas St."{{$user->street == "Mansanas St." ? 'selected' : ''}}>Mansanas St.</option>
                      <option value="Marang St."{{$user->street == "Marang St." ? 'selected' : ''}}>Marang St.</option>
                      <option value="Molave St."{{$user->street == "Molave St." ? 'selected' : ''}}>Molave St.</option>
                      <option value="Narra St."{{$user->street == "Narra St." ? 'selected' : ''}}>Narra St.</option>
                      <option value="Pajo St."{{$user->street == "Pajo St." ? 'selected' : ''}}>Pajo St.</option>
                      <option value="Papaya Ext."{{$user->street == "Papaya Ext." ? 'selected' : ''}}>Papaya Ext.</option>
                      <option value="Pili St."{{$user->street == "Pili St.." ? 'selected' : ''}}>Pili St.</option>
                      <option value="Salamat Ext."{{$user->street == "Salamat Ext." ? 'selected' : ''}}>Salamat Ext.</option>
                      <option value="Sampaguita St."{{$user->street == "Sampaguita St." ? 'selected' : ''}}>Sampaguita St.</option>
                      <option value="Sampaloc Ext."{{$user->street == "Sampaloc Ext." ? 'selected' : ''}}>Sampaloc Ext.</option>
                      <option value="Sampaloc St."{{$user->street == "Sampaloc St." ? 'selected' : ''}}>Sampaloc St.</option>
                      <option value="Santol St."{{$user->street == "Santol St." ? 'selected' : ''}}>Santol St.</option>
                      <option value="Sineguelas St."{{$user->street == "Sineguelas St." ? 'selected' : ''}}>Sineguelas St.</option>
                      <option value="Tindalo St."{{$user->street == "Tindalo St." ? 'selected' : ''}}>Tindalo St.</option>
                      <option value="Yakal St."{{$user->street == "Yakal St." ? 'selected' : ''}}>Yakal St.</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="addressZone" name="addressZone" placeholder="Zone" value="{{$user->addressZone}}">
            </div>
            <div class="col-sm-12">
              <label for="businessAddress" class="form-label">Business Address (for Business Clerance Only) :</label>
              <input type="text" class="form-control" id="businessAddress" name="businessAddress">
            </div>
            <div class="col-sm-8">
              <label for="provincialAddress" class="form-label">Provincial Address :</label>
              <input type="text" class="form-control" id="provincialAddress" name="provincialAddress">
            </div>
            <div class="col-sm-4">
              <label for="living" class="form-label">Year since living in the Barangay:</label>
              <input type="text" class="form-control" id="yearLiving" name="yearLiving">
            </div>
            <div class="col-sm-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="i-certify" id="areYouSure" name="areYouSure">
                <label class="form-check-label" for="areYouSure">I hereby certify that the above information is true and correct to the best of my knowledge</label>
              </div>
            </div>
          <!-- end of personal information  -->

          <!-- Modal -->
          <div class="modal fade" id="requirementsModal" tabindex="-1" aria-labelledby="requirementsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="requirementsModalLabel">Requirements</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  o	House constructions, house renovation/addition, building construction, house (actual) occupancy, business permit, fencing, excavation, electrical (any 3 of the following requirements)
                   <br> *	House tagging
                   <br> *	Deed sale
                   <br> *	DENR clearance
                   <br> *	Proof of billings
                   <br> *	Land title
                   <br> *	Tax declaration (ameliar)
                   <br> *	Land survey
                   <br> o	Medical assistance 
                   <br> *	ID of the patient
                   <br> *	Medical abstract
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="d-grid gap-2 justify-content-end">
            <button class="btn btn-success" type="submit" id="clearanceSubmit">Submit</button>
          </div>
        </form>
      </div>
    </div>
	</div>
</div>
@endsection