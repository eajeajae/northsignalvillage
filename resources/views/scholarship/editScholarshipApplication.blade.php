<!-- Modal -->
<div class="modal fade" id="editScholarshipApplicationModal" tabindex="-1" aria-labelledby="editScholarshipApplicationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Scholarship Application</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateSchoalrshipApplicationForm" method="post" enctype="multipart/form-data" class="row g-3">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="edit_scholarApplication_id">
          <input type="hidden" id="edit_scholarApplication_user_id" name="user_id">
					<div class="d-inline-flex p-2 justify-content-end">
						<div class="">
							<select id="edit_scholarApplication_status" name="status" class="form-select">
								<option selected>Change Status</option>
								<option value="waiting for evaluation">Waiting for evaluation</option>
								<option value="granted">Granted</option>
								<option value="not granted">Not Granted</option>
							</select>
						</div>
					</div>
					<div class="form-group col-sm-12"> 
						<label for="scholarFname" class="form-label">Name :</label>
						<input type="text" class="form-control" id="edit_scholarApplication_scholarFname" name="scholarFname">
					</div>
					<div class="form-group col-sm-6">
						<label for="scholarPhonenum" class="form-label">Contact No. :</label>
						<input type="text" class="form-control" id="edit_scholarApplication_scholarPhonenum" name="scholarPhonenum">
					</div> 
					<div class="form-group col-sm-3"> 
						<label for="scholarSchool" class="form-label">School :</label>
						<input type="text" class="form-control" id="edit_scholarApplication_scholarSchool" name="scholarSchool">
					</div> 
					<div class="form-group col-sm-9"> 
						<label for="scholarCourse" class="form-label">Course :</label>
						<input type="text" class="datepicker form-control" class="form-control" id="edit_scholarApplication_scholarCourse" name="scholarCourse">
					</div>
					<div class="form-group col-sm-12 mb-5"> 
						<label for="scholarEmail" class="form-label">Email :</label>
						<input type="email" class="form-control" id="edit_scholarApplication_scholarEmail" name="scholarEmail">
					</div> 
					<div class="col-sm-12">
						<div id="edit_scholarApplication_scholarCor_img">

						</div>
					</div>
					<div class="col-sm-12">
						<div id="edit_scholarApplication_scholarGrade_img">

						</div>
					</div>
          <div class="modal-footer">
            <button id="scholarshipApplicationUpdate" type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>