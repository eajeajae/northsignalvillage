@extends('layouts.master')

@section('title')
	Tech-service | Vaccines
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
		<h2>VACCINES</h2>
	</div>
	<div class="container">
  	<div class="table-responsive">
			<table class="table table-hover" id="vaccineTable">
	  	<thead>
			<tr>
		  	<th>ID</th>
				<th>Name</th>
		  	<th>Category</th>
				<th>Stocks</th>
		  	<th class="actionsCol">Actions</th>
			</tr>
			</thead>
			<tfoot>
				<th>ID</th>
				<th>Name</th>
		  	<th>Category</th>
				<th>Stocks</th>
			</tfoot>
			</table>
  	</div>
	</div>
</div>
<!-- Vaccine Modal -->
<div class="modal fade" id="vaccineModal" aria-labelledby="vaccineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="font-weight: bolder;">Add Vaccine</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
				<div id="list-vaccine">
					<div class="d-grid gap-2 justify-content-md-end mx-auto">
						<button id="vaccineListAdd" class="btn btn-success">+</button>
					</div>
					<form id="vaccineForm" method="post" action="{{ route('vaccine.store') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="col-sm-12" id="form-vaccine">
								<div class="form-group"> 
									<label for="name" class="control-label" style="font-weight: bolder;">Name of vaccine: </label>
									<input type="text" class="form-control" id="name" name="name">
								</div>
								<div class="form-group"> 
									<label for="category" class="control-label" style="font-weight: bolder;">Category: </label>
										<select id="category" class="form-select" name="category">
											<option selected>Choose category of vaccine</option>
											<option value="Infants (Children immunization)">Infants (Children immunization)</option>
											<option value="Kids">Kids</option>
											<option value="Adults">Adults</option>
											<option value="Senior Citizens">Senior Citizens</option>
										</select>
								</div>
								<div class="form-group"> 
									<label for="stock" class="control-label" style="font-weight: bolder;">Stock: </label>
									<input type="text" class="form-control" id="stock" name="stocks">
								</div>
							</div>			
							<div class="modal-footer">
								<button id="vaccineSubmit" type="submit" class="btn btn-success">Add</button>
							</div>
					</form>
				</div>
      </div>
    </div>
  </div>
</div>
@include('vaccine.editVaccine')
@endsection
