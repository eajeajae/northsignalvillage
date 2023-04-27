<!-- Announcement Modal -->
<div class="modal fade" id="vaccineEditModal" aria-labelledby="vaccineEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="font-weight: bolder;">Edit Vaccine</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
				<div id="list-vaccine">
					<form id="updateVaccineForm" method="post">
						<input type="hidden" id="edit_vaccine_id">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="col-sm-12" id="form-vaccine">
								<div class="form-group"> 
									<label for="name" class="control-label" style="font-weight: bolder;">Name of vaccine: </label>
									<input type="text" class="form-control" id="edit_vaccine_name" name="name">
								</div>
								<div class="form-group"> 
									<label for="category" class="control-label" style="font-weight: bolder;">Category: </label>
										<select id="edit_vaccine_category" class="form-select" name="category">
											<option selected>Choose category of vaccine</option>
											<option value="Infants (Children immunization)">Infants (Children immunization)</option>
											<option value="Kids">Kids</option>
											<option value="Adults">Adults</option>
											<option value="Senior Citizens">Senior Citizens</option>
										</select>
								</div>
								<div class="form-group"> 
									<label for="stock" class="control-label" style="font-weight: bolder;">Stock: </label>
									<input type="text" class="form-control" id="edit_vaccine_stocks" name="stocks">
								</div>
							</div>			
							<div class="modal-footer">
								<button id="vaccineUpdate" type="submit" class="btn btn-success">Update</button>
							</div>
					</form>
				</div>
      </div>
    </div>
  </div>
</div>