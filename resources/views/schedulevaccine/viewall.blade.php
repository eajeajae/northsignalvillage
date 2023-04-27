@extends('layouts.master')

@section('title')
	Scheduled Vaccination
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
		<div class="col-sm-4">
			@if(empty($vaccines))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-syringe fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Vaccines</p>
							<h5 class="card-text">---</h5>
							<a href="{{route('resident.viewall')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-syringe fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Vaccines</p>
							<h2 class="card-text">{{$vaccines}}</h2>
							<a href="{{route('vaccine.viewall')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="col-sm-4">
			@if(empty($waitinglist))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/img/waiting-list.png" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; height:50px; width:50px;">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Waiting List</p>
							<h5 class="card-text">---</h5>
							<a href="{{route('schedulevaccine.waitinglist')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/img/waiting-list.png" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative; height:50px; width:50px;">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Waiting List</p>
							<h2 class="card-text">{{$waitinglist}}</h2>
							<a href="{{route('schedulevaccine.waitinglist')}}" class="card-text"><small class="text-muted">Total Count</small></a>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="col-sm-4">
			@if(empty($residentScheduled))
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-calendar-alt fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p class="card-title" class="card-title card_tags">Residents who scheduled for vaccination</p>
							<h5 class="card-text">---</h5>
							<small class="text-muted">Total Count</small>
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="card mb-3" style="max-width: 540px; background-color: #ECECEC;">
				<div class="row g-0">
					<div class="col-md-4">
						<i class="fas fa-calendar-alt fa-3x" style="top: calc(40% - 10px); left: calc(40% - 10px); position:relative;"></i>
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<p style="font-size: 12px;" class="card-title card_tags">Residents scheduled for vaccination</p>
							<h2 class="card-text">{{$residentScheduled}}</h2>
							<small class="text-muted">Total Count</small>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
  </div>
	<div id="banner-form">
		<h2>VACCINATION SCHEDULE</h2>
	</div>
	<div id="calendar"></div>
	
</div>
<div class="modal" tabindex="-1" id="vaccinationScheduleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Vaccination Schedule</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('schedulevaccine.store')}}" enctype="multipart/form-data" class="row g-3" id="schedulevaccineUpdateForm">
          @csrf
          <input type="hidden" id="edit_schedulevaccine_id">
            <div class="d-inline-flex p-2 justify-content-end">
              <div class="">
                <select id="edit_schedulevaccine_status" name="status" class="form-select">
                  <option selected>Change Status</option>
                  <option value="waiting for approval">Waiting for approval</option>
                  <option value="approved">Approved</option>
                  <option value="done">Done</option>
                </select>
              </div>
            </div>
          <div class="col-md-12">
            <label for="name" class="form-label text-md-end">{{ __('Name') }}</label>
            <input id="edit_schedulevaccine_name" type="text" class="form-control" name="name" readonly>
          </div>
          <div class="col-md-12">
            <label for="phone_num" class="form-label text-md-end">{{ __('Phone Number') }}</label>
            <input id="edit_schedulevaccine_contact_num"  type="contact_num" class="form-control" name="contact_num" readonly >
          </div>
          <div class="col-md-12">
            <label for="email" class="form-label text-md-end">{{ __('Email') }}</label>
            <input type="text" class="form-control"  id="edit_schedulevaccine_email" name="email"readonly>
          </div>
          <div class="col-md-12">
            <label for="vaccine" class="form-label text-md-end">{{ __('Type of Vaccine') }}</label>
            <input type="text" class="form-control" id="edit_schedulevaccine_vaccineName" name="vaccineName"readonly>
          </div>
            <div class="col-md-6">
              <label for="date" class="form-label text-md-end">{{ __('Registration Date') }}</label>
              <input id="edit_schedulevaccine_date"  type="date" class="form-control" name="date" readonly>
            </div>
            <div class="col-md-6">
              <label for="time" class="form-label text-md-end">{{ __('Registration Time') }}</label>
              <input id="edit_schedulevaccine_time"  type="time" class="form-control" name="time" readonly>
            </div>
            <div class="col-sm-12">
              <label for="address" class="form-label text-md-end">{{ __('Address ') }}</label>
            </div>
            <div class="col-md-3">
              <input id="edit_schedulevaccine_addressNo"  type="address" class="form-control" name="addressNo"readonly>
            </div>
            <div class="col-sm-9">
              <input id="edit_schedulevaccine_street"  type="address" class="form-control" name="street"readonly >
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-success" id="schedulevaccineUpdate">
              {{ __('Update') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
				eventSources: {
					url:'api/vaccination-schedule/all',
				},
				eventClick: function(info) {
					var id = info.event.id;
    			alert(id);
					// alert(info.event.id);
					$('#vaccinationScheduleModal').modal('show');
					$.ajax({
						type: "GET",
						url: "/api/vaccination-schedule/edit/" + id,
						success: function(response){
							console.log(response);
							$('#edit_schedulevaccine_status').val(response.schedulevaccine.status);
              $('#edit_schedulevaccine_id').val(response.schedulevaccine.id);
							$('#edit_schedulevaccine_name').val(response.schedulevaccine.name);
							$('#edit_schedulevaccine_contact_num').val(response.schedulevaccine.contact_num);
							$('#edit_schedulevaccine_email').val(response.schedulevaccine.email);
              $('#edit_schedulevaccine_vaccineName').val(response.schedulevaccine.vaccineName);
							$('#edit_schedulevaccine_date').val(response.schedulevaccine.date);
							$('#edit_schedulevaccine_time').val(response.schedulevaccine.time);
							$('#edit_schedulevaccine_addressNo').val(response.schedulevaccine.addressNo);
							$('#edit_schedulevaccine_street').val(response.schedulevaccine.street);
							$('#edit_schedulevaccine_addressZone').val(response.schedulevaccine.addressZone);
						}
					});
				}
      });
      calendar.render();
    });
</script>
@endsection
