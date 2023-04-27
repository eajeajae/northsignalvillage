@extends('layouts.master')

@section('title')
	Request form for Barangay ID
@endsection 
@include('layouts.sidebar')
@section('content')
<div class="container">
  <div class="main-panel" id="main-panel">
    <div class="col-sm-12" id="banner-form">
      <h2>BARANGAY ID REQUEST FORM</h2>
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
        <form id="barangayidForm" action="{{route('barangayid.store')}}" class="form-group row g-3" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
				<input type="hidden" name="id" id="edit_user_id" value="{{$user->id}}">
        @foreach($request as $typeofrequest)
        <input type="hidden" value="{{$typeofrequest->id}}" id="typeofrequest_id" name="typeofrequest_id">
        <input type="hidden" value="{{$typeofrequest->price}}" id="price" name="price">
        @endforeach
				<div class="col-sm-5">
					<img src="" alt="">
					<div class="col-sm-12">
						<br>
            <label for="id_img" class="form-label">Upload 1x1 picture :</label>
            <input class="form-control" type="file" id="id_img" name="id_img">
          </div>
				</div>
				<div class="col-sm-7 row">
					<div class="col-sm-12">
					<br>
            <label for="fullname" class="form-label">Full Name (Ex: Juan P. Dela Cruz)</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="{{$user->name}}" readonly>
          </div>
          <div class="col-sm-6">
            <label for="birthdate" class="form-label">Birthday :</label>
            <input type="date" class="datepicker form-control" data-date-format="mm/dd/yyyy" class="form-control" id="birthdate" name="birthdate" value="{{$user->birthdate}}" readonly>
          </div>
          <div class="col-sm-6">
            <label for="contactno" class="form-label">Contact No. :</label>
            <input type="text" class="form-control" id="contactno" name="contactno" value="{{$user->phoneNum}}" readonly>
          </div>
          <div class="col-sm-12">
            <label for="address" class="form-label">Address :</label>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control" id="addressNo" name="addressNo" placeholder="No." value="{{$user->addressNo}}" readonly>
          </div>
          <div class="col-sm-8">
            <select id="street" name="street" class="form-select" readonly>
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
						<input type="text" class="form-control" id="addressZone" name="addressZone" placeholder="Zone" value="{{$user->addressZone}}" readonly>
					</div>
					<div class="col-sm-6">
						<label for="precintNo" class="form-label">Precint No. :</label>
						<input type="text" class="form-control" id="precintNo" name="precintNo">
					</div>
<!-- end of personal information -->
					<div class="col-sm-12">
						<br>
						<h6 class="text-center" style="color: #234880; font-weight: bolder;">Incase of Emergency</h6>
					</div>
					<hr style="border: none;
          height: 2px;
					background: #234880;"
					>
					<div class="col-sm-12">
						<label for="contactperson" class="form-label">Name :</label>
						<input type="text" class="form-control" id="contactperson" name="contactperson">
					</div>
					<div class="col-sm-12">
						<label for="guardianContact" class="form-label">Contact No. :</label>
						<input type="text" class="form-control" id="guardianContact" name="guardianContact">
					</div>
					<div class="col-sm-12">
						<label for="guardianAddress" class="form-label">Address :</label>
						<input type="text" class="form-control" id="guardianAddress" name="guardianAddress">
					</div>
					
          <div class="d-grid gap-2 justify-content-end">
						<br>
            <button id="barangayidSubmit" class="btn btn-success" type="submit">Submit</button>
          </div>
				</div>
          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
