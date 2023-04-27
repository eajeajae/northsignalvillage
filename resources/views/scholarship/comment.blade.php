<!-- Modal -->
<div class="modal fade" id="commentScholarshipModal" tabindex="-1" aria-labelledby="commentScholarshipModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Scholarship Application</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="commentScholarshipForm" method="post" enctype="multipart/form-data" class="row g-3">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="edit_scholarApplication_id">
					<div class="d-inline-flex p-2 justify-content-end">
						<div class="">
							<select id="edit_scholarApplication_status" name="status" class="form-select" readonly> 
								<option selected>Change Status</option>
								<option value="waiting for evaluation">Waiting for evaluation</option>
								<option value="granted">Granted</option>
								<option value="not granted">Not Granted</option>
							</select>
						</div>
					</div>
					<div class="form-group col-sm-6"> 
						<label for="scholarFname" class="form-label">Name :</label>
						<input type="text" class="form-control" id="edit_scholarApplication_scholarFname" name="scholarFname" readonly>
					</div>
					<div class="form-group col-sm-6 "> 
						<label for="scholarEmail" class="form-label">Email :</label>
						<input type="email" class="form-control" id="edit_scholarApplication_scholarEmail" name="scholarEmail" readonly>
					</div> 
					<div class="form-group col-sm-4">
						<label for="scholarPhonenum" class="form-label">Contact No. :</label>
						<input type="text" class="form-control" id="edit_scholarApplication_scholarPhonenum" name="scholarPhonenum" readonly>
					</div> 
					<div class="form-group col-sm-4"> 
						<label for="scholarSchool" class="form-label">School :</label>
						<input type="text" class="form-control" id="edit_scholarApplication_scholarSchool" name="scholarSchool" readonly>
					</div> 
					<div class="form-group col-sm-4"> 
						<label for="scholarCourse" class="form-label">Course :</label>
						<input type="text" class="datepicker form-control" class="form-control" id="edit_scholarApplication_scholarCourse" name="scholarCourse" readonly>
					</div>
					<div class="col-sm-12">
						<div id="edit_scholarApplication_scholarCor_img">

						</div>
					</div>
					<div class="col-sm-12">
						<div id="edit_scholarApplication_scholarGrade_img">

						</div>
					</div>
					<div class="col-sm-12">
						<label for="comment" class="control-label" style="font-weight: bolder;">Comment: </label>
            <textarea class="form-control" id="edit_scholarApplication_comment" name="comment" rows="3"></textarea>
					</div>
          <div class="modal-footer">
            <button id="commentScholarshipAdd" type="submit" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>