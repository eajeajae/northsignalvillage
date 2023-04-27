@extends('layouts.master')

@section('title')
	Complaint Form
@endsection 
@include('layouts.sidebar')
@section('content')
<div class="container">
    <div class="main-panel" id="main-panel">
        <div class="col-sm-12" id="banner-form">
            <h2>COMPLAINT FORM</h2>
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
        <div class="card card-form">
            <div class="card-body mx-5 my-5">
              <form method="post" action="{{route('complaint.store')}}" enctype="multipart/form-data" class="row g-3" id="complaintForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="id" value="{{$user->id}}">
                <div class="col-sm-12">
                    <label for="complainantName" class="form-label">Complainant's Name (Buong pangalan ng nagrereklamo) :</label>
                    <input type="text" class="form-control" id="complainantName" name="complainantName" value="{{$user->name}}" readonly>
                  </div>
                  <div class="col-sm-12">
                    <label for="complainantAddress" class="form-label">Complainant's Address (Address ng nagrereklamo) :</label>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="cAddressno" name="cAddressno" placeholder="No."value="{{$user->addressNo}}" disabled>
                  </div>
                  <div class="col-sm-8">
                    <select id="cStreet" name="cStreet" class="form-select" disabled>
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
                    <input type="text" class="form-control" id="cAddresszone" name="cAddresszone" placeholder="Zone" value="{{$user->addressZone}}" disabled>
                  </div>
                  <div class="col-sm-7">
                    <label for="respondentName" class="form-label">Name (Buong pangalan ng inirereklamo) :</label>
                    <input type="text" class="form-control" id="respondentName" name="respondentName">
                  </div>
                  <div class="col-sm-5">
                    <label for="respondentAge" class="form-label">Age (Edad ng inirereklamo) :</label>
                    <input type="text" class="form-control" id="respondentAge" name="respondentAge">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="rAddressno" name="rAddressno" placeholder="No.">
                  </div>
                  <div class="col-sm-8">
                    <select id="rStreet" name="rStreet" class="form-select">
                      <option selected>Street</option>
                      <option value="1st Ave.">1st Ave.</option>
                      <option value="10th Ave.">10th Ave.</option>
                      <option value="10th St.">10th St.</option>
                      <option value="11th Ave.">11th Ave.</option>
                      <option value="11th St.">11th St.</option>
                      <option value="2nd Ave.">2nd Ave.</option>
                      <option value="3rd Ave.">3rd Ave.</option>
                      <option value="4th Ave.">4th Ave.</option>
                      <option value="4th Ave.">4th Ave.</option>
                      <option value="4th St.">4th St.</option>
                      <option value="5th Ave.">5th Ave.</option>
                      <option value="5th St.">5th St.</option>
                      <option value="6th Ave.">6th Ave.</option>
                      <option value="6th St.">6th St.</option>
                      <option value="7th Ave.">7th Ave.</option>
                      <option value="7th St.">7th St.</option>
                      <option value="8th Ave.">8th Ave.</option>
                      <option value="8th St.">8th St.</option>
                      <option value="9th Ave.">9th Ave.</option>
                      <option value="9th St.">9th St.</option>
                      <option value="Aguho St.">Aguho St.</option>
                      <option value="Anonas St.">Anonas St.</option>
                      <option value="Atis St.">Atis St.</option>
                      <option value="Balimbing Ext.">Balimbing Ext.</option>
                      <option value="Balimbing St.">Balimbing St.</option>
                      <option value="Bravo St.">Bravo St.</option>
                      <option value="Chesa St.">Chesa St.</option>
                      <option value="Chico St.">Chico St.</option>
                      <option value="Durian Ext.">Durian Ext.</option>
                      <option value="Durian St.">Durian St.</option>
                      <option value="Guiho St.">Guiho St.</option>
                      <option value="Guyabano St.">Guyabano St.</option>
                      <option value="Ilang-ilang St.">Ilang-ilang St.</option>
                      <option value="Ipil-ipil St.">Ipil-ipil St.</option>
                      <option value="Kaimito St.">Kaimito St.</option>
                      <option value="Kasoy St.">Kasoy St.</option>
                      <option value="Karamay St.">Karamay St.</option>
                      <option value="Kawayan St..">Kawayan St..</option>
                      <option value="Langka St.">Langka St.</option>
                      <option value="Mabolo Ext.">Mabolo Ext.</option>
                      <option value="Mabolo St.">Mabolo St.</option>
                      <option value="Macopa Ext.">Macopa Ext.</option>
                      <option value="Macopa St.">Macopa St.</option>
                      <option value="Mangga St.">Mangga St.</option>
                      <option value="Mangustan St.">Mangustan St.</option>
                      <option value="Mansanas St.">Mansanas St.</option>
                      <option value="Marang St.">Marang St.</option>
                      <option value="Molave St.">Molave St.</option>
                      <option value="Narra St.">Narra St.</option>
                      <option value="Pajo St.">Pajo St.</option>
                      <option value="Papaya Ext.">Papaya Ext.</option>
                      <option value="Pili St.">Pili St.</option>
                      <option value="Salamat Ext.">Salamat Ext.</option>
                      <option value="Sampaguita St.">Sampaguita St.</option>
                      <option value="Sampaloc Ext.">Sampaloc Ext.</option>
                      <option value="Sampaloc St.">Sampaloc St.</option>
                      <option value="Santol St.">Santol St.</option>
                      <option value="Sineguelas St.">Sineguelas St.</option>
                      <option value="Tindalo St.">Tindalo St.</option>
                      <option value="Yakal St.">Yakal St.</option>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="rAddresszone" name="rAddresszone" placeholder="Zone">
                  </div>
                  <div class="col-sm-12">
                    <label for="complaintDesc" class="form-label">Complaint:</label>
                    <select id="complaintDesc" name="complaintDesc" class="form-select">
                      <option selected>Common Complaints</option>
                      <option value="Abandonment (Minors/Person in danger/etc.)">Abandonment (Minors/Person in danger/etc.)</option>
                      <option value="Alarms & Scandals">Alarms & Scandals</option>
                      <option value="Coercions (Grave or light)">Coercions (Grave or light)</option>
                      <option value="Curfew">Curfew</option>
                      <option value="Family Dispute">Family Dispute</option>
                      <option value="Land & ownership">Land & ownership</option>
                      <option value="Malicious Mischiefs">Malicious Mischiefs</option>
                      <option value="Noise Problem">Noise Problem</option>
                      <option value="Riot">Riot</option>
                      <option value="Simple Seduction">Simple Seduction</option>
                      <option value="Swindling (Minor or estafa)">Swindling (Minor or estafa)</option>
                      <option value="Theft">Theft</option>
                      <option value="Threats">Threats</option>
                      <option value="Tresspass">Tresspass</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <label for="complaintLocation" class="form-label">Location (Lugar ng pinangyarihan) :</label>
                  </div>
                  <div class="col-sm-6">
                    <label for="complaintDate" class="form-label">Date (Kailan nangyari) :</label>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="locationAddressno" name="locationAddressno" placeholder="No.">
                  </div>
                  <div class="col-sm-4">
                    <select id="locationStreet" name="locationStreet" class="form-select">
                      <option selected>Street</option>
                      <option value="1st Ave.">1st Ave.</option>
                      <option value="10th Ave.">10th Ave.</option>
                      <option value="10th St.">10th St.</option>
                      <option value="11th Ave.">11th Ave.</option>
                      <option value="11th St.">11th St.</option>
                      <option value="2nd Ave.">2nd Ave.</option>
                      <option value="3rd Ave.">3rd Ave.</option>
                      <option value="4th Ave.">4th Ave.</option>
                      <option value="4th Ave.">4th Ave.</option>
                      <option value="4th St.">4th St.</option>
                      <option value="5th Ave.">5th Ave.</option>
                      <option value="5th St.">5th St.</option>
                      <option value="6th Ave.">6th Ave.</option>
                      <option value="6th St.">6th St.</option>
                      <option value="7th Ave.">7th Ave.</option>
                      <option value="7th St.">7th St.</option>
                      <option value="8th Ave.">8th Ave.</option>
                      <option value="8th St.">8th St.</option>
                      <option value="9th Ave.">9th Ave.</option>
                      <option value="9th St.">9th St.</option>
                      <option value="Aguho St.">Aguho St.</option>
                      <option value="Anonas St.">Anonas St.</option>
                      <option value="Atis St.">Atis St.</option>
                      <option value="Balimbing Ext.">Balimbing Ext.</option>
                      <option value="Balimbing St.">Balimbing St.</option>
                      <option value="Bravo St.">Bravo St.</option>
                      <option value="Chesa St.">Chesa St.</option>
                      <option value="Chico St.">Chico St.</option>
                      <option value="Durian Ext.">Durian Ext.</option>
                      <option value="Durian St.">Durian St.</option>
                      <option value="Guiho St.">Guiho St.</option>
                      <option value="Guyabano St.">Guyabano St.</option>
                      <option value="Ilang-ilang St.">Ilang-ilang St.</option>
                      <option value="Ipil-ipil St.">Ipil-ipil St.</option>
                      <option value="Kaimito St.">Kaimito St.</option>
                      <option value="Kasoy St.">Kasoy St.</option>
                      <option value="Karamay St.">Karamay St.</option>
                      <option value="Kawayan St..">Kawayan St..</option>
                      <option value="Langka St.">Langka St.</option>
                      <option value="Mabolo Ext.">Mabolo Ext.</option>
                      <option value="Mabolo St.">Mabolo St.</option>
                      <option value="Macopa Ext.">Macopa Ext.</option>
                      <option value="Macopa St.">Macopa St.</option>
                      <option value="Mangga St.">Mangga St.</option>
                      <option value="Mangustan St.">Mangustan St.</option>
                      <option value="Mansanas St.">Mansanas St.</option>
                      <option value="Marang St.">Marang St.</option>
                      <option value="Molave St.">Molave St.</option>
                      <option value="Narra St.">Narra St.</option>
                      <option value="Pajo St.">Pajo St.</option>
                      <option value="Papaya Ext.">Papaya Ext.</option>
                      <option value="Pili St.">Pili St.</option>
                      <option value="Salamat Ext.">Salamat Ext.</option>
                      <option value="Sampaguita St.">Sampaguita St.</option>
                      <option value="Sampaloc Ext.">Sampaloc Ext.</option>
                      <option value="Sampaloc St.">Sampaloc St.</option>
                      <option value="Santol St.">Santol St.</option>
                      <option value="Sineguelas St.">Sineguelas St.</option>
                      <option value="Tindalo St.">Tindalo St.</option>
                      <option value="Yakal St.">Yakal St.</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="complaintDate" name="complaintDate" data-date-format="YYYY MM DD">
                  </div>
                  <div class="col-sm-12">
                    <label for="complaintWhy" class="form-label">Why (Isalaysay kung bakit nagreklamo) :</label>
                    <textarea class="form-control" id="complaintWhy" name="complaintWhy" rows="3"></textarea>
                  </div>
                  <div class="col-sm-12">
                    <label for="complainantPrayer" class="form-label">Prayer (Isalaysay ang ang nais mangyari) :</label>
                    <textarea class="form-control" id="complainantPrayer" name="complainantPrayer" rows="3"></textarea>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="i-certify" id="complainantAgrees" name="complainantAgrees">
                      <label class="form-check-label" for="complainantAgrees">I hereby certify that the above information is true and correct to the best of my knowledge</label>
                    </div>
                  </div>
                    <div class="d-grid gap-2 justify-content-end">
                        <button id="complaintSubmit" class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
              
    </div>
</div>
@endsection