<!-- Modal -->
<div class="modal fade" id="editMyScholarshipApplication" tabindex="-1" aria-labelledby="editMyScholarshipApplicationLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Scholarship Application</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editMyscholarshipApplicationForm" method="post" enctype="multipart/form-data" class="row g-3">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="edit_myscholarapplication_id">
					<div class="form-group col-sm-12"> 
						<label for="scholarFname" class="form-label">Name :</label>
						<input type="text" class="form-control" id="edit_myscholarapplication_scholarFname" name="scholarFname">
					</div>
					<div class="form-group col-sm-6">
						<label for="scholarPhonenum" class="form-label">Contact No. :</label>
						<input type="text" class="form-control" id="edit_myscholarapplication_scholarPhonenum" name="scholarPhonenum">
					</div> 
					<div class="form-group col-sm-3"> 
						<label for="scholarSchool" class="form-label">School :</label>
						<input type="text" class="form-control" id="edit_myscholarapplication_scholarSchool" name="scholarSchool">
					</div> 
					<div class="form-group col-sm-9"> 
						<label for="scholarCourse" class="form-label">Course :</label>
						<input type="text" class="datepicker form-control" class="form-control" id="edit_myscholarapplication_scholarCourse" name="scholarCourse">
					</div>
					<div class="form-group col-sm-12 mb-5"> 
						<label for="scholarEmail" class="form-label">Email :</label>
						<input type="email" class="form-control" id="edit_myscholarapplication_scholarEmail" name="scholarEmail">
					</div> 
					<div class="col-sm-12">
						<div id="edit_myscholarapplication_scholarCor_img">

						</div>
            <input class="form-control" type="file" id="scholarCor_img" name="scholarCor_img">
					</div>
					<div class="col-sm-12">
						<div id="edit_myscholarapplication_scholarGrade_img">

						</div>
            <input class="form-control" type="file" id="scholarGrade_img" name="scholarGrade_img">
					</div>
          <div class="modal-footer">
            <button id="scholarshipApplicationUpdate" type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>