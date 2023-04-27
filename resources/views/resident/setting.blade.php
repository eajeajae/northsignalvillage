@extends('layouts.master')

@section('title')
	Settings
@endsection
@if(Auth::user()->role == 'resident')
@include('layouts.sidebar')
@else
@include('layouts.sidebaradmin')
@endif

@section('content')
<div class="container">
	<div class="main-panel">
    <div class="row g-3">
			<div class="col-sm-12" id="banner-form">
				<h2>SETTINGS</h2>
			</div>
			@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
				<div class="accordion mb-5" >
					<div class="accordion-item" id="accordionAccount">
						<h2 class="accordion-header" id="headingOne">
							<button class="accordion-button card_tags" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="account-accordion-button">
								Personal Information
							</button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionAccount">
							<div class="accordion-body">
							<form id="profileForm" method="post" action= "{{route('resident.updatemyProfile')}}" enctype="multipart/form-data" class="row g-3 mx-3 my-3">
								<div class="col-sm-3">
									<img src="{{asset('/images/users/$user->avatar')}}" alt="" width='100px' height='100px'>
								</div>
								<div class="col-sm-9">
									<div class="row g-3">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="id" id="edit_user_id" value="{{$user->id}}">
										<div class="col-sm-12"> 
											<label for="edit_name" class="form-label">Name (Ex: Juan P. Dela Cruz):</label>
											<input type="text" class="form-control" id="edit_name" name="name" value="{{$user->name}}">
											<br>
										</div> 
										<div class="col-sm-3"> 
												<label for="edit_age" class="form-label">Age :</label>
												<input type="text" class="form-control" id="edit_age" name="age" value="{{$user->age}}">
											</div> 
										<div class="col-sm-9"> 
											<label for="edit_birthdate" class="form-label">Birthday :</label>
											<input type="date" class="datepicker form-control" data-date-format="yyyy/mm/dd" class="form-control" id="edit_birthdate" name="birthdate" value="{{$user->birthdate}}">
										</div>
										<div class="col-sm-12">
											<label for="edit_phoneNum" class="form-label">Contact No. :</label>
											<input type="text" class="form-control" id="edit_phoneNum" name="phoneNum" value="{{$user->phoneNum}}">
										</div>
										<div class="col-sm-12">
											<label for="edit_gender" class="form-label">Gender :</label><br>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="gender" id="edit_gender" value="female" {{$user->gender == "female" ? 'checked' : ''}}>
												<label class="form-check-label" for="gender">Female</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="gender" id="edit_gender" value="male" {{$user->gender == "male" ? 'checked' : ''}}>
												<label class="form-check-label" for="edit_gender">Male</label>
											</div>
										</div>
										<div class="col-sm-12">
											<label for="edit_avatar" class="form-label text-md-end">{{ __('Avatar') }}</label>
											<input class="form-control" type="file" id="edit_avatar" name="avatar">
										</div>
										<hr style="border: none;
															height: 2px;
															background: #234880;"
															>
										<h6>Home Address</h6>

										<div class="col-sm-2">
											<input type="text" class="form-control" id="edit_addressNo" name="addressNo" placeholder="No." value="{{$user->addressNo}}">
										</div>
										<div class="col-sm-8">
											<select id="edit_street" name="street" class="form-select">
												<option selected>Choose street</option>
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
											<input type="text" class="form-control" id="edit_addressZone" name="addressZone" placeholder="Zone" value="{{ $user->addressZone }}">
										</div>
										<div class="modal-footer">
											<button id="updateprofileSubmit" type="submit" class="btn btn-success">Update</button>
										</div>
									</div>
								</div>
							</form>
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo">
							<button class="accordion-button collapsed card_tags" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="account-accordion-button">
								Password
							</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionAccount">
							<div class="accordion-body">
							<form method="POST" action="{{ route('password.email') }}" class="mx-5 my-5">
							@csrf
								<h5 class="card_tags">Reset Password</h5>
								<hr style="border: none;
								height: 2px;
								background: white;"
								>
								<div class="col-md-12">
									<label for="email" class="form-label">{{ __('Email') }}</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" autofocus>
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="d-grid gap-2 justify-content-end offset-md-5 mt-3">
									<button type="submit" class="btn btn-success">
										{{ __('Send Password Reset Link') }}
									</button>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>

@endsection
